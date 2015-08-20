<?php

namespace App\Http\Controllers;

use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Admin;
use App\Flag;
use App\FlagLog;
use App\Role;
use App\Reply;
use App\Thread;
use App\Permission;
use App\PermissionRole;

class FlagsController extends Controller
{
     public function __construct() {

        // Define layout
        $this->layout = 'layouts.admins';
        $this_username = null;
        //PROFILE IMAGE
        $this_user_profile_image = null;
        if (Auth::check()) {
            $this_user = User::find(Auth::user()->id);
            $this_username = $this_user->username;
            //PROFILE IMAGE
            $this_user_profile_image = Job::imageValidator($this_user->profile_image);
        } 
        View::share('this_username',$this_username);
        View::share('this_user_profile_image',$this_user_profile_image);
    }


    public function getIndex()
    {
        $flags = Flag::PrepareAllFlagsSum(1);
            return view('flags.index')
            ->with('layout',$this->layout)
            ->with('flags',$flags);
    }
    public function getApproved()
    {
        $flags = Flag::PrepareAllFlagsSum(2);
            return view('flags.index')
            ->with('layout',$this->layout)
            ->with('flags',$flags);
    }
    public function getRejected()
    {
        $flags = Flag::PrepareAllFlagsSum(3);
            return view('flags.index')
            ->with('layout',$this->layout)
            ->with('flags',$flags);
    }
    public function getReFlagged()
    {
        $flags = Flag::PrepareAllFlagsSum(4);
            return view('flags.index')
            ->with('layout',$this->layout)
            ->with('flags',$flags);
    }
    public function getFinalApproved()
    {
        $flags = Flag::PrepareAllFlagsSum(5);
            return view('flags.index')
            ->with('layout',$this->layout)
            ->with('flags',$flags);
    }
    public function getFinalRejected()
    {
        $flags = Flag::PrepareAllFlagsSum(6);
            return view('flags.index')
            ->with('layout',$this->layout)
            ->with('flags',$flags);
    }
    public function getBanned()
    {
        $flags = Flag::PrepareAllFlagsSum(7);
            return view('flags.index')
            ->with('layout',$this->layout)
            ->with('flags',$flags);
    }
    public function getView($id = null)
    {   
        //GET ONE OF MAY FLAGS 
        $flags = Flag::find($id);

        //GET THREAD_ID AND REPLY_ID
        $thread_id = $flags->thread_id;
        $reply_id = $flags->reply_id;

        $flag_log = FlagLog::where('thread_id',$thread_id)->where('reply_id',$reply_id)->get();
        foreach ($flag_log as $flogkey => $flogvalue) {
          $flogvalue['username'] = Job::IdToUsername($flogvalue->user_id);
          $flogvalue['date'] = date('n/d/Y g:ia',strtotime($flogvalue->created_at));
          $flogvalue['flag_status'] = Flag::PrepareStatus($flogvalue->flag_status);
        }

        $comment = null;
        $comment_output = [];
        $comment_output['type'] = 'reply';
        if ($reply_id == 0) {
          $comment_output['type'] = 'thread';
          $comment = Thread::find($thread_id);
          $comment['date'] = date('n/d/Y g:ia',strtotime($comment->created_at));
          $comment['username'] = Job::IdToUsername($comment->user_id);
        } else {
          $comment = Reply::find($reply_id);
          $comment['date'] = date('n/d/Y g:ia',strtotime($comment->created_at));
          $comment['username'] = Job::IdToUsername($comment->user_id);
        }

        $all_flags = Flag::where('reply_id',$reply_id)->where('thread_id',$thread_id)->get();

        foreach ($all_flags as $allfkey => $allfvalue) {
            $allfvalue['date'] = date('n/d/Y g:ia',strtotime($allfvalue->created_at));
            $allfvalue['reason'] = Flag::PrepareReasons($allfvalue->reason);
            $allfvalue['details'] = $allfvalue->details;
            $allfvalue['flagger_username'] = Job::IdToUsername($allfvalue->flagger_user_id);
            $allfvalue['flagged_username'] = Job::IdToUsername($allfvalue->flagged_user_id);
        }
        $all_flags_count = count(Flag::where('reply_id',$reply_id)->where('thread_id',$thread_id)->get());
        return view('flags.view')
            ->with('layout',$this->layout)
            ->with('comment',$comment)
            ->with('all_flags',$all_flags)
            ->with('all_flags_count',$all_flags_count)
            ->with('comment_output',$comment_output)
            ->with('flag_logs',$flag_log);
    }

        public function postView()
    {   
       $thread_id = Input::get('thread_id');
       $reply_id = Input::get('reply_id');
       $action = Input::get('action');
       $reason = Input::get('reason');

       $new_status = null;

       $all_flags = Flag::where('reply_id',$reply_id)->where('thread_id',$thread_id)->get();

        // flags-status :
        // 1: pending
        // 2: first approved 
        // 3: first rejection
        // 4: re-flagged
        // 5: final approved
        // 6: final rejection
        // 7: perm banned, out 

        // thread/reply-status:
        // 1: active (3) (6)
        // 2: pending for flag (1) 
        // 3: has been flagged (2) (5)
        // 4: message has been banned (7) 
        // 5: message has been deleted by user
        // 6: message has been removed by admin
       switch ($action) {
           case 2://APPROVED
               $new_status = 3;
               break;
           case 5://FINAL APPROVE
               $new_status = 3;
               break;
           case 3://REJECT
               $new_status = 1;
               break;
           case 6://FINAL REJECT
               $new_status = 1;
               break;
           case 7://BANNED
               $new_status = 4;
               break;
           default:
               # code...
               break;
       }

       //CHANGING THE MAIN MESSAGE STATUS
       if ($reply_id == 0) {//IT WAS A THREAD
            $this_thread = Thread::find($thread_id);
            $this_thread->status = $new_status;
            $this_thread->save();
       } else { //IT WAS A REPLY
            $this_reply = Reply::find($reply_id);
            $this_reply->status = $new_status;
            $this_reply->save();
       }

       //CHANGE ALL THE FLAGS STATUS
       foreach ($all_flags as $alkey => $alvalue) {
            $alvalue->status = $action;
            $alvalue->save();
       }

       //SAVE INTO LOG FILE
       $flag_log = new FlagLog;
       $flag_log->thread_id = $thread_id;
       $flag_log->reply_id = $reply_id;
       $flag_log->user_id = Auth::user()->id;
       $flag_log->reason = $reason;
       $flag_log->flag_status = $action;
       $flag_log->status = 1;
       if ($flag_log->save()) {
          Flash::success('Successfully saved!');
       }
       return Redirect::action('FlagsController@getIndex');
    }
}
