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
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Admin;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;
use App\Task;
use App\Project;
use App\TaskComment;
use App\Helpers\UploadHelper;

class ProjectsController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $projects = Project::get();
        $all_projects = Project::PrepareProjectsForIndex($projects);
        return view('projects.index')
            ->with('layout',$this->layout)
            ->with('all_projects',$all_projects);
            
    }

    public function getAdd()
    {
        $types = Project::PrepareTypesForSelect();
        return view('projects.add')
        ->with('layout',$this->layout)
        ->with('types',$types);
    }
    public function postAdd()
    {
       $title = Input::get('title');
       $description = Input::get('description');
       $type = Input::get('type');

       $projects = new Project;
       $projects->title = $title;
       $projects->description = $description;
       $projects->type = $type;
       $projects->status = 1;
       if ($projects->save()) {
            Flash::success('Successfully Added Project');
            return Redirect::route('projects_index');
       }

    }

    public function getEdit($id = null)
    {
        $projects = Project::find($id);
        $all_projects = Project:: PrepareProjectForEdit($projects);
        $types = Project::PrepareTypesForSelect();
        $status = Project::PrepareStatusForSelect();
        return view('projects.edit')
            ->with('layout',$this->layout)
            ->with('all_projects',$all_projects)
            ->with('types',$types)
            ->with('status',$status);
    }
    public function PostEdit()
    {
       $title = Input::get('title');
       $description = Input::get('description');
       $type = Input::get('type');
       $id = Input::get('id');
       $status = Input::get('status');

       $projects = Project::find($id);
       $projects->title = $title;
       $projects->description = $description;
       $projects->type = $type;
       $projects->status = $status;
       if ($projects->save()) {
            Flash::success('Successfully Edited Project');
            return Redirect::route('projects_index');
       }
    }


    public function PostDelete()
    {
       $id = Input::get('id');
       $projects = Project::find($id);
       if ($projects->delete()) {
            Flash::success('Successfully Deleted');
            return Redirect::route('projects_index');
       }
    }

    public function getView($id = null)
    {
        $projects = Project::find($id);
        $all_projects = Project:: PrepareProjectForView($projects);
        $types = Project::PrepareTypesForSelect();
        return view('projects.view')
            ->with('layout',$this->layout)
            ->with('all_projects',$all_projects);
    }
}
