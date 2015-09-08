<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public static $add_roles = array(
        'category-title'=>'required',
        'category-description'=>'required'
    );


    public static function prepareForSelect($data) {
		$categories = array(''=>'Choose a Categories');
		if(isset($data)) {
			foreach ($data as $key => $value) {
				$categories_id = $value['id'];
				$categories[$categories_id] = $value['name']; 
			}
		}
		return $categories;
	}
	public static function prepareForSide($data) {
		$categories = [];
		if(isset($data)) {
			foreach ($data as $key => $value) {
				$categories_id = $value['id'];
				$categories[$categories_id] = $value['name']; 
			}
		}
		return $categories;
	}
	public static function prepareSearchedCat($data,$prepare_pre,$this_text) {
		$categories = [];
		$html = '';
		$count = 0;
		$new_search_array = [];
		$eliminate_search = false;
		$all_empty = true;
		// $search_results = Search::index_search_function($this_text);

		if (Job::IsEmpty($this_text) == false) {
			$search_results = Search::index_search_function($this_text);
			if (Job::IsEmpty($search_results) == false) {
				foreach ($search_results as $srrkey => $srrvalue) {
					$new_search_array[$srrkey] = $srrkey;
				}
				$threads = Thread::where('status',1)
					->orderBy($prepare_pre, 'DESC')->whereIn('id', $new_search_array)->get();
			} else {
				$html = Thread::ResultNotFoundFeeback();
				$eliminate_search = true;
			}
		} else {
			$threads = Thread::where('status',1)
				->orderBy($prepare_pre, 'DESC')->get();
		}

		if(isset($data) && $eliminate_search == false) {
			$selected_cat_count = count($data);
			foreach ($threads as $thkey => $thvalue) {
				$matching_all_cats = false;
				$compare_count = 0;
				$matching_items = [];
				$is_match = false;
				if (isset($thvalue->categories)) {
					$this_cat = json_decode($thvalue->categories);
					foreach ($this_cat as $tckey => $tcvalue) {
						foreach ($data as $dakey => $davalue) {
							if ($tcvalue == $davalue) {
								$is_match = true;
								$matching_items[$count] = $davalue;
								$count++;
								$compare_count++;
								}
							}
						}
				}
				if ($compare_count == $selected_cat_count) {
					$matching_all_cats = true;
					$all_empty = false;
				}

				if ($matching_all_cats == true) {
					$this_thread = Thread::find($thvalue->id);
					$users = User::find($this_thread->user_id);
					$username = $users->username;

					$profile_image = Job::imageValidator($users->profile_image);

					$categories_j = json_decode($this_thread->categories);

					$categories_prepared = Thread::prepareCategoriesAfterSearch($categories_j,$matching_items);

					$time_s = date(strtotime($this_thread['created_at']));
					$time_ago = Job::humanTiming($time_s);
					if ($time_ago == null) {
						$time_ago = 'just now';
					} else {
						$time_ago = $time_ago.' ago';
					}

					$html .= '<div class="thread-single">
						        <div class="media">
						          <div class="media-left">
						            <a href="#">
						              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
						            </a>
						          </div>
						          <div class="media-body">
						            <div class="media-inner-left">
						              <h4 ><a href="/threads/view/'.$this_thread->id.'">'.$this_thread->title.'</a></h4>
						              <div class="thread-info">'.$username.' . 
						                <span class="thread-date">'.$time_ago.'</span>
						              </div> 
						            </br>
						            <div class="label-container">
										'.$categories_prepared.'
						            </div>
						          </div>
						          <div class="media-inner-right">
						            <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">'.$this_thread->views.'</span></div>
						          </div>
						        </div>
						      </div>
						    </div>';
				}
			}
			if ($all_empty == true) {
				$html = Thread::ResultNotFoundFeeback();
			}
		} else {
			if (isset($threads)) {
				$html = Thread::prepareThreadForView($threads);
			} else {
				$html = Thread::ResultNotFoundFeeback();
			}
		}
		return $html;
	}

	public static function preparePre($data) {
		if(isset($data)) {
			switch ($data) {
				case '1':
					$data = 'created_at';
					break;				
				case '2':
					$data = 'views';
					break;				
				case '3':
					//CHANGE THIS LATER
					$data = 'status';
					break;
				
				default:
					# code...
					break;
			}

		}

		return $data;
	}

	static public function prepareCategoriesForEdit() {
		$cat = Category::where('status', 1)->get();

		$cat_html = '';
		if (isset($cat)) {
			$categories_name = null;
			foreach ($cat as $cakey => $cavalue) {
				$cat_html .= '<span class="tag label label-primary category-tag" this-val="'.$cavalue->id.'">
				                <span>'.$cavalue->name.'</span>
				                <a><i class="remove-label glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
				                <input name="categories['.$cavalue->name.']" type="hidden" value="'.$cavalue->name.'" text="'.$cavalue->name.'">
				             </span>';
		}
		return $cat_html;
	}
}
}
