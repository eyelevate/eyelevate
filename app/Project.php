<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    static public function PrepareProjectsForIndex($data) {
        if(isset($data)) {
        	foreach ($data as $dkey => $dvalue) {
	            if(isset($dvalue['status'])) {
	                $dvalue['status'] = Project::prepareStatusForView($dvalue->status);
	            }
	            if(isset($dvalue['created_at'])) {
	                $dvalue['created_ats'] = date('n/d/Y g:ia',strtotime($dvalue->created_at));
	            }
        	}

        }
        return $data;
    }

    static public function PrepareProjectForView($dvalue) {
        if(isset($dvalue)) {

	            if(isset($dvalue['status'])) {
	                $dvalue['status'] = Project::prepareStatusForView($dvalue->status);
	            }
	            if(isset($dvalue['created_at'])) {
	                $dvalue['created_ats'] = date('n/d/Y g:ia',strtotime($dvalue->created_at));
	            }

        }
        return $dvalue;
    }
    static public function PrepareProjectForEdit($dvalue) {
        if(isset($dvalue)) {
	            if(isset($dvalue['created_at'])) {
	                $dvalue['created_ats'] = date('n/d/Y g:ia',strtotime($dvalue->created_at));
	            }
        }
        return $dvalue;
    }

    static private function prepareStatusForView($status) {

        switch($status) {
            case '1': // New task
                $status = '<span class="label label-info">Active</span>';
            break;
            case '2': // In Progress
                $status = '<span class="label label-primary">Completed</span>';
            break;
            case '3':
                $status = '<span class="label label-default">Canceled</span>';
            break;
        }
        return $status;
    }    

    static public function GetProjectsName($project_id) {
        $label = '';
        if (isset($project_id)) {
            $projects = Project::find($project_id);
            if (isset($projects)) {
                $label = '<span class="label label-info">'.$projects->title.'</span>';
            }
        }
        return $label;
    }

    static public function PrepareTypesForSelect() {
        return [
            ''  => 'Select Project',
            '1' => 'Web Application'
        ];
    }

    static public function PrepareAllProjectForSelect() {
        $all_p = Project::get();

        $projects = ['name' => 'Select Project'];
        if($all_p) {
            foreach ($all_p as $alkey => $alvalue) {
                $projects[$alvalue->id] =  $alvalue->title;
            }
        }


        return $projects;
    }

    static public function PrepareStatusForSelect() {
    	return [
    		''	=> 'Select Project Status',
    		'1' => 'Active',
    		'2' => 'Completed',
    		'3' => 'Canceled',
    	];
    }
}
