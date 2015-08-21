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
				$expend_icon = '';
				$this_replier = User::find($aqvalue->user_id);
				$this_replier_username = $this_replier->username;
				$quote_data = strtotime($aqvalue->created_at);
				$quote_data_formated = date("l, F j, Y, h:i a",$quote_data);
				if (strlen($aqvalue->reply) > 160) {
					$expend_icon = '<span class="more fa fa-expand"></span>';
				}
		        $html .=  '<a  class="list-group-item right-data" expended="0">
				            <span class="message-header">
				              <span class="message-sender" id="">'.$this_replier_username.'</span> <span class="quote-details">- '.$quote_data_formated.'</span>
				            </br></span>
				            <span class="message-body">
								<p>'.$aqvalue->reply.'</p>
				               	'.$expend_icon.'
				            </span>
				          </a>';
			}
		}
		return $html;
	}

		static public function 	preparePostedAnswer($this_answer,$reply_id,$thread_id) {
		$html = '';
		if (isset($this_answer)) {
			$this_user = User::find(Auth::user()->id);
			$this_username = $this_user->username;

			//PROFILE IMAGE
			$profile_image = Job::imageValidator($this_user->profile_image);

	        $html .=  '
					    <div class="panel-btn-sm pull-right panel-parent reply-sm-'.$reply_id.'">
							<div class="btn-group" role="group" aria-label="...">
							  <button type="button" class="first-btn btn btn-default btn-panel-single show-quote"><i class="fa fa-quote-right"></i></br><span class="inner-val">0</span></button>
							  <button type="button" class="btn btn-default btn-panel-single eye-like"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">0</span></button>
							  <button type="button" class="btn btn-default btn-panel-single dont-like"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">0</span></button>
							  <button type="button" class="last-btn btn btn-default btn-panel-single flag-it"><i class="glyphicon glyphicon-flag"></i></br><span class="inner-val">0</span></button>
							</div>
			            </div>
				        <div class="thread-single">
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
	                    				<div class="panel-btn-bg pull-right panel-parent reply-sm-'.$reply_id.'" this_reply="'.$reply_id.'" this_thread="'.$thread_id.'">
											<div class="btn-group" role="group" aria-label="...">
											  <button type="button" class="btn btn-default btn-panel-single show-quote"><i class="fa fa-quote-right"></i></br><span class="inner-val">0</span></button>
											  <button type="button" class="btn btn-default btn-panel-single eye-like"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">0</span></button>
											  <button type="button" class="btn btn-default btn-panel-single dont-like"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">0</span></button>
											</div>
					                    </div>
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
		$expend_icon = '';
		if (isset($this_quote)) {
			$this_user = User::find(Auth::user()->id);
			$this_username = $this_user->username;

			$time = date('l, F j, Y, h:i a');


			if (strlen($this_quote) > 194) {
				$expend_icon = '<span class="more fa fa-expand"></span>';
			}

	        $html .=  '<a  class="list-group-item right-data" expended="0">
				            <span class="message-header">
				              <span class="message-sender" id="">'.$this_username.'</span> <span class="quote-details">- '.$time.'</span>
				            </br></span>
				            <span class="message-body">

								<p>'.$this_quote.'</p>
				              	'.$expend_icon.' 
				            </span>
				          </a>';
		}
		return $html;
	}
}
