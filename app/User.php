<?php

namespace App;

use Auth;
use App\User;
use App\Job;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{


    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public static $registration = array(
        'email'=>'required|email|unique:users',
        'password'=>'required|between:6,25|',
        'password_again'=>'required|between:6,25'
    );


    public static $rules_password_reset = array(
        'email'=>'required|email|unique:users',
        'password'=>'required|between:6,25|',
        'password_confirmation'=>'required|between:6,25'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    static public function updateValidation() {
        $current_user = Auth::user()->id;
            return $update = array(
                'email'=>'',
                'fname'=>'required|alpha|min:2',
                'lname'=>'required|alpha|min:2'
             );
        }
}
