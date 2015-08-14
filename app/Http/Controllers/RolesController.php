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
use App\Admin;
use App\Role;
use App\Permission;
use App\PermissionRole;

class RolesController extends Controller
{
    public function __construct() {

        // Define layout
        $this->layout = 'layouts.admins';
        $this_user = User::find(Auth::user()->id);
        $this_username = $this_user->username;

        //PROFILE IMAGE
        $this_user_profile_image = Job::imageValidator($this_user->profile_image);

        View::share('this_username',$this_username);
        View::share('this_user_profile_image',$this_user_profile_image);

    }


    //ROLES
    public function getAdd()
    {   
        return view('roles.add')
        ->with('layout',$this->layout);
    }
    public function postAdd()
    {
            $validator = Validator::make(Input::all(), Admin::$add_roles);
            if ($validator->passes()) {
            	$title = Input::get('role-title');
            	$slug = Input::get('role-slug');

            	$roles = new Role;
            	$roles->role_title = $title;
            	$roles->role_slug = $slug;

            	if ($roles->save()) {
			        return view('roles.add')
			        ->with('layout',$this->layout)
			        ->with('message_feedback','Successfully Added');
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
}
