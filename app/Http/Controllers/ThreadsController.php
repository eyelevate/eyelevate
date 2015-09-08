<?php

namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Response;
use Auth;
use Session;
use Laracasts\Flash\Flash;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\Reply;
use App\Search;
use App\User;
use App\Thread;
use App\Category;
use App\Flag;
use App\Like;
use App\Dislike;

class ThreadsController extends Controller
{
    public function __construct()
    {
        
        // $this->layout = "layouts.test";
        
        //FIRST TEMPLATE
        // $this->layout = "layouts.master";
        
        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";
        
        // // THIRD TEMPLATE
        $this->layout  = 'layouts.master-layout';
        $this->user_id = null;
        if (Auth::check()) {
            $this->user_id = Auth::user()->id;
        }
    }
    public function getAdd()
    {
        
    }
    public function postAdd()
    {
        
        $sanitized_data = Input::all();
        $question       = $sanitized_data['question'];
        $notify_me      = isset($sanitized_data['notify-me']) ? $sanitized_data['notify-me'] : 0;
        $categories     = isset($sanitized_data['categories']) ? json_encode($sanitized_data['categories']) : null;
        
        //IE.11 ERROR RESOLVED
        $title = $question['title'];
        if ($question['title_2']) {
            $title = $question['title_2'];
        }
        //---
        
        $description = $question['description'];
        
        $thread              = new Thread;
        $thread->user_id     = Auth::user()->id;
        $thread->title       = $title;
        $thread->description = json_encode($description);
        $thread->categories  = $categories;
        $thread->notify_me   = $notify_me;
        $thread->status      = 1;
        
        if ($thread->save()) { // Save the user and redirect to freelancers home
            return Redirect::back();
        } else {
            Flash::error('Error');
            return Redirect::back();
        }
    }
    public function getView($id)
    {
        $threads  = Thread::find($id);
        $gd_to_go = Thread::CheckThreadStatus($threads->status);

        $session_data = null;
        if (Session::get('thread_view')) {
            $session_data = Session::get('thread_view');
        }
        Session::forget('thread_view');
        
        if ($gd_to_go == true) {
            //ADD TO THE VIEWS Count
            $views_before   = $threads->views;
            $views_after    = $views_before + 1;
            $threads->views = $views_after;
            $threads->save();
            
            $threads_html            = Thread::prepareThreadsAndThreadReply($threads);
            $this_user_profile_image = User::CheckForProfileImage();
            $thread_user             = User::find($threads->user_id);
            $thread_username         = $thread_user->username;
            
            $status_prepared = Thread::prepareThreadStatus($threads->status);
            
            $checked = '';
            if (Auth::check()) {
                if ($threads->user_id == Auth::user()->id) {
                    $is_owner = true;
                    if ($threads->notify_me == 1) {
                        $checked = 'checked';
                    }
                    $setting_icon = '<i class="glyphicon glyphicon-cog setting-icon"></i>';
                }
            }
            $selects = Thread::PerpareStatusForInput();
            
            return view('threads.view')
            ->with('layout', $this->layout)
            ->with('threads', $threads)
            ->with('session_data', $session_data)
            ->with('threads_html', $threads_html)
            ->with('this_user_profile_image', $this_user_profile_image)
            ->with('thread_username', $thread_username)
            ->with('status_prepared', $status_prepared)
            ->with('selects', $selects)
            ->with('checked', $checked);
        } else {
            Flash::error('This thread is no longer available');
            return Redirect::action('HomeController@postIndex');
        }
        
    }
    public function postSearchQuery()
    {
        if (Request::ajax()) {
            $status         = 200;
            $search_query   = Input::get('search_text');
            $search_results = Search::search_function($search_query);
            if (empty($search_results)) {
                $status = 400;
            }
            return Response::json(array(
                'status' => $status,
                'search_results' => $search_results
            ));
        }
    }
    
    
    public function postRetrieveQuotes()
    {
        if (Request::ajax()) {
            $status   = 200;
            $reply_id = Input::get('this_reply');
            $replies  = Reply::find($reply_id);
            $isself   = false;
            $this_replier   = User::find($replies->user_id);
            $reply_username = $this_replier->username;
            $quotes_html    = Reply::PrepareQuotesForView($reply_id);
            
            if (Auth::check()) {
                if (Auth::user()->id == $replies->user_id) {
                    $isself = true;
                }
            }
            return Response::json(array(
                'status' => $status,
                'quotes_html' => $quotes_html,
                'reply_username' => $reply_username,
                'isself' => $isself
            ));
        }
    }
    
    public function postPostAnswer()
    {
        if (Request::ajax()) {
            $status      = 400;
            $notify_me   = array(
                'notify_me' => 0,
                'user_id' => 0
            );
            $this_answer      = Input::get('this_answer');
            $this_thread      = Input::get('this_thread');
            $answer_html = 'Not Authorized';

            $session_data = ['post_answer'=>$this_answer,'post_quote'=>'','this_thread'=>$this_thread];
            Session::put('thread_view',$session_data);

            if (Auth::check()) {
                Session::forget('thread_view');
                $checke_empty_set = Job::CheckEmptySet($this_answer);
                if ($checke_empty_set == true) {
                    $reply            = new Reply;
                    $reply->thread_id = $this_thread;
                    $reply->user_id   = Auth::user()->id;
                    $reply->reply     = json_encode($this_answer);
                    $reply->status    = 1;
                    $reply->quote_id  = null;
                    if ($reply->save()) {
                        $answer_html            = Reply::preparePostedAnswer($this_answer, $reply->id, $this_thread);
                        $status                 = 200;
                        //CHECK FOR NOTIFICATION STATUS AND EMAIL IF NEEDED
                        $threads                = Thread::find($this_thread);
                        if (Auth::user()->id != $threads->user_id) {
                            $notify_me["notify_me"] = $threads->notify_me;
                            if ($threads->notify_me == 1) {
                                $notify_me["user_id"] = $threads->user_id;
                            }
                        }

                    }
                } else {
                    $status = 401;
                }
            }
            return Response::json(array(
                'status' => $status,
                'answer_html' => $answer_html,
                'notify_me' => $notify_me
            ));
        }
    }
    public function postAnswerNotification()
    {
        $status    = 400;
        $user_id   = Input::get('user_id');
        $thread_id = Input::get('thread_id');
        if (isset($user_id, $thread_id)) {
            $users      = User::find($user_id);
            $user_email = $users->email ? $users->email : 'example@example.com';
            if (Mail::send('emails.been_answered', array(
                'thread_id' => $thread_id
            ), function($message) use ($user_email)
            {
                $message->to($user_email);
                $message->subject('You Have An Answer');
            })) {
                $status = 200;
            }
        }
        
        return Response::json(array(
            'status' => $status
        ));
        
    }
    public function postPostQuote()
    {
        if (Request::ajax()) {
            $status      = 400;
            $quote_html  = '';
            $quote_count = null;
            if (Auth::check()) {
                $this_answer     = Input::get('this_answer');
                $this_quote      = Input::get('this_quote');
                $this_thread     = Input::get('this_thread');
                $check_empty_set = Job::CheckEmptySet($this_answer);
                if ($check_empty_set == true) {
                    
                    
                    $quote            = new Reply;
                    $quote->thread_id = $this_thread;
                    $quote->user_id   = Auth::user()->id;
                    $quote->reply     = json_encode($this_answer);
                    $quote->status    = 1;
                    $quote->quote_id  = $this_quote;
                    if ($quote->save()) {
                        $quote_html = Reply::preparePostedQuote($this_answer, $this_quote, $this_thread, $quote->id);
                        $status     = 200;
                    }
                    $quote_count = count(Reply::where('quote_id', $this_quote)->get());
                } else {
                    $status = 401;
                }
            }
            return Response::json(array(
                'status' => $status,
                'quote_html' => $quote_html,
                'quote_count' => $quote_count
            ));
        }
    }
    public function postCheckFlag()
    {
        
        if (Request::ajax()) {
            if (Auth::check()) {
                $status           = 200;
                $total_flag_count = null;
                $this_reply       = Input::get('this_reply');
                $this_thread      = Input::get('this_thread');
                $this_quote       = Input::get('this_quote');
                
                //THREAD OR A REPLY WAS FLAGGED
                if ($this_quote == 'false') {
                    //IT WAS A REPLY
                    if ($this_reply != 0) {
                        $replys       = Reply::find($this_reply);
                        $flagged_user = $replys->user_id;
                    }
                    //THIS WAS A THREAD
                    else {
                        $threads      = Thread::find($this_thread);
                        $flagged_user = $threads->user_id;
                    }
                    //CHECK IF THIS USER HAS FLAGGED THIS REPLY OR THREAD BEFORE
                    $prev_flags = count(Flag::where('reply_id', $this_reply)
                        ->where('thread_id', $this_thread)
                        ->where('flagger_user_id', $this->user_id)
                        ->where('flagged_user_id', $flagged_user)
                        ->whereNull('quote_id')
                        ->whereIn('status', array(1,2,4,5,7))->get());
                    if ($prev_flags != 0) {
                        $status = 401;
                    }
                } else { //A QUOTE WAS FALGGED
                    $quotes       = Reply::find($this_quote);
                    $thread_id    = $quotes->thread_id;
                    //IN DB ITS NAMED QUOTE ID BUT ITS A REPLY ID
                    $reply_id     = $quotes->quote_id;
                    $flagged_user = $quotes->user_id;
                    $flagger_user = Auth::user()->id;
                    $prev_flags   = count(Flag::where('quote_id', $this_quote)
                        ->where('flagger_user_id', $flagger_user)
                        ->where('flagged_user_id', $flagged_user)
                        ->whereIn('status', array(1,2,4,5,7))->get());
                    if ($prev_flags != 0) {
                        $status = 401;
                    }
                }
            } else { //USER WASNT AUTH
                $status = 402;
            }
            return Response::json(array(
                'status' => $status
            ));
        }
    }
    public function postSubmitFlag()
    {
        if (Request::ajax()) {
            $status           = 400;
            $total_flag_count = null;
            //NO OTHER FLAG AJAX EXISTS
            if (Auth::check()) {
                $this_reply             = Input::get('this_reply');
                $this_thread            = Input::get('this_thread');
                $this_quote             = Input::get('this_quote');
                $reason                 = Input::get('reason');
                $details                = Input::get('details');
                if ($this_quote == 'false') {//A THREAD OR A QUOTE WAS FLAGGED
                    //IT WAS A REPLY
                    $check_empty_set_reply  = Job::CheckEmptySet($this_reply);
                    $check_empty_set_thread = Job::CheckEmptySet($this_thread);
                    if ($check_empty_set_thread == true) {
                        if ($this_reply != 0) {
                            $replys       = Reply::find($this_reply);
                            $flagged_user = $replys->user_id;
                        } else { //THIS WAS A THREAD
                            $threads      = Thread::find($this_thread);
                            $flagged_user = $threads->user_id;
                        }
                        //CHECK IF THIS USER HAS FLAGGED THIS REPLY OR THREAD BEFORE
                        $prev_flags = count(Flag::where('reply_id', $this_reply)
                            ->where('thread_id', $this_thread)
                            ->where('flagger_user_id', $this->user_id)
                            ->where('flagged_user_id', $flagged_user)
                            ->whereNull('quote_id')
                            ->whereIn('status', array(1,2,4,5,7))->get());
                        if ($prev_flags == 0) {
                            $flags                  = new Flag();
                            $flags->reply_id        = $this_reply;
                            $flags->thread_id       = $this_thread;
                            $flags->flagger_user_id = $this->user_id;
                            $flags->flagged_user_id = $flagged_user;
                            $flags->reason          = $reason;
                            $flags->details         = $details;
                            $flags->status          = 1;
                            if ($flags->save()) {
                                $status = 200;
                            }
                        } else {
                            $status = 401;
                        }
                        $total_flag_count = count(Flag::where('reply_id', $this_reply)
                            ->where('thread_id', $this_thread)
                            ->whereNull('quote_id')
                            ->whereIn('status', array(1,2,4,5,7))->get());
                    }
                } else { //IT WAS A QUOTE
                    $quotes       = Reply::find($this_quote);
                    $thread_id    = $quotes->thread_id;
                    //IN DB ITS NAMED QUOTE ID BUT ITS A REPLY ID
                    $reply_id     = $quotes->quote_id;
                    $flagged_user = $quotes->user_id;
                    $flagger_user = Auth::user()->id;
                    $prev_flags   = count(Flag::where('quote_id', $this_quote)
                        ->where('flagger_user_id', $flagger_user)
                        ->where('flagged_user_id', $flagged_user)
                        ->whereIn('status', array(1,2,4,5,7))->get());
                    if ($prev_flags == 0) {
                        $flags                  = new Flag();
                        $flags->quote_id        = $this_quote;
                        $flags->reply_id        = $reply_id;
                        $flags->thread_id       = $thread_id;
                        $flags->flagger_user_id = $flagger_user;
                        $flags->flagged_user_id = $flagged_user;
                        $flags->reason          = $reason;
                        $flags->details         = $details;
                        $flags->status          = 1;
                        if ($flags->save()) {
                            $status = 200;
                        }                        
                    } else {
                        $status = 401;
                    }
                    $total_flag_count = count(Flag::where('reply_id', $reply_id)
                        ->where('thread_id', $thread_id)
                        ->where('quote_id', $this_quote)
                        ->whereIn('status', array(1,2,4,5,7))->get());
                }
            }
            return Response::json(array(
                'status' => $status,
                'total_flag_count' => $total_flag_count
            ));
        }
    }
    
    public function postRemoveFlag()
    {
        if (Request::ajax()) {
            $status           = 400;
            $total_flag_count = null;
            if (Auth::check()) {
                $this_reply  = Input::get('this_reply');
                $this_thread = Input::get('this_thread');
                $this_quote = Input::get('this_quote');

                if ($this_quote == 'false') {
                    //IT WAS A REPLY
                    if ($this_reply != 0) {
                        $replys       = Reply::find($this_reply);
                        $flagged_user = $replys->user_id;
                    }
                    //THIS WAS A THREAD
                    else {
                        $threads      = Thread::find($this_thread);
                        $flagged_user = $threads->user_id;
                    }
                    //CHECK IF THIS USER HAS FLAGGED THIS REPLY OR THREAD BEFORE
                    $prev_flags = count(Flag::where('reply_id', $this_reply)
                        ->where('thread_id', $this_thread)
                        ->where('flagger_user_id', $this->user_id)
                        ->where('flagged_user_id', $flagged_user)
                        ->whereNull('quote_id')
                        ->whereIn('status', array(1,2,4,5,7))->get());
                    if ($prev_flags != 0) {
                        $flagss = Flag::where('reply_id', $this_reply)
                        ->where('thread_id', $this_thread)
                        ->where('flagger_user_id', $this->user_id)
                        ->where('flagged_user_id', $flagged_user)
                        ->whereNull('quote_id')
                        ->whereIn('status', array(1,2,4,5,7))->first();
                        if ($flagss->delete()) {
                            $status = 200;
                        }
                    } else {
                        $status = 402;
                    }
                    $total_flag_count = count(Flag::where('reply_id', $this_reply)
                        ->where('thread_id', $this_thread)
                        ->whereNull('quote_id')
                        ->whereIn('status', array(1,2,4,5,7))->get());
                } else { //IT WAS A QUOTE
                    $quotes       = Reply::find($this_quote);
                    $thread_id    = $quotes->thread_id;
                    //IN DB ITS NAMED QUOTE ID BUT ITS A REPLY ID
                    $reply_id     = $quotes->quote_id;
                    $flagged_user = $quotes->user_id;
                    $flagger_user = Auth::user()->id;
                    $prev_flags   = count(Flag::where('quote_id', $this_quote)
                        ->where('flagger_user_id', $flagger_user)
                        ->where('flagged_user_id', $flagged_user)
                        ->whereIn('status', array(1,2,4,5,7))->get());
                    if ($prev_flags != 0) {
                        $flagss = Flag::where('quote_id', $this_quote)
                            ->where('flagger_user_id', $flagger_user)
                            ->where('flagged_user_id', $flagged_user)
                            ->whereIn('status', array(1,2,4,5,7))->first();
                        $flagss->delete();
                    } else {
                        $status = 401;
                    }
                    $total_flag_count = count(Flag::where('reply_id', $reply_id)
                        ->where('thread_id', $thread_id)
                        ->where('quote_id', $this_quote)
                        ->whereIn('status', array(1,2,4,5,7))->get());
                }

            }
            return Response::json(array(
                'status' => $status,
                'total_flag_count' => $total_flag_count
            ));
        }
    }
    
    
    public function postSubmitLike()
    {
        
        if (Request::ajax()) {
            $status              = 400;
            $total_like_count    = null;
            $prev_dislike        = null;
            $total_dislike_count = null;
            if (Auth::check()) {
                $this_reply  = Input::get('this_reply');
                $this_thread = Input::get('this_thread');
                //IT WAS A REPLY
                if (isset($this_reply)) {
                    $replys     = Reply::find($this_reply);
                    $liked_user = $replys->user_id;
                }
                //THIS WAS A THREAD
                else {
                    $threads    = Thread::find($this_thread);
                    $liked_user = $threads->user_id;
                }
                //CHECK IF THIS USER HAS LIKED THIS REPLY OR THREAD BEFORE
                $prev_likes = count(Like::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('liker_user_id', $this->user_id)->where('liked_user_id', $liked_user)->get());
                if ($prev_likes == 0) {
                    $likes                = new Like();
                    $likes->reply_id      = $this_reply;
                    $likes->thread_id     = $this_thread;
                    $likes->liker_user_id = $this->user_id;
                    $likes->liked_user_id = $liked_user;
                    $likes->status        = 1;
                    if ($likes->save()) {
                        $status       = 200;
                        //CHECK IF DISIKE EXIST DELETE IT
                        $prev_dislike = Dislike::CountDislike($this_reply, $this_thread, $this->user_id, $liked_user);
                        if ($prev_dislike > 0) {
                            $old_dislike = Dislike::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('disliker_user_id', $this->user_id)->where('disliked_user_id', $liked_user)->first();
                            $old_dislike->delete();
                            $prev_dislike = count(Dislike::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('disliked_user_id', $liked_user)->first());
                        }
                    }
                } else {
                    $status = 401;
                }
                $total_like_count    = count(Like::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('status', 1)->get());
                $total_dislike_count = count(disLike::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('status', 1)->get());
            }
            
            
            return Response::json(array(
                'status' => $status,
                'total_like_count' => $total_like_count,
                'prev_dislike' => $prev_dislike,
                'total_dislike_count' => $total_dislike_count
            ));
        }
    }
    public function postSubmitDislike()
    {
        if (Request::ajax()) {
            $status              = 400;
            $total_dislike_count = null;
            $prev_like           = null;
            $total_like_count    = null;
            if (Auth::check()) {
                $this_reply  = Input::get('this_reply');
                $this_thread = Input::get('this_thread');
                //IT WAS A REPLY
                if (isset($this_reply)) {
                    $replys        = Reply::find($this_reply);
                    $disliked_user = $replys->user_id;
                }
                //THIS WAS A THREAD
                else {
                    $threads       = Thread::find($this_thread);
                    $disliked_user = $threads->user_id;
                }
                //CHECK IF THIS USER HAS FLAGGED THIS REPLY OR THREAD BEFORE
                $prev_dislike = count(Dislike::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('disliker_user_id', $this->user_id)->where('disliked_user_id', $disliked_user)->get());
                if ($prev_dislike == 0) {
                    $flags                   = new Dislike();
                    $flags->reply_id         = $this_reply;
                    $flags->thread_id        = $this_thread;
                    $flags->disliker_user_id = $this->user_id;
                    $flags->disliked_user_id = $disliked_user;
                    $flags->status           = 1;
                    if ($flags->save()) {
                        $status    = 200;
                        //CHECK IF DISIKE EXIST DELETE IT
                        $prev_like = Like::Countlike($this_reply, $this_thread, $this->user_id, $disliked_user);
                        if ($prev_like > 0) {
                            $old_like = Like::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('liker_user_id', $this->user_id)->where('liked_user_id', $disliked_user)->first();
                            $old_like->delete();
                            
                            $prev_like = count(Like::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('liked_user_id', $disliked_user)->get());
                        }
                    }
                } else {
                    $status = 401;
                }
                
                $total_dislike_count = count(Dislike::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('status', 1)->get());
                $total_like_count    = count(like::where('reply_id', $this_reply)->where('thread_id', $this_thread)->where('status', 1)->get());
            }
            return Response::json(array(
                'status' => $status,
                'total_dislike_count' => $total_dislike_count,
                'total_like_count' => $total_like_count,
                'prev_like' => $prev_like
            ));
        }
    }
    
    public function postInpageSearch()
    {
        $status       = 200;
        //FIND SEARCH RESULTS
        $search_query = Job::FilterSpecialCharacters(Input::get('searched_text'));
        
        $searched_results_html = '<h4>You searched for : ' . $search_query . '</h4> ';
        
        if (!empty($search_query)) {
            $search_results = Search::index_search_function($search_query);
            if (!empty($search_results)) {
                $searched_results_html = Thread::prepareSearchedResults($search_results);
            } else {
                $searched_results_html .= '"' . $search_query . '" Did not match any threads.';
                $searched_results_html .= '<hr><h4>Suggestions:</h4>
                            <ul>
                            <li>Make sure all words spelled correctly</li>
                            <li>Try diffrent or fewer words</li>
                            </ul> 
                            <h4 class="other-thread">Other threads:</h4><hr>';
            }
        }
        //ALL THREADS
        $prepared_thread       = Thread::prepareThreadForView(Thread::whereIn('status', array(1,2,4,5,7))
            ->orderBy('created_at', 'DESC')->paginate(10));
        $prepared_thread_clone = Thread::whereIn('status', array(1,2,4,5,7))
        ->orderBy('created_at', 'DESC')->paginate(10);
        $this->layout          = 'layouts.master-layout';
        
        return Response::json(array(
            'status' => $status,
            'searched_results_html' => $searched_results_html,
            'prepared_thread' => $prepared_thread
        ));
        
    }
    
    
    public function postPreviewMessage()
    {
        $status          = 400;
        $this_answer     = Input::get('this_text');
        $check_empty_set = Job::CheckEmptySet($this_answer);
        if ($check_empty_set == true) {
            $status       = 200;
            $preview_html = Reply::preparePreviewMessage($this_answer);
        }
        
        return Response::json(array(
            'status' => $status,
            'preview_html' => $preview_html
        ));
        
    }
    public function postSetSetting()
    {
        if (Request::ajax()) {
            $status              = 400;
            $notify_me_condition = Input::get('notify_me_condition');
            $this_thread         = Input::get('this_thread');
            if (isset($notify_me_condition, $this_thread)) {
                $threads = Thread::find($this_thread);
                if (Auth::user()->id == $threads->user_id) {
                    $threads->notify_me = $notify_me_condition;
                    if ($threads->save()) {
                        $status = 200;
                    }
                }
            }
            return Response::json(array(
                'status' => $status
            ));
        }
    }
    public function postSettingFrom()
    {
        $notify_me_condition = Input::get('notify_me');
        $thread_status       = Input::get('thread_status');
        $this_thread         = Input::get('thread_id');
        
        if (isset($this_thread)) {
            $threads = Thread::find($this_thread);
            if (Auth::user()->id == $threads->user_id) {
                //NOTIFY_ME
                if (isset($notify_me_condition)) {
                    $threads->notify_me = $notify_me_condition;
                } else {
                    $threads->notify_me = 0;
                }
                //THREAD-STATUS
                if (isset($thread_status)) {
                    switch ($thread_status) {
                        case '1':
                            $threads->status = 1;
                            break;
                        case '2':
                            $threads->status = 7;
                            break;
                    }
                }
            }
            if ($threads->save()) {
                Flash::success('Successfully Saved');
                return Redirect::back();
            }
        } else {
            Flash::error('Error');
            return Redirect::back();
        }
    }
    
}