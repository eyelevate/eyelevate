<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Job;
use App\User;
use Input;
use Validator;
use Redirect;

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
}
