<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Job;
use App\Reply;
use App\Flag;
use Auth;

class Thread extends Model
{
	static public function prepareThreadForView($data) {
		$html = '' ;
		if (isset($data)) {
			foreach ($data as $dakey => $davalue) {

				$users = User::find($davalue->user_id);
				$username = $users->username;

				$profile_image = Job::imageValidator($users->profile_image);

				$categories_j = json_decode($davalue->categories);
				$categories_prepared = Thread::prepareCategories($categories_j);

				$time_s = date(strtotime($davalue['created_at']));
				$time_ago = Job::formatTimeAgo(Job::humanTiming($time_s));

				$html .= '<div class="thread-single">
							        <div class="media">
							          <div class="media-left">
							            <a href="#">
							              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
							            </a>
							          </div>
							          <div class="media-body">
							            <div class="media-inner-left">
							              <h4 ><a href="/threads/view/'.$davalue->id.'">'.$davalue->title.'</a></h4>
							              <div class="thread-info">'.$username.' . 
							                <span class="thread-date">'.$time_ago.'</span>
							              	
							              </div> 
							            </br>
							            <div class="label-container">
											'.$categories_prepared.'
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


	static public function prepareSearchedResults($search_results) {
		$html = '<h4>Your Search Results : </h4>';

		foreach ($search_results as $srkey => $srvalue) {

				$davalue = Thread::find($srkey);

				$users = User::find($davalue->user_id);
				$username = $users->username;

				$profile_image = Job::imageValidator($users->profile_image);

				$categories_j = json_decode($davalue->categories);
				$categories_prepared = Thread::prepareCategories($categories_j);

				$time_s = date(strtotime($davalue['created_at']));
				$time_ago = Job::formatTimeAgo(Job::humanTiming($time_s));

				$html .= '<div class="thread-single">
							        <div class="media">
							          <div class="media-left">
							            <a href="#">
							              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
							            </a>
							          </div>
							          <div class="media-body">
							            <div class="media-inner-left">
							              <h4 ><a href="/threads/view/'.$davalue->id.'">'.$davalue->title.'</a></h4>
							              <div class="thread-info">'.$username.' . 
							                <span class="thread-date">'.$time_ago.'</span>
							              	
							              </div> 
							            </br>
							            <div class="label-container">
											'.$categories_prepared.'
							            </div>
							          </div>
							          <div class="media-inner-right">
							            <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">'.$davalue->views.'</span></div>
							          </div>
							        </div>
							      </div>
							    </div>';
		}

		$html .= '<hr><h4>Other threads:</h4><hr>';
		return $html;
	}









	static public function prepareCategories($cat) {
		$cat_html = '';
		if (isset($cat)) {
			$categories_name = null;
			foreach ($cat as $cakey => $cavalue) {
				$categories = Category::find($cavalue);
				$cat_html .= '<span class="label label-default label-style">'.$categories['name'].'</span>';
			}
		}
		return $cat_html;
	}
	static public function prepareCategoriesForFeedback($cat) {
		$cat_html = '<h4>You searched for : </h4>';
		if (isset($cat)) {
			$count = 1;
			$categories_name = null;
			$cat_size = sizeof($cat);
			$new_size = ($cat_size - 1);
				if ($cat_size == 1) {
					foreach ($cat as $cakey => $cavalue) {
						$categories = Category::find($cavalue);
						$cat_html .= '<strong><span>'.$categories['name'].' - </span></strong>';
					}
				} else {
					foreach ($cat as $cakey => $cavalue) {
						$categories = Category::find($cavalue);
						if ($count < $cat_size) {
							$cat_html .= '<strong><span>'.$categories['name'].', </span></strong>';
						} else{
							$cat_html .= '<strong><span>'.$categories['name'].' - </span></strong>';				
						}
						$count++;
					}
				}
		}
		$cat_html .= 'did not match any threads.';
		$cat_html .= '<hr><h4>Suggestions:</h4>
						<ul>
						  <li>Make sure all categories are chosen correctly</li>
						  <li>Try Selecting fewer categories</li>
						</ul> 
		';
		return $cat_html;
	}

	static public function prepareCategoriesAfterSearch($cat,$item_selected) {
		$cat_html = '';
		if (isset($cat)) {
			$categories_name = null;
			foreach ($cat as $cakey => $cavalue) {
				$categories = Category::find($cavalue);
				$check_match = false;
				foreach ($item_selected as $sikey => $sivalue) {
					if ($cavalue == $sivalue) {
						$cat_html .= '<span class="label label-primary label-style">'.$categories['name'].'</span>';
						$check_match = true;
						break;
					} else {
						continue;
					}
				}
				if($check_match == false) {
					$cat_html .= '<span class="label label-default label-style">'.$categories['name'].'</span>';
				}
			}
		}
		return $cat_html;
	}


	static public function prepareThreadsAndThreadReply($threads) {
		$html = '' ;
		if (isset($threads)) {
			$this_user = User::find($threads->user_id);
			$this_main_username = $this_user->username;

			//TIME AGO
			$time_s = date(strtotime($threads['created_at']));
			$time_ago_main = Job::formatTimeAgo(Job::humanTiming($time_s));

			//PROFILE IMAGE
			$profile_image = Job::imageValidator($this_user->profile_image);

			//FLAGS COUNT
			$main_flag_count = count(Flag::where('reply_id',0)
						->where('thread_id',$threads->id)
						->get());

			$is_owner = false;
			$setting_icon = '';
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


			//PREPARING THE MAIN THREADS
			$html .= '<div class="thread-single" id="main-thread">
				            <div class="media">
				              <div class="media-left">
				                <a href="#">
				                  <img class="media-object media-image" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
				                </a>
				              </div>
				              <div class="media-body">
				                <div class="media-inner-left">
				                  <div class="thread-info"> <span class="quoter-username">'.$this_main_username.'</span>
				                    <span class="thread-date">'.$time_ago_main.'</span>
				                    	'.$setting_icon.'
		                    			<div class="panel-btn-bg pull-right panel-parent" this_reply="0" this_thread="'.$threads->id.'">
											<div class="btn-group" role="group" aria-label="...">
											  <button type="button" class="btn btn-default btn-panel-single flag-it"><i class="glyphicon glyphicon-flag"></i></br><span class="inner-val">'.$main_flag_count.'</span></button>
											</div>
					                    </div>
				                  </div> 
				                  <h4 ><a href="/threads/view/'.$threads->id.'">'.$threads->title.'</a></h4>
				                </br>
				                <div class="thread-description">
									'.$threads->description.'
				                </div>
				                  <div class="label-container">
				                  </div>
				                </div>
				              </div>
				            </div>
				          </div>';

				          if ($is_owner == true) {
				          	$html .= '<div class="modal fade" id="thread_setting">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title">Thread Setting</h4>
								      </div>
								      <hr>
								      <div class="modal-body">
										  <div class="checkbox">
										    <label>
										      <input type="checkbox" id="notify_me_checkbox" '.$checked.'> Notify Me
										    </label>
										  </div>
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->';
				          }

			//GET ALL REPLIES
			$all_replies = Reply::where('thread_id',$threads->id)
				->where('quote_id',null)
				->get();
			foreach ($all_replies as $arkey => $arvalue) {

				$this_replier = User::find($arvalue->user_id);
				$this_replier_username = $this_replier->username;

				//TIME AGO
				$time_s_r = date(strtotime($arvalue['created_at']));
				$time_ago_replies = Job::formatTimeAgo(Job::humanTiming($time_s_r));

				//PROFILE IMAGE
				$replier_profile_image = Job::imageValidator($this_replier->profile_image);

				//NUMBER OF QUOTES
				$quote_count = count(Reply::where('quote_id',$arvalue->id)->get());

				//FLAGS COUNT
				$flag_count = count(Flag::where('reply_id',$arvalue->id)
											->where('thread_id',$threads->id)
											->get());

				// LIKES
				$like_count = count(Like::where('reply_id',$arvalue->id)
											->where('thread_id',$threads->id)
											->get());


				// DISLIKES
				$dislike_count = count(Dislike::where('reply_id',$arvalue->id)
											->where('thread_id',$threads->id)
											->get());


				//PREPARE ALL REPLIES
				$html .= '
								    <div class="panel-btn-sm pull-right panel-parent reply-sm-'.$arvalue->id.'" this_reply="'.$arvalue->id.'" this_thread="'.$threads->id.'">
										<div class="btn-group" role="group" aria-label="...">
										  <button type="button" class="first-btn btn btn-default btn-panel-single show-quote"><i class="fa fa-quote-right"></i></br><span class="inner-val">'.$quote_count.'</span></button>
										  <button type="button" class="btn btn-default btn-panel-single eye-like"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">'.$like_count.'</span></button>
										  <button type="button" class="btn btn-default btn-panel-single dont-like"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">'.$dislike_count.'</span></button>
										  <button type="button" class="last-btn btn btn-default btn-panel-single flag-it"><i class="glyphicon glyphicon-flag"></i></br><span class="inner-val">'.$flag_count.'</span></button>
										</div>
				                    </div>
									<div class="thread-single">
							            <div class="media">
							              <div class="media-left">
							                <a href="#">
							                  <img class="media-object media-image" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$replier_profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
							                </a>
							              </div>
							              <div class="media-body">
							                <div class="media-inner-left">
							                  <div class="thread-info"><span class="quoter-username">'.$this_replier_username.' </span>
							                    <span class="thread-date">'.$time_ago_replies.'</span>
							                    <div class="panel-btn-bg pull-right panel-parent reply-bg-'.$arvalue->id.'"  this_reply="'.$arvalue->id.'" this_thread="'.$threads->id.'">
													<div class="btn-group  role="group" aria-label="...">
													  <button type="button" class="btn btn-default btn-panel-single show-quote"><i class="fa fa-quote-right"></i></br><span class="inner-val">'.$quote_count.'</span></button>
													  <button type="button" class="btn btn-default btn-panel-single eye-like"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">'.$like_count.'</span></button>
													  <button type="button" class="btn btn-default btn-panel-single dont-like"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">'.$dislike_count.'</span></button>
													  <button type="button" class="btn btn-default btn-panel-single flag-it"><i class="glyphicon glyphicon-flag"></i></br><span class="inner-val">'.$flag_count.'</span></button>
													</div>
							                    </div>
							                  </div> 
							                </br>
							                <div class="thread-description">
												'.$arvalue->reply.'
							                  </div>
							                  <div class="label-container">
							                  </div>
							                </div>
							              </div>
							            </div>
							          </div>';
			}

	
		}
		return $html;
	}


}
