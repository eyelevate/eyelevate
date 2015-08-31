<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use Password;
use Input;
use Laracasts\Flash\Flash;

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
                Flash::success('Password reminder successfully sent');
        return view('reminders.index')
            ->with('layout',$this->layout);
            break;
            case Password::REMINDER_SENT:
                //update users table with token
                Flash::success('Password reminder successfully sent');
        return view('reminders.index')
            ->with('layout',$this->layout);
            break;
        }
    }
    
}
