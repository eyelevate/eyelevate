<?php

namespace App;

use App\Job;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	static public function dump($results) {
		if(isset($results)) {
			echo '<pre>';
			print_r($results);
			echo '</pre>';
		}

		return false;
	}

	static public function validate_data($input_all) {
		
		$data_output = [
		'message' => '',
		'status' => 400,
		'validator' => ''
		];
		if (isset($input_all)) {


			foreach ($input_all as $type => $value) {
				switch ($type) {
					case 'first_name':
						if ( strlen($input_all[$type]) > 1 && preg_match('/^[a-z .\-]+$/i', $input_all[$type])) {
							$data_output[$type]['status'] = 200;

						} else {
							$data_output[$type]['message'] = 'Invalid Format';
							$data_output[$type]['status'] = 400;
						}
					break;
					case 'last_name':
						if ( strlen($input_all[$type]) > 1 && preg_match('/^[a-z .\-]+$/i', $input_all[$type])) {
							$data_output[$type]['status'] = 200;

						} else {
							$data_output[$type]['message'] = 'Invalid Format';
							$data_output[$type]['status'] = 400;
						}
					break;
					case 'age':
						if ($input_all[$type] == 0) {
							$data_output[$type]['message'] = "Not Selected";
							$data_output[$type]['status'] = 400;
						} else {
							$data_output[$type]['status'] = 200;
						}

					break;
					case 'username':
						$message="Username has already been taken.";
						$count = count(User::where('username',$value)->get());
						if ($count == 0) {
							if (strlen($value) >= '4') {
								$data_output[$type]['message']="";
								$data_output[$type]['status'] = 200;

							} else {
								$data_output[$type]['message']="Must Contain At Least 4 Characters!";
								$data_output[$type]['status'] = 400;
							}
						}
					break;
					case 'email':
						if (filter_var($input_all[$type], FILTER_VALIDATE_EMAIL)) {
							$data_output[$type]['status'] = 200;

						} else {
							$data_output[$type]['message']  = 'Invalid Format';
							$data_output[$type]['status'] = 400;
						}
					break;
					case 'password':
				         $valid = 1;
				         if (strlen($input_all[$type]) <= '5') {
				             $data_output[$type]['message'] = "Must Contain At Least 6 Characters";
				        	$data_output[$type]['status'] = 400;
				         }
				         elseif(!preg_match("#[0-9]+#",$input_all[$type])) {
				             $data_output[$type]['message'] = "Must Contain At Least 1 Number";
				        	$data_output[$type]['status'] = 400;
				         }
				         else {
				             $data_output[$type]['status'] = 200;
				         }
			        break;
			        case 'password_again':
				         $valid = 1;
				         if (strlen($input_all[$type]) <= '5') {
				             $data_output[$type]['message'] = "Must Contain At Least 6 Characters";
				        	$data_output[$type]['status'] = 400;
				         }
				         elseif($input_all[$type] != $input_all["password"]) {
				             $data_output[$type]['message'] = "Entered Passwords Does Not Match";
				         	$data_output[$type]['status'] = 400;
				         }
				         else {
				             $data_output[$type]['status'] = 200;
				         }
			        break;
					// case 'phone':
     //    			//US PHONE, VALIDATION
					// $regex = '/^(?:1(?:[. -])?)?(?:\((?=\d{3}\)))?([2-9]\d{2})(?:(?<=\(\d{3})\))? ?(?:(?<=\d{3})[.-])?([2-9]\d{2})[. -]?(\d{4})(?: (?i:ext)\.? ?(\d{1,5}))?$/';
					// if ( preg_match( $regex, $input_all[$type]) ){
					// 	$data['status'] = 200;
					// } else {
					// 	$data['validator']  = ['phone'=> 'Invalid Phone Number'];
					// }
					// break;
			       
					default:
                    # code...
					break;
				}
			}
		}
		return $data_output;
	}

}
