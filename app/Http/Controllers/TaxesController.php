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
use App\Project;
use App\Permission;
use App\PermissionRole;
use App\Task;
use App\Tax;
use App\TaskComment;
use App\Helpers\UploadHelper;

class TaxesController extends Controller
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
        $taxes = Tax::PrepareTaxesForIndex(Tax::orderBy('id','desc')->get());
        return view('taxes.index')
            ->with('layout',$this->layout)
            ->with('taxes',$taxes);
    }
    /**
     * Adds a task 
     *
     * @return Response
     */
    public function getAdd()
    {
        $country_code = Job::country_code();

        return view('taxes.add')
            ->with('layout',$this->layout)
            ->with('country_code',$country_code);
    }  
    /**
     * Process Task Request
     *
     * @return Response
     */
    public function postAdd()
    {       

        $validator = Validator::make(Input::all(), Tax::$rule_add);
        if ($validator->passes()) {
            $title = Input::get('title');
            $description = Input::get('description');
            $country = Input::get('country');
            $rate = Tax::formatRateIn(Input::get('rate'));
            // Check if user wants to make all previous taxes in this country set to in-active before saving a new tax
            $previous = (Input::get('previous') == 'true') ? Tax::where('country',$country)->update(['status'=>2]) : null;

            $taxes_data = new Tax;
            $taxes_data->title = $title;
            $taxes_data->description = $description;
            $taxes_data->country = $country;
            $taxes_data->rate = $rate;
            $taxes_data->status = 1;

            // Save the new tax rate
            if ($taxes_data->save()) {
                 Flash::success('Successfully added!');
                 return Redirect::route('taxes_index');
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
    /**
     * /admins/tasks/edit.
     * @param $id - task_id
     * @return Response
     */
    public function getEdit($id = null)
    {
        if (isset($id)) {
            $country_code = Job::country_code();
            $taxes = Tax::find($id);
            $status = Tax::PrepareStatusForSelect();
                return view('taxes.edit')
                ->with('layout',$this->layout)
                ->with('country_code',$country_code)
                ->with('status',$status)
                ->with('taxes',$taxes);
        } else {
            Redirect::back();
        }
    } 
    /**
     * Process Task Edit Request
     *
     * @return Response
     */
    public function postEdit()
    {
       $validator = Validator::make(Input::all(), Tax::$rule_add);
        if ($validator->passes()) {
            $title = Input::get('title');
            $description = Input::get('description');
            $country = Input::get('country');
            $rate = Tax::formatRateIn(Input::get('rate'));
            $id = Input::get('id');
            $status = Input::get('status');

            $taxes_data = Tax::find($id);
            $taxes_data->title = $title;
            $taxes_data->description = $description;
            $taxes_data->country = $country;
            $taxes_data->rate = $rate;
            $taxes_data->status = $status;
            if ($taxes_data->save()) {
                 Flash::success('Successfully updated tax!');
                 return Redirect::route('taxes_index');
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
    /**
     * /admins/tasks/view.
     * @param $id - task_id
     * @return Response
     */
    public function getView($id = null)
    {

    } 

}
