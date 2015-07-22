<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Job;
use Input;
use Session;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct() {

        // $this->layout = "layouts.test";

        //FIRST TEMPLATE
        // $this->layout = "layouts.master";

        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";

        // // THIRD TEMPLATE
        $this->layout = "layouts.home-layout";
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $reset_success = false;
        $username = null;
        if (Session::get('reset_success') == true) {
           $reset_success = true;
        }
        if (Auth::check()) {
          $username = Auth::user()->username;
        }
        return view('home.home-index')
            ->with('layout',$this->layout)
            ->with('username',$username)
            ->with('reset_success',$reset_success);
    }

        public function postIndex()
    {
        $this->layout = 'layouts.master-layout';
        return view('home.results')
        ->with('layout',$this->layout);
    } 
}
