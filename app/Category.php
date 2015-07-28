<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
}
