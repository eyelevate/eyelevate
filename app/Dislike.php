<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    public static function CountDislike($this_reply,$this_thread,$user_id,$liked_user)
    {
		$count = 	count(Dislike::where('reply_id',$this_reply)
                        ->where('thread_id',$this_thread)
                        ->where('disliker_user_id',$user_id)
                        ->where('disliked_user_id',$liked_user)
                        ->get());
		return $count;
    }
}
