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
use Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Thread;
use App\Category;


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

            //REFORMATE IMAGE NAME
            if (Input::get('profile-image')) {
                $imagePath = public_path("assets/images/profile-images/perm/");
                $now_time = time();
                $imagename = Input::get('profile-image');
                $image_ex = explode('.', $imagename);
                $image_type = $image_ex[1];
                $new_imagename = $now_time . '-' . $imagename[0];
                $final_path = preg_replace('#[ -]+#', '-', $new_imagename);
            }

            $user->profile_image = Input::get('profile-image')?$final_path.'.'.$image_type:'blank_male.png';           
             if($user->save()) { // Save the user and redirect to owners home
                if (Input::get('profile-image')) {
                    if( ! \File::isDirectory($imagePath) ) {
                        \File::makeDirectory($imagePath, 493, true);
                    }
                    if (!is_writable(dirname($imagePath))) {
                        $status = 401;
                        return Response::json(array(
                            "error" => 'Destination Unwritable'
                            ));
                    } else {
                        $oldpath = public_path("assets/images/profile-images/tmp/".Input::get('profile-image'));
                        $newpath = public_path("assets/images/profile-images/perm/".$final_path.'.'.$image_type);
                        rename($oldpath, $newpath);
                    }
                }
                if (Auth::attempt(array('username'=> $user->username, 'password'=>Input::get('password')))) {
                    $redirect = (Session::get('redirect')) ? Session::get('redirect') : null; 
                    
                    if(isset($redirect)) {
                        Flash::success('You have successfully been registered as '.$user->username.'!');
                        return Redirect::to(Session::get('redirect'));
                    } else {
                        Flash::error('There was an error with your registration');
                        //SESION DOESN'T EXIST
                        return redirect()->action('HomeController@postIndex');
                    }
                }

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
    // Session::reflash();

    if (Auth::attempt(array('username'=>$username, 'password'=>$password))) {
        Flash::success('Welcome back '.$username.'!');
        $redirect = (Session::get('redirect')) ? Session::get('redirect') : null; 
        
        if(isset($redirect)) {
            return Redirect::to(Session::get('redirect'));
        } else {
            //SESION DOESN'T EXIST
            return redirect()->action('HomeController@postIndex');
        }
    } else { //LOGING FAILED
        $reset_success = false;
        $username = null;
        return view('home.home-index')
            ->with('layout','layouts.home-layout')
            ->with('username',$username)
            ->with('reset_success',$reset_success)
            ->with('login_failed',true);
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

    public function getProfile($username)
    {
        // $prepared_thread = Thread::prepareThreadForView(Thread::Where('status',1)
        //     ->orderBy('created_at', 'ASC')
        //     ->get());
        $categories_for_select = Category::prepareForSelect(Category::where('status',1)->get());
        $categories_for_side = Category::prepareForSide(Category::where('status',1)->get());
        $current_user = User::find(Auth::user()->id);
        $profile_image = Job::imageValidator($current_user->profile_image);
        $email = $current_user->email;
        $fname = $current_user->firstname;
        $lname = $current_user->lastname;
        return view('users.profile')
        ->with('layout',$this->layout)
        // ->with('threads',$prepared_thread)
        ->with('categories_for_select',$categories_for_select)
        ->with('categories_for_side',$categories_for_side)
        ->with('profile_image',$profile_image)        
        ->with('email',$email)
        ->with('fname',$fname)
        ->with('lname',$lname);
    }
    public function postProfile()
    {
        $validator = Validator::make(Input::all(), User::updatevalidation());
        if ($validator->passes()) {
            $user = User::find(Auth::user()->id);
            $user->firstname = Input::get('fname');
            $user->lastname = Input::get('lname');
            if ($user->save()) {
                $redirect = (Session::get('redirect')) ? Session::get('redirect') : null; 
                if(isset($redirect)) {
                   return Redirect::to(Session::get('redirect'));
               } else {
                    //SESION DOESN'T EXIST
                return Redirect::to('/');
            }
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

public function postUserAuth()
{
    if(Request::ajax()){
        $status = 400;
        if (Auth::check()) {
            $status = 200;
        }
        return Response::json(array(
            'status' => $status
            ));
    }
}

public function postSendFile()
{
    if(Request::ajax()){
        $status = 400;
        $imagePath = public_path("assets/images/profile-images/perm/");
        $imagename = $_FILES[0]['name'];
        $imagetemp = $_FILES[0]['tmp_name'];
        $image_ex = explode('.', $imagename);
        $image_type = $image_ex[1];
        $now_time = time();
        $new_imagename = $now_time . '-' . $imagename[0];
            // check if $folder is a directory
        if( ! \File::isDirectory($imagePath) ) {
                // Params:
                // $dir = name of new directory
                //
                // 493 = $mode of mkdir() function that is used file File::makeDirectory (493 is used by default in \File::makeDirectory
                //
                // true -> this says, that folders are created recursively here! Example:
                // you want to create a directory in company_img/username and the folder company_img does not
                // exist. This function will fail without setting the 3rd param to true
                // http://php.net/mkdir  is used by this function

            \File::makeDirectory($imagePath, 493, true);
        }
        if (!is_writable(dirname($imagePath))) {
            Job::dump('DIRECTORY IS NOT WRITEABLE');
            $status = 401;
            return Response::json(array(
                "error" => 'Destination Unwritable'
                ));
        } else {

            $final_path = preg_replace('#[ -]+#', '-', $new_imagename);

            if (move_uploaded_file($imagetemp, $imagePath . $final_path.'.'.$image_type)) {
                $status = 200;
                    //SAVE THE NEW IMAGE NAME INTO USERS TABLE
                $user = User::find(Auth::user()->id);
                    //DELETE USERS PREVIOUS IMAGE
                if ($user->profile_image != 'blank_male.png') {
                    $old_image = public_path("assets/images/profile-images/perm/".$user->profile_image);
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }

                $user->profile_image = $final_path.'.'.$image_type;
                $db_imagepath = null;
                if ($user->save()) {
                 $db_imagepath = $user->profile_image;
             }
             return Response::json(array(
                'status' => 'success',
                "image_name" => $new_imagename,
                "image_type" => $image_type
                ));
         }
     }
     return Response::json(array(
        'error' => 'error'
        ));
 }
}

public function postSendFileTemp()
{
    if(Request::ajax()){
            // $imagePath = "img/tmp/";
        $status = 400;
        $imagePath = public_path("assets/images/profile-images/tmp/");
        $imagename = $_FILES[0]['name'];
        $imagetemp = $_FILES[0]['tmp_name'];

        $image_ex = explode('.', $imagename);
        $image_type = $image_ex[1];

        $now_time = time();
        $new_imagename = $now_time . '-' . $imagename[0];
            // check if $folder is a directory
        if( ! \File::isDirectory($imagePath) ) {

                // Params:
                // $dir = name of new directory
                //
                // 493 = $mode of mkdir() function that is used file File::makeDirectory (493 is used by default in \File::makeDirectory
                //
                // true -> this says, that folders are created recursively here! Example:
                // you want to create a directory in company_img/username and the folder company_img does not
                // exist. This function will fail without setting the 3rd param to true
                // http://php.net/mkdir  is used by this function

            \File::makeDirectory($imagePath, 493, true);
        }
        if (!is_writable(dirname($imagePath))) {
            $status = 401;
            return Response::json(array(
                "error" => 'Destination Unwritable'
                ));
        } else {
            $final_path = preg_replace('#[ -]+#', '-', $new_imagename);
            if (move_uploaded_file($imagetemp, $imagePath . $final_path.'.'.$image_type)) {
                $status = 200;
                return Response::json(array(
                    'status' => 'success',
                    "image_name" => $new_imagename,
                    "image_type" => $image_type
                    ));
            }
        }
        return Response::json(array(
            'error' => 'error'
            ));

    }
}
}
