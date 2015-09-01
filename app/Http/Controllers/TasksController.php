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
use App\RoleUser;
use App\Permission;
use App\PermissionRole;
use App\Task;
use App\Helpers\UploadHelper;



class TasksController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $setup_tasks = Task::getTasksByType(Auth::user()->id);
        return view('tasks.index')
        ->with('layout',$this->layout)
        ->with('tasks',$setup_tasks)
        ->with('user_id',Auth::user()->id);
    }

    /**
     * Adds a task 
     *
     * @return Response
     */
    public function getAdd()
    {
        $types = Task::getTaskTypes();
        $approved_administrators = Admin::getApprovedAdmins();
        return view('tasks.add')
         ->with('layout',$this->layout)
         ->with('types',$types)
         ->with('admins',$approved_administrators); 
    }  
    /**
     * Process Task Request
     *
     * @return Response
     */
    public function postAdd()
    {

        // $task = new Task;
        // $task->title = Input::get('title');
        // $task->description = Input::get('description');
        // $task->created_by = Auth::user()->id;
        // $task->type = Input::get('type');
        // $task->status = 1; // New status
        // $task->assigned_id = Input::get('assigned_id');

        // if ($task->save()) {
        //     Flash::success('Successfully Added Task');
        //     return Redirect::route('tasks_index');
        // } else {
        //     Flash::Error('Error');
        //     return Redirect::back();
        // }
        Job::dump(Input::all());
        
    }  
    /**
     * /admins/tasks/edit.
     * @param $id - task_id
     * @return Response
     */
    public function getEdit($id = null)
    {
        $tasks = Task::find($id);
        $types = Task::getTaskTypes();
        $approved_administrators = Admin::getApprovedAdmins();
        return view('tasks.edit')
         ->with('layout',$this->layout)
         ->with('tasks',$tasks)
         ->with('types',$types)
         ->with('admins',$approved_administrators); 
    } 
    /**
     * Process Task Edit Request
     *
     * @return Response
     */
    public function postEdit()
    {

        $task = Task::find(Input::get('id'));
        $task->title = Input::get('title');
        $task->description = Input::get('description');
        $task->created_by = Auth::user()->id;
        $task->type = Input::get('type');
        $task->assigned_id = Input::get('assigned_id');

        if ($task->save()) {
            Flash::success('Successfully Updated');
            return Redirect::route('tasks_index');
        } else {
            Flash::Error('Error');
            return Redirect::back();
        }
        
    }  
    /**
     * /admins/tasks/view.
     * @param $id - task_id
     * @return Response
     */
    public function getView($id = null)
    {
        $task = Task::find($id);

        return view('tasks.view')
            ->with('layout',$this->layout)
            ->with('task',$task); 
    } 
    /**
     * Update Task Request
     *
     * @return Response
     */
    public function postView()
    {

        $task = Task::find(Input::get('id'));
        $task->status = Input::get('status');

        if ($task->save()) {
            Flash::success('Successfully Updated');
            return Redirect::route('tasks_index');
        } else {
            Flash::Error('Error');
            return Redirect::back();
        }
        
    } 
    /**
     * Update Task Request
     *
     * @return Response
     */
    public function postUpload()
    {

        if(Request::ajax()){
            error_reporting(E_ALL | E_STRICT);
            $upload_handler = new UploadHandler();
            $this->layout = '';
            $path = 'tmp/img';
            // Loop through the tmp/img folder and move all uploaded images to their respective folders
            foreach (glob($path.DIRECTORY_SEPARATOR.'*.*') as $file) {
                $new_dest = 'img/'.$company_id.'/'.strtotime(date('Y-m-d H:i:s')).'-';
                $new_file_name = str_replace('tmp/img/', $new_dest, $file);
                if(rename($file, $new_file_name)) {
                    // Specify the target directory and add forward slash
                    $thumbs = "tmp/img/thumbnail";
                    // Loop over all of the files in the folder
                    foreach(glob($thumbs.DIRECTORY_SEPARATOR."*.*") as $thumb) {
                        unlink($thumb); // Delete each file through the loop
                    }                   
                }
            }        
        }
        
    }  

}
