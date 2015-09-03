<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flag extends Model
{
	use SoftDeletes;
	static public function PrepareAllFlagsSum($status_op) {
		$flags = Flag::where('status',$status_op)->get();
		$output_array = [];
		$output_array['type']='';
		$quote_id='nothing';

		foreach ($flags as $flkey => $flvalue) {
			$title = '';
			$this_count = count(Flag::where('thread_id',$flvalue->thread_id)
									->where('reply_id',$flvalue->reply_id)->get());

			if (isset($flvalue->quote_id)) {//ITS A QUOTE
				$output_array['type']='quote';
				$replies = Reply::find($flvalue->quote_id);
				$quote_id = $flvalue->quote_id;
				if (isset($replies)) {
					$title = $replies->reply;
				}
			} else {
				if ($flvalue->reply_id == 0) {//THREAD
					$output_array['type']='thread';
					$threads = Thread::find($flvalue->thread_id);
					if (isset($threads)) {
						$title = $threads->title;
					}
				} else {//REPLY
					$output_array['type']='reply';
					$replies = Reply::find($flvalue->reply_id);
					if (isset($replies)) {
						$title = $replies->reply;
					}
				}		
			}
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['thread_id'] = $flvalue->thread_id;
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['reply_id'] =  $flvalue->reply_id == 0?'NULL':$flvalue->reply_id;
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['quote_id'] =  !isset($flvalue->quote_id)?'NULL':$flvalue->quote_id;
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['payload']  = $flags[$flkey];
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['count'] = $this_count;
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['title'] = Job::FilterSpecialCharacters(Job::cleanInput(substr($title, 0, 40).'...'));
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['status'] = Flag::PrepareStatus($flvalue->status);
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id.'-'.$quote_id]['created_at'] = date('n/d/Y g:ia',strtotime($flvalue->created_at));
		}

		return $output_array;
	}

	static public function PrepareStatus($status) {
		$html = '';
		if (isset($status)) {
			switch ($status) {
				case 1:
					$html = '<span class="label label-default">Pending</span>';
					break;
				case 2:
					$html = '<span class="label label-success">Approved</span>';
					break;
				case 3:
					$html = '<span class="label label-danger">Rejected</span>';
					break;
				case 4:
					$html = '<span class="label label-default">Pendding/Re-Flagged</span>';
					break;
				case 5:
					$html = '<span class="label label-warning">Approved/Final</span>';
					break;
				case 6:
					$html = '<span class="label label-warning">Rejected/Final</span>';
					break;
				case 7:
					$html = '<span class="label" style="background-color:black">Banned</span>';
					break;
				
				default:
					$html = '<span class="label label-default">error</span>';
					break;
			}
		}
		return $html;
	}
		static public function PrepareReasons($reason) {
		$html = '';
		if (isset($reason)) {
			switch ($reason) {
				case 1:
					$html = '<span class="label label-default">Spam</span>';
					break;
				case 2:
					$html = '<span class="label label-default">Inappropriate Content</span>';
					break;
				case 3:
					$html = '<span class="label label-default">Abusive Behavior</span>';
					break;
				case 4:
					$html = '<span class="label label-default">Violates terms of use</span>';
					break;
				default:
					$html = '<span class="label label-default">none</span>';
					break;
			}
		}
		return $html;
	}
}
