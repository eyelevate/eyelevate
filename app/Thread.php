<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Job;

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
				$time_ago = Thread::humanTiming($time_s);
				if ($time_ago == null) {
					$time_ago = 'just now';
				} else {
					$time_ago = $time_ago.' ago';
				}

		$html .= '<div class="thread-single">
					        <div class="media">
					          <div class="media-left">
					            <a href="#">
					              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
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

	static public function humanTiming ($time)
	{

	    $time = time() - $time; // to get the time since that moment


	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }

	}

}
