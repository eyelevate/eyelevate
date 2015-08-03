<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Job;
use Auth;

class Reply extends Model
{
	static public function PrepareQuotesForView($reply_id) {
		$html = '';
		if (isset($reply_id)) {
			$all_quotes = Reply::where('quote_id',$reply_id)->get();
			foreach ($all_quotes as $aqkey => $aqvalue) {
				$this_replier = User::find($aqvalue->user_id);
				$this_replier_username = $this_replier->username;

				$quote_data = strtotime($aqvalue->created_at);
				$quote_data_formated = date("l, F j, Y, h:i a",$quote_data);

		        $html .=  '<a  class="list-group-item right-data" expended="0">
				            <span class="message-header">
				              <span class="message-sender" id="">'.$this_replier_username.'</span> <span class="quote-details">- '.$quote_data_formated.'</span>
				            </br></span>
				            <span class="message-body">
				              <span class="btn btn-primary view-quote">view</span>
								'.$aqvalue->reply.'
				              <span class="more fa fa-expand"></span> 
				            </span>
				          </a>';
			}
		}
		return $html;
	}

		static public function 	preparePostedAnswer($this_answer) {
		$html = '';
		if (isset($this_answer)) {
			$this_user = User::find(Auth::user()->id);
			$this_username = $this_user->username;

			//PROFILE IMAGE
			$profile_image = Job::imageValidator($this_user->profile_image);

	        $html .=  '<div class="thread-single">
				            <div class="media">
				              <div class="media-left">
				                <a href="#">
				                  <img class="media-object media-image" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
				                </a>
				              </div>
				              <div class="media-body">
				                <div class="media-inner-left">
				                  <div class="thread-info">'.$this_username.' 
				                    <span class="thread-date">Just now</span>
				                  </div> 
				                </br>
				                <div class="thread-description">
									'.$this_answer.'
				                  </div>
				                  <div class="label-container">
				                  </div>
				                </div>
				              </div>
				            </div>
				          </div>';
		}
		return $html;
	}

		static public function 	preparePostedQuote($this_quote) {
		$html = '';
		if (isset($this_quote)) {
			$this_user = User::find(Auth::user()->id);
			$this_username = $this_user->username;

			$time = date('l, F j, Y, h:i a');

	        $html .=  '<a  class="list-group-item right-data" expended="0">
				            <span class="message-header">
				              <span class="message-sender" id="">'.$this_username.'</span> <span class="quote-details">- '.$time.'</span>
				            </br></span>
				            <span class="message-body">
				              <span class="btn btn-primary view-quote">view</span>
								'.$this_quote.'
				              <span class="more fa fa-expand"></span> 
				            </span>
				          </a>';
		}
		return $html;
	}
}
