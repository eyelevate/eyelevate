<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
	static public function PrepareAllFlagsSum($status_op) {
		$flags = Flag::where('status',$status_op)->get();
		$output_array = [];

		foreach ($flags as $flkey => $flvalue) {
			$title = '';
			$this_count = count(Flag::where('thread_id',$flvalue->thread_id)
									->where('reply_id',$flvalue->reply_id)->get());

			if ($flvalue->reply_id == 0) {//THREAD
				$threads = Thread::find($flvalue->thread_id);
				if (isset($threads)) {
					$title = $threads->title;
				}
				
			} else {//REPLY
				$replies = Reply::find($flvalue->reply_id);
				if (isset($replies)) {
					$title = $replies->title;
				}
			}
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id]['thread_id'] = $flvalue->thread_id;
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id]['reply_id'] =  $flvalue->reply_id == 0?'NULL':$flvalue->reply_id;
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id]['payload']  = $flags[$flkey];
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id]['count'] = $this_count;
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id]['title'] = substr($title, 0, 20).'...';
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id]['status'] = Flag::PrepareStatus($flvalue->status);
			$output_array[$flvalue->thread_id.'_'.$flvalue->reply_id]['created_at'] = date('n/d/Y g:ia',strtotime($flvalue->created_at));
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
}
