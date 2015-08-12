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
