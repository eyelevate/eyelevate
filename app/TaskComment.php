<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_comments';

    /**
    * get prepareForView
    * @param $id - task id
    * @return array
    **/
    static public function prepareForView($id) {
        $task_comments = TaskComment::where('task_id','=',$id)->get();
        if($task_comments) {
        	foreach ($task_comments as $key => $value) {
	            if(isset($task_comments[$key]['user_id'])) {
	                $users = User::find($value->user_id);
	                $task_comments[$key]['username'] = $users->username;
	            }        		
				if(isset($task_comments[$key]['comment'])) {
					$task_comments[$key]['comment'] = json_decode($value->comment);
				}
	            if(isset($task_comments['created_at'])) {
	                $task_comments['created_date'] = date('F n/d/Y g:ia',strtotime($value->created_at));
	            }
        	}


        }
        return $task_comments;
    }

}
