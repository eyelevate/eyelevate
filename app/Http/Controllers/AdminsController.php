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

class AdminsController extends Controller
{
    public function __construct() {
        // Define layout
        $this->layout = 'layouts.admins';
        $this_username = null;
        //PROFILE IMAGE
        $this_user_profile_image = null;
        if (Auth::check()) {
            $this_user = User::find(Auth::user()->id);
            $this_username = $this_user->username;
            //PROFILE IMAGE
            $this_user_profile_image = Job::imageValidator($this_user->profile_image);
        } 
            View::share('this_username',$this_username);
            View::share('this_user_profile_image',$this_user_profile_image);

    }
      public function getIndex()
    {
        return view('admins.index')
        ->with('layout',$this->layout);
    }

    public function getLogin()
    {
        if (Auth::check()) { //If admin is already logged in. Have router check users acl permission and redirect them back
            return redirect()->action('AdminsController@getIndex');
        }
        $this->layout = 'layouts.master-layout';
        return view('admins.login')
            ->with('layout',$this->layout);
    }

    public function PostLogin()
    {
        $username = Input::get('email');
        $password = Input::get('password');
        // Session::reflash();

        if (Auth::attempt(array('username'=>$username, 'password'=>$password))) {
            // Flash::success('Welcome back '.$username.'!');
            return redirect()->action('AdminsController@getIndex');
        } else { //LOGING FAILED
            $this->layout = 'layouts.master-layout';
            return view('admins.login')
            ->with('layout',$this->layout)
            ->with('wrong',true);
        }
    }

    public function getLogout()
    {
        if(Auth::logout()){
            Session::reflash(); // Keep for inteded pages backfall. This helps users get back to the intended page if session expire
            return Redirect::action('AdminsController@getLogin');
        }
        
        
    }

    //ROLES
       public function getAddRoles()
    {   
        return view('admins.add_roles')
        ->with('layout',$this->layout);
    }
        public function postAddRoles()
    {
            $validator = Validator::make(Input::all(), Admin::$add_roles);
            if ($validator->passes()) {
            	$title = Input::get('role-title');
            	$slug = Input::get('role-slug');

            	$roles = new Role;
            	$roles->role_title = $title;
            	$roles->role_slug = $slug;

            	if ($roles->save()) {
			        return view('admins.add_roles')
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

    //PERMISSIONS

    public function getAddPermission()
    {           
        Route::get('routes', array('uses'=>'RoutesController@routes'));
        $all_routes = Permission::PrepareAllRouteForSelect();
        return view('admins.add_permission')
        ->with('layout',$this->layout)
        ->with('all_routes',$all_routes);
    }
        public function postAddPermission()
    {   

	    $validator = Validator::make(Input::all(), Admin::$add_permission);
        if ($validator->passes()) {
        	$title = Input::get('permission-title');
        	$slug = Input::get('permission-slug');
        	$description = Input::get('permission-description');

        	$permissions = new Permission;
        	$permissions->permission_title = $title;
        	$permissions->permission_slug = $slug;
        	$permissions->permission_description = $description;

        	if ($permissions->save()) {
                $all_routes = Permission::PrepareAllRouteForSelect();
                return view('admins.add_permission')
                ->with('layout',$this->layout)
                ->with('all_routes',$all_routes)
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

        public function getAddPermissionRole()
    {   
        $permissions = Permission::PerpareAllForSelect();
        $roles = Role::PerpareAllForSelect();
        return view('admins.add_permission_role')
        ->with('layout',$this->layout)
        ->with('permissions',$permissions)
        ->with('roles',$roles);
               
    }


    //PERMISISON ROLE
    public function postAddPermissionRole()
    {
        $validator = Validator::make(Input::all(), Admin::$add_permission_role);
        if ($validator->passes()) {
            $permission = Input::get('permission_id');
            $role = Input::get('role_id');

            $permission_role = new PermissionRole;
            $permission_role->permission_id = $permission;
            $permission_role->role_id = $role;

            if ($permission_role->save()) {
                $permissions = Permission::PerpareAllForSelect();
                $roles = Role::PerpareAllForSelect();
                return view('admins.add_permission_role')
                ->with('layout',$this->layout)
                ->with('permissions',$permissions)
                ->with('roles',$roles)
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

    public function getViewAcl()
    {   
        return view('admins.acl_view')
        ->with('layout',$this->layout);
               
    }

    public function getViewCategory()
    {   
        return view('admins.category_view')
        ->with('layout',$this->layout);
               
    }

    
}
