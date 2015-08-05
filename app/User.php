<?php

namespace App;

use Auth;
use App\Job;
use App\User;
use App\Admin;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;



class User extends Model implements
AuthenticatableContract, CanResetPasswordContract
{
      use Authenticatable, CanResetPassword, SoftDeletes;
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
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password'];

    /*
    |--------------------------------------------------------------------------
    | ACL Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Checks a Permission
     *
     * @param  String permission Slug of a permission (i.e: manage_user)
     * @return Boolean true if has permission, otherwise false
     */
    public function can($permission = null)
    {


        return !is_null($permission) && $this->checkPermission($permission);

    }

    /**
     * Check if the permission matches with any permission user has
     *
     * @param  String permission slug of a permission
     * @return Boolean true if permission exists, otherwise false
     */
    protected function checkPermission($perm)
    {
        $grant_access = false;
        $permissions = $this->getUserPermission();
        $permissionArray = is_array($perm) ? $perm : [$perm];
        foreach ($permissionArray as $pekey => $pevalue) {
            if ($pevalue == $permissions) {
                $grant_access = true;
            }
        }
        //FOR SOME REASON PREMISSION ARRAY IS ALWASY ADMINS
        return $grant_access;
    }

    /**
     * Get all permission slugs from all permissions of all roles
     *
     * @return Array of permission slugs
     */
    protected function getUserPermission()
    {
        $permissionsArray = [];
        //GET USER ID
        $this_user_id = Auth::user()->id;
        //GET USER ROLE
        $this_role = RoleUser::where('user_id',$this_user_id)->first();
        $permission_role = PermissionRole::where('role_id',$this_role->id)->first();
        $permissions = $permission_role?Permission::find($permission_role->permission_id):false;
        return $permissions?$permissions->permission_slug:false;
        // return array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {
        //     return array_fetch($permission, 'permission_slug');
        // }, $permissions))));
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
   
    /**
     * Many-To-Many Relationship Method for accessing the User->roles
     *
     * @return QueryBuilder Object
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
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
