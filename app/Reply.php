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
			$flagger_user_id = -999;
			$all_quotes = Reply::where('quote_id',$reply_id)->get();
			$idx = 0;
			foreach ($all_quotes as $aqkey => $aqvalue) {


				if ($aqvalue->status != 3) {
					$idx++;
					$aqvalue->reply = json_decode($aqvalue->reply);
					$expend_icon = '';
					$this_replier = User::find($aqvalue->user_id);
					$this_replier_username = $this_replier->username;

					//TIME AGO
					$quote_data = date(strtotime($aqvalue->created_at));
					$time_ago_replies = Job::formatTimeAgo(Job::humanTiming($quote_data));
					if (Auth::check()) {
						$flagger_user_id = Auth::user()->id;
		            }
					$flag_count = count(Flag::where('quote_id', $aqvalue->id)
	                        ->where('flagger_user_id', $flagger_user_id)
	                        ->where('flagged_user_id', $aqvalue->user_id)
	                        ->whereIn('status', array(1,2,4,5,7))->get());
					$isflagged = false;
					if ($flag_count > 0) {
						$isflagged = true;
					}

					//CHECKS IF USER HAS REJECTED OR FINAL REJECTED FLAGS
					$is_flagging_Banned = false;
					$flag_rejected = 0;
					$flag_rejected = count(Flag::where('quote_id', $aqvalue->id)
                        ->where('flagger_user_id', $flagger_user_id)
                        ->where('flagged_user_id', $aqvalue->user_id)
                        ->whereIn('status', array(3,6))->get());
					if ($flag_rejected > 0) {
						$is_flagging_Banned = true;
					}


					
					$is_this_user = Job::IsThisUser($aqvalue->user_id);
			        $html .=  '<a  class="list-group-item right-data ind-quotes" expended="0" this_quote="'.$aqvalue->id.'">
					            <span class="message-header"><span class="badge">'.$idx.'</span>';
					            
					 if ($is_this_user) {
						$html .= '<span class="message-sender auth-name-color" id="">&nbsp'.$this_replier_username.'</span> <small><span class="quote-details">- '.$time_ago_replies.'</span></small>';
					 } else {
						$html .= '<span class="message-sender " id="">&nbsp'.$this_replier_username.'</span> <small><span class="quote-details">- '.$time_ago_replies.'</span></small>';
					 }

					if ($is_this_user == false) {
						if ($is_flagging_Banned == false) {
							if ($isflagged == true) {
								$html .= '&nbsp<i class=" quote-flags glyphicon glyphicon-flag flag-checked"></i>';
							} else {
								$html .= '&nbsp<i class=" quote-flags glyphicon glyphicon-flag"></i>'; 
							}
						}
					}

			        $html .=   '</br></span>
						            <span class="message-body">
										<p>'.$aqvalue->reply.'</p>
						            </span>
						          </a>';
				} else {
						$been_removed = Reply::FlaggedQuotePlaceholder();
						$html .= $been_removed;
				}







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
							  <button type="button" class="first-btn btn btn-default btn-panel-single show-quote" style="width: 33.333333333333%"><i class="fa fa-quote-right"></i></br><span class="inner-val">0</span></button>
							  <button type="button" class="btn btn-default btn-panel-single eye-like" style="width: 33.333333333333%"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">0</span></button>
							  <button type="button" class="btn btn-default btn-panel-single dont-like" style="width: 33.333333333333%"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">0</span></button>
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

	static public function 	preparePostedQuote($this_quote,$this_quote_id,$this_thread,$actual_quote_id) {
		$html = '';
		//HERE THIS QUOTE IS ACTUALY REPLY ID
		$expend_icon = '';
		if (isset($this_quote)) {
			$this_user = User::find(Auth::user()->id);
			$this_username = $this_user->username;

			//NUMBER OF QUOTES
			$quote_count = count(Reply::where('quote_id',$this_quote_id)->get());
			$new_quote_count = $quote_count;

	        $html .=  '<a  class="list-group-item right-data ind-quotes" expended="0" this_quote="'.$actual_quote_id.'">
			            <span class="message-header"><span class="badge">'.$new_quote_count.'</span>
			              <span class="message-sender auth-name-color" id="">'.$this_username.'</span> <small><span class="quote-details"> - Just now</span></small>
			            </br></span>
			            <span class="message-body">
							<p>'.$this_quote.'</p>
			            </span>
			          </a>';

		}
		return $html;
	}

	static public function preparePreviewMessage($this_text) {
		$html = '';
		if (isset($this_text)) {
			$this_user = User::find(Auth::user()->id);
			$this_username = $this_user->username;
	        $html .=  '<div  class="list-group-item" id="preview-modal-wrapper">
			            <span class="message-header">
			              <span class="message-sender">'.$this_username.'</span> <span class="quote-details"> - Just now</span>
			            </br></span>
			            <span class="message-body" id="preview-modal-body">
							'.$this_text.'
			            </span>
			          </div>';
		}
		return $html;
	}

	public static function FlaggedQuotePlaceholder() {
    	$p = '<div class="thread-single quote-single-flagged" >
					<div id="message-overlay" > 
			    		<p class="bg-danger q-flagged" >&nbspThis quote has been removed</p>
			    	</div>
		   		</div>
		    ';
        return $p;
    }
}
