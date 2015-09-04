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
        $task_comments = TaskComment::where('task_id',$id)->get();
        $html = '';
        if($task_comments) {
            foreach ($task_comments as $tckey => $tcvalue) {
                $users = User::find($tcvalue->user_id);
                $username = $users->username;

                $profile_image = Job::imageValidator($users->profile_image);

                $time_s = date(strtotime($tcvalue['created_at']));
                $time_ago = Job::formatTimeAgo(Job::humanTiming($time_s));

                

                $html .= '<div class="task-comment-single">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                    </a>
                                </div>
                                <div class="media-body">  
                                    <h5 class="media-heading">'.$username.' - '.$time_ago.'</h5>
                                    <p class="comment-text">'.json_decode($tcvalue->comment).'</p>
                                </div>
                            </div>
                        </div>';
            }
        }
        return $html;
    }

}
