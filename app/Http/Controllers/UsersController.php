<?php

namespace App\Http\Controllers;




use App\Job;
use App\User;
use Input;
use Validator;
use Redirect;

use Request;
use Response;

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

        } else {
            // validation has failed, display error messages    
            return Redirect::back()
            ->with('message', 'The following errors occurred')
            ->with('alert_type','alert-danger')
            ->withErrors($validator)
            ->withInput();
        }
       
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
