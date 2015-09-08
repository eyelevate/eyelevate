<?php


namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Thread;
use App\Category;
use App\Search;

class CategoriesController extends Controller
{
    public function __construct() {

        // Define layout
        $this->layout = 'layouts.admins';
        $this_username = null;
        $this_user_profile_image = null;
        if (Auth::check()) {
            $this_user = User::find(Auth::user()->id);
            $this_username = $this_user->username;
            //PROFILE IMAGE
            $this_user_profile_image = Job::imageValidator($this_user->profile_image);
        } else {
            $this_user_profile_image = Job::imageValidator(null);
        }

        View::share('this_username',$this_username);
        View::share('this_user_profile_image',$this_user_profile_image);

    }
    public function getAdd()
    {   
        
        return view('categories.add')
        ->with('layout',$this->layout);
    }

    public function postAdd()
    {   
        $validator = Validator::make(Input::all(), Category::$add_roles);
        


        if ($validator->passes()) {
            $title = Input::get('category-title');
            $description = Input::get('category-description');
            $duplicate = count(Category::where('name',$title)->get());
            if ($duplicate == 0) {
                $categories = new Category;
                $categories->name = $title;
                $categories->description = $description;
                $categories->status = 0;

                if ($categories->save()) {
                    return view('categories.add')
                    ->with('layout',$this->layout)
                    ->with('message_feedback','Successfully Added');
                }
            } else {
                Flash::error('Error: Duplicate Entry');
                return Redirect::back();
            }
        }
        else {
            // validation has failed, display error messages    
            return Redirect::back()
                ->with('message', 'The following errors occurred')
                ->with('alert_type','alert-danger')
                ->withErrors($validator)
                ->withInput();  
        }
    }


    public function getEdit()
    {   
        $categories_prepared = Category::prepareCategoriesForEdit();
        $all_cats = Category::prepareForSelect(Category::get());
        return view('categories.edit')
        ->with('layout',$this->layout)
        ->with('categories_prepared',$categories_prepared)
        ->with('all_cats',$all_cats);
    }

    public function postEdit()
    {   

        $selected_categories = Input::get('categories');
        $db_categories = Category::get();

        foreach ($db_categories as $dbkey => $dbvalue) {
            if (isset($selected_categories)) {
                foreach ($selected_categories as $sekey => $sevalue) {
                    if ($dbvalue->name == $sevalue) {
                        $new_cat = Category::find($dbvalue->id);
                        $new_cat->status = 1;
                        $new_cat->save();
                        break;
                    } else {
                        $new_cat = Category::find($dbvalue->id);
                        $new_cat->status = 0;
                        $new_cat->save();
                    }
                }
            }
        }
        //EVERY CATEGORY WAS DELETED
        if (!isset($selected_categories)) {
            foreach ($db_categories as $dbkey => $dbvalue) {
                $new_cat = Category::find($dbvalue->id);
                $new_cat->status = 0;
                $new_cat->save();
            }
        }
        $categories_prepared = Category::prepareCategoriesForEdit();
        $all_cats = Category::prepareForSelect(Category::get());
        return view('categories.edit')
        ->with('layout',$this->layout)
        ->with('categories_prepared',$categories_prepared)
        ->with('all_cats',$all_cats);

    }


    public function postCatSearch()
    {
        if(Request::ajax()){
            $status = 200;
            $cat_array = Input::get('data');
            $pre = Input::get('pre');
            $this_text = Input::get('s_text');
            $prepare_pre = Category::preparePre($pre);
            $isset_text = Job::IsEmpty($this_text);

            $search_results = null;
            $prepared_cat_html = Category::prepareSearchedCat($cat_array,$prepare_pre,$this_text);

            return Response::json(array(
                'status' => $status,
                'prepared_cat_html'=>$prepared_cat_html
                ));
        }
    }
}
