<?php

namespace App\Http\Controllers;

use App\Job;
use App\Search;
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


class ThreadsController extends Controller
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

    public function postSearchQuery()
    {
        if(Request::ajax()){

            $search_query = Input::get('search_text');

            $search_results = Search::search_function($search_query);

            return Response::json(array(
                'status' => 200
            ));
        }
    }
}
