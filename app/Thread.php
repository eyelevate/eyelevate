<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Thread extends Model
{
	static public function prepareThreadForView($data) {
		$html = '' ;
		if (isset($data)) {
			foreach ($data as $dakey => $davalue) {
				$categories = json_decode($davalue->categories);
				$users = User::find($davalue->user_id);
				$username = $users->username;

				$html .= '      <div class="thread-single">
							        <div class="media">
							          <div class="media-left">
							            <a href="#">
							              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
							            </a>
							          </div>
							          <div class="media-body">
							            <div class="media-inner-left">
							              <h4 class="media-heading">'.$davalue->title.'</h4>
							              <div class="thread-info">'.$username.' . 
							                <span class="thread-date">1 hours ago</span>
							              </div> 
							            </br>
							            <div class="label-container">
							              <span class="label label-default">Business</span>
							              <span class="label label-default">Social</span>
							              <span class="label label-default">Politics</span>
							            </div>
							          </div>
							          <div class="media-inner-right">
							            <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">'.$davalue->views.'</span></div>
							          </div>
							        </div>
							      </div>
							    </div>';
			}
		}
		return $html;
	}


}
