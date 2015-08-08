<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public static function Countlike($this_reply,$this_thread,$user_id,$liked_user)
    {
		$count = 	count(Like::where('reply_id',$this_reply)
                        ->where('thread_id',$this_thread)
                        ->where('liker_user_id',$user_id)
                        ->where('liked_user_id',$liked_user)
                        ->get());
		return $count;
    }
}
