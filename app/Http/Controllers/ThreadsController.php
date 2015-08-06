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
use Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\Reply;
use App\Search;
use App\User;
use App\Thread;
use App\Category;


class ThreadsController extends Controller
{
    public function __construct() {

        // $this->layout = "layouts.test";

        //FIRST TEMPLATE
        // $this->layout = "layouts.master";

        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";

        // // THIRD TEMPLATE
        $this->layout = 'layouts.master-layout';
   
    }


    public function getAdd()
    {

    }
    public function postAdd()
    {
        $sanitized_data = Job::sanitize(Input::all());
        $question = $sanitized_data['question'];
        $notify_me = isset($sanitized_data['notify-me'])?$sanitized_data['notify-me']:0;
        $categories = isset($sanitized_data['categories'])?json_encode($sanitized_data['categories']):null;

        $title = $question['title'];
        $description = $question['description'];

        $thread = new Thread;
        $thread->user_id = Auth::user()->id;
        $thread->title = $title;
        $thread->description = $description;
        $thread->categories = $categories;
        $thread->notify_me = $notify_me;
        $thread->status = 1;

        if($thread->save()) { // Save the user and redirect to freelancers home
            return Redirect::back();
        }
    }
    public function getView($id)
    {
        $threads = Thread::find($id);
        //ADD TO THE VIEWS
        $views_before = $threads->views;
        $views_after = $views_before + 1;
        $threads->views = $views_after;
        $threads->save();
        $threads_html = Thread::prepareThreadsAndThreadReply($threads);
        $this_user_profile_image = User::CheckForProfileImage();
        return view('threads.view')
            ->with('layout',$this->layout)
            ->with('threads',$threads)
            ->with('threads_html',$threads_html)
            ->with('this_user_profile_image',$this_user_profile_image);
    }
    public function postSearchQuery()
    {
        if(Request::ajax()){
            $status = 200;
            $search_query = Input::get('search_text');
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

    public function postRetriveQuotes()
    {
        if(Request::ajax()){
            $status = 200;
            $reply_id = Input::get('this_reply');
            $quotes_html = Reply::PrepareQuotesForView($reply_id);
            return Response::json(array(
                'status' => $status,
                'quotes_html' => $quotes_html
            ));
        }
    }

    public function postPostAnswer()
    {
        if(Request::ajax()){
            $status = 400;
            $answer_html = 'Not Authorized';
            if (Auth::check()) {
                $this_answer = Job::sanitize(Input::get('this_answer'));
                $this_thread = Input::get('this_thread');
                $answer_html = Reply::preparePostedAnswer($this_answer);
                $reply = new Reply;
                $reply->thread_id = $this_thread;
                $reply->user_id = Auth::user()->id;
                $reply->reply = $this_answer;
                $reply->status = 1;
                $reply->quote_id = null;
                $reply->eye_likes = 0;
                $reply->dont_likes = 0;
                $reply->flag = 0;
                if ($reply->save()) {
                    $status = 200;
                }
            }
            return Response::json(array(
                'status' => $status,
                'answer_html' =>$answer_html
            ));
        }
    }

        public function postPostQuote()
    {
        if(Request::ajax()){
            $status = 400;
            $this_answer = Job::sanitize(Input::get('this_answer'));
            $this_quote = Input::get('this_quote');
            $this_thread = Input::get('this_thread');


            $quote_html = Reply::preparePostedQuote($this_answer);

            $quote = new Reply;
            $quote->thread_id = $this_thread;
            $quote->user_id = Auth::user()->id;
            $quote->reply = $this_answer;
            $quote->status = 1;
            $quote->quote_id = $this_quote;
            $quote->eye_likes = 0;
            $quote->dont_likes = 0;
            $quote->flag = 0;

            if ($quote->save()) {
                $status = 200;
            }

            $quote_count = count(Reply::where('quote_id',$this_quote)->get());

            return Response::json(array(
                'status' => $status,
                'quote_html' => $quote_html,
                'quote_count' => $quote_count
            ));
        }
    }
    
}
