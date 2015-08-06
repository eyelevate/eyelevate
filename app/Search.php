<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Job;
use App\Thread;
class Search extends Model
{
   	static public function search_function($search_str) {


   		if (isset($search_str)) {
   			//1ST TIER OF SEARCH |--
   			$similar_queries_count = count(Thread::where('description','LIKE','%'.$search_str.'%')->get());
   			if ($similar_queries_count > 0) {
   				$similar_query = Thread::where('description','LIKE','%'.$search_str.'%')->first();
   				$tier_1_result_id = $similar_query->id;

   				$results_1 = Thread::find($tier_1_result_id);
   				$final_product_tier1 = [];
   				$final_product_tier1[$results_1->id]["id"]=$results_1->id;
   				$final_product_tier1[$results_1->id]["title"]=$results_1->title;
   				$final_product_tier1[$results_1->id]["description"]=implode(' ', array_slice(explode(' ', $results_1->description), 0, 20));
				if (str_word_count($results_1->description) > 20) {
					$final_product_tier1[$results_1->id]["description"] .='...';
				}
   			}
   			//1ST TIER OF SEARCH END --|



   			//2ST TIER OF SEARCH |--

   			//FORMATING
   			$search_str_formated =  preg_replace("/[^a-zA-Z0-9]+/", " ", $search_str);
   			$trimmed = trim($search_str_formated);
   			$str_lowered = strtolower($trimmed);
   			$search_str_formated = explode(" ",$str_lowered);


   			//FILTERING
   			$swear_filtered = array_diff($search_str_formated, Job::swear_keywords());
   			$pronouns_filtered = array_diff($swear_filtered, Job::pronouns_keywords());
   			$alphabet_filtered = array_diff($pronouns_filtered, Job::alphabet_keywords());
   			$numeric_filtered = array_values(array_diff($alphabet_filtered, Job::numeric_keywords()));
   			$tier_2_result = $numeric_filtered;



   			//SEARCHING
   			$counted_results = []; // inst new array for counted results
   			// EMPTY FINALL ARRAY
   			$result_array = [];
			foreach ($tier_2_result as $key => $value) {
				$result_count = count(Thread::where('description','LIKE','%'.$value.'%')->get());
				$results_instances = Thread::where('description','LIKE','%'.$value.'%')->get();

				$array2 = []; // inst array for ids and search title and desc
				if ($results_instances) { //check count or empty
					foreach ($results_instances as $rikey => $rivalue) {
						$array2[$rivalue->id] = $rivalue->title.' '.$rivalue->description;
					}
				}
				if(count($array2) > 0) { // break array into one string to search for key words
					// merge title and description into one string
					foreach ($array2 as $arkey => $arvalue) {
						$accumulated_count = 0; // starts at 0
						foreach ($tier_2_result as $t2key => $t2value) {
							// count how many times it appears in string
							$appears = substr_count($arvalue, $t2value); // Needs to be changed find correct search function in string
							$accumulated_count += $appears;
						}
						$counted_results[$arkey] = $accumulated_count;
					}
				}
			}
			//SORT RESULTS
			arsort($counted_results,SORT_NUMERIC);
			//TIER 1 SEARCH HAS RESULTS KEEP 1 
			if(isset($final_product_tier1)){
				//ARRAY SLICE AND PRESERVE KEY
				$end_results = array_slice($counted_results, 0, 1,true);
			} else {
				//ARRAY SLICE AND PRESERVE KEY
				$end_results = array_slice($counted_results, 0, 2,true);
			}
			//EMPTY ARRAY
			$final_product_array = [];

			//RETRIEVE RESULTS
			$arr_count = 0;
			foreach ($end_results as $endkey => $endvalue) {
				$final_product_array[$arr_count] = Thread::find($endkey);
				$arr_count++;
			}
			$fp_count = 0;
			foreach ($final_product_array as $fpkey => $fpvalue) {
				$final_product[$final_product_array[$fpkey]->id]['id'] = $final_product_array[$fpkey]->id;
				$final_product[$final_product_array[$fpkey]->id]['title'] = $final_product_array[$fpkey]->title;


				$final_product[$final_product_array[$fpkey]->id]['description'] = implode(' ', array_slice(explode(' ', $final_product_array[$fpkey]->description), 0, 20));
				if (str_word_count($final_product_array[$fpkey]->description) > 20) {
					$final_product[$final_product_array[$fpkey]->id]['description'] .='...';
				}
				// Job::dump($final_product_array[$fpkey]->description);
				$fp_count++;
			}
   		}

   		//TIER 1 SEARCH HAS RESULTS, COMBINE THE ARRAYS
   		$merge = null;
   		if (isset($final_product_tier1)) {
   			$merge = array_replace($final_product,$final_product_tier1);
   		} elseif(isset($final_product)){
   			$merge = $final_product;
   		}

		return $merge;
	}
}
