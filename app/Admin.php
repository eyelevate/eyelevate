<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public static $add_roles = array(
        'role-title'=>'required',
        'role-slug'=>'required'
    );
    public static $add_permission = array(
        'permission-title'=>'required',
        'permission-slug'=>'required',
        'permission-description'=>'required'
    );

    public static $add_permission_role = array(
        'permission_id'=>'required',
        'role_id'=>'required'
    );
}