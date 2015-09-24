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
use App\Flag;
use App\Task;
use App\Project;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class InvoicesController extends Controller
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

        $notif = Job::prepareNotifications();
        View::share('notif',$notif);

    }
    
    public function getIndex() {
        return view('invoices.index')
        ->with('layout',$this->layout);
    }

    public function getAdd() {
        $projects = Project::PrepareAllProjectForSelect();
        return view('invoices.add')
        	->with('layout',$this->layout)
        	->with('projects',$projects);
    }

    public function postAdd() {

    }

    public function getEdit($id = null) {
        return view('invoices.edit')
        ->with('layout',$this->layout);
    }

    public function postEdit() {

    }

    public function getView($id = null) {
        return view('invoices.view')
        ->with('layout',$this->layout);
    }



}
