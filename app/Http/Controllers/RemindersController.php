<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use Password;
use Input;

use Illuminate\Auth\Passwords;

class RemindersController extends Controller
{
    public function __construct() {
        // // THIRD TEMPLATE
        $this->layout = 'layouts.master-layout';
    }
    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getForgot()
    {
        return view('reminders.index')
            ->with('layout',$this->layout);
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postForgot()
    {
        $response = Password::remind(Input::only('email'), function($message){
            $message->subject('Reset your password'); 
        });
        switch ($response)
        {
            case Password::INVALID_USER:
                return Redirect::back()
                    ->with('message', Lang::get($response))
                    ->with('alert_type','alert-warning');
            break;
            case Password::REMINDER_SENT:
                //update users table with token

                return Redirect::back()
                    ->with('message', Lang::get($response))
                    ->with('alert_type','alert-success');
            break;
        }
    }
    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
        //IF TOKEN WAS EMPTY REDIRECT TO 404
        if (is_null($token)) App::abort(404);
        
        $this->layout->content = View::make('reminders.reset')
                ->with('reminder_token', $token);
        
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
            $validator = Validator::make(Input::all(), User::$rules_reset);
            if ($validator->passes()) {
                $credentials = Input::only(
                    'email', 'password', 'password_confirmation', 'token'
                );
                $response = Password::reset($credentials, function($user, $password)
                {
                    $user->password = Hash::make($password);
                    $user->_token = Input::get('token');
                    $user->save();
                });

                switch ($response)
                {

                    case Password::INVALID_TOKEN:
                        return Redirect::back()
                            ->with('message', Lang::get($response))
                            ->with('alert_type','alert-warning');
                        break;
                    case Password::INVALID_USER:
                        return Redirect::back()
                            ->with('message', Lang::get($response))
                            ->with('alert_type','alert-warning');
                        break;
                    case Password::PASSWORD_RESET:
                        return Redirect::to('/'); // redirect back()
                        break;
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
}
