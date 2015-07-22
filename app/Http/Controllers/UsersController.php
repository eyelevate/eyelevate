<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Response;
use Auth;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct() {

        // $this->layout = "layouts.test";

        //FIRST TEMPLATE
        // $this->layout = "layouts.master";

        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";

        // // THIRD TEMPLATE
        $this->layout = 'layouts.master-layout';
   
    }

        public function getRegistration()
    {
        return view('users.registration')
            ->with('layout',$this->layout);
    }
        public function postRegistration()
    {
        $validator = Validator::make(Input::all(), User::$registration);
        if ($validator->passes()) {

            $user = new User;
            $user->roles = 2;
            $user->username = Input::get('username');
            $user->firstname = Input::get('first_name');
            $user->lastname = Input::get('last_name');
            $user->email = Input::get('email');
            $user->age = Input::get('age');
            $user->company = (Input::get('company'))?Input::get('company'):null;
            $user->password = Hash::make(Input::get('password'));            
             if($user->save()) { // Save the user and redirect to owners home
                return Redirect::to('/');
            }

        } else {
            // validation has failed, display error messages    
            return Redirect::back()
            ->with('message', 'The following errors occurred')
            ->with('alert_type','alert-danger')
            ->withErrors($validator)
            ->withInput();
        }
       
    }
        public function postLogin()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        Session::reflash();

        if (Auth::attempt(array('username'=>$username, 'password'=>$password))) {
            $redirect = (Session::get('redirect')) ? Session::get('redirect') : null; 
            if(isset($redirect)) {
               return Redirect::to(Session::get('redirect'));
            } else {
                return Redirect::to('/');
            }
        } else {
            //FAILED TO LOGIN
            return redirect('/');
        }
    }
        public function getLogout()
    {
        Auth::logout();
        Session::reflash(); // Keep for inteded pages backfall. This helps users get back to the intended page if session expire
        return Redirect::action('HomeController@getIndex');
    }
        public function postLogout()
    {
        Auth::logout();
        Session::reflash(); // Keep for inteded pages backfall. This helps users get back to the intended page if session expire
        return Redirect::action('HomeController@getIndex');
    }

        public function postValidate()
    {
        $reg_form = null;
        parse_str(Input::get('reg_form'), $reg_form);
        $validation_results = Job::validate_data($reg_form);
        if(Request::ajax()){
            return Response::json(array(
                'status' => 200,
                'validation_callback' => $validation_results
            ));
        }
    }
}
