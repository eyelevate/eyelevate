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

class PermissionRolesController extends Controller
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


    public function getAdd()
    {   
        $permissions = Permission::PerpareAllForSelect();
        $roles = Role::PerpareAllForSelect();
        return view('permission_roles.add')
	        ->with('layout',$this->layout)
	        ->with('permissions',$permissions)
	        ->with('roles',$roles);
               
    }


    //PERMISISON ROLE
    public function postAdd()
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
                return view('permission_roles.add')
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
}
