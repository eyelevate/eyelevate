<?php
namespace App\Http\Controllers;

use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Admin;
use App\Role;
use App\Flag;
use App\InvoiceItem;
use App\Task;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

class InvoiceItemsController extends Controller
{
    public function __construct() {
        // Define layout
        $this->layout = 'layouts.admins';
        $this_username = null;
        //PROFILE IMAGE
        $this_user_profile_image = null;
        if (Auth::check()) {
            $this_user = User::find(Auth::user()->id);
            $this_username = $this_user->username;
            //PROFILE IMAGE
            $this_user_profile_image = Job::imageValidator($this_user->profile_image);
        } 
        
        View::share('this_username',$this_username);
        View::share('this_user_profile_image',$this_user_profile_image);

        $notif = Job::prepareNotifications();
        View::share('notif',$notif);

    }

    public function postMakeInvoiceItem() {
        if(Request::ajax()){
            $title = Input::get('title');
            $description = Input::get('description');
            $quantity = Input::get('quantity');
            $subtotal = Input::get('subtotal');
            $tax_id = Input::get('tax_id');

            // validate errors
            $status = 200;

            // make table row
            $invoice_item_row = InvoiceItem::makeTableRow($title,$description,$quantity,$subtotal,$tax_id);

            // send response

            return Response::json(['status'=>$status,'row'=>$invoice_item_row]);
        }
    }
    


}
