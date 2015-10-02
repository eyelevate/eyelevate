<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{

	public static $rule_add = array(
        'title'=>'required',
        'description'=>'required',        
        'country'=>'required',
        'rate'=>'required',
    );
    static public function PrepareTaxesForIndex($data) {

    	if (isset($data)) {
    		foreach ($data as $dkey => $dvalue) {
				if(isset($dvalue['created_at'])) {
					$dvalue['created_at_html'] = date ( 'n/d/Y g:ia',  strtotime($dvalue['created_at']) );
				}    		
				if(isset($dvalue['status'])) {
					switch ($dvalue['status']) {
						case 1: // Set but not paid
							$dvalue['status_message']= '<span class="label label-success">Active</span>';
							break;
						case 2: // Recieved payment & success
							$dvalue['status_message']= '<span class="label label-warning">Inactive</span>';
							break;

						case 3: // Recieved with error
							$dvalue['status_message']= '<span class="label label-danger">Error</span>';
							break;

						default:
							$dvalue['status_message']= '<span class="label label-default">Deleted</span>';
							break;

					}
				}
				
    		}
    	}
    	return $data;
    }

    static public function PrepareStatusForSelect() {
    	return [
    		''	=> 'Select Status',
    		'1' => 'Active',
    		'2' => 'In-Active'
    	];
    }

    static public function formatRateIn($rate) {

    	return (isset($rate) && $rate > 0) ? $rate : 0;
    }   
}
