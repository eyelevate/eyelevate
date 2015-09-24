<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Job;
use App\RoleUser;
use App\User;

class Invoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';
}