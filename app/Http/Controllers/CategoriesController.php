<?php


namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Response;
use Auth;
use URL;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Thread;
use App\Category;

class CategoriesController extends Controller
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
public function postCatSearch()
{
    if(Request::ajax()){
        $status = 200;
        $cat_array = Input::get('data');
        $prepared_cat_html = Category::prepareSearchedCat($cat_array);
        return Response::json(array(
            'status' => $status,
            'prepared_cat_html'=>$prepared_cat_html
            ));
    }
}
}
