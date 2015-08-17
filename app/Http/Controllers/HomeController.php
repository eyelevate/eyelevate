<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Input;
use Session;
use Auth;
use URL;
use Flash; // Session Flash helper

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\Thread;
use App\Category;
use App\Search;

class HomeController extends Controller
{

    public function __construct() {

        // $this->layout = "layouts.test";

        //FIRST TEMPLATE
        // $this->layout = "layouts.master";

        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";

        // // THIRD TEMPLATE
        $this->layout = "layouts.home-layout";
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $reset_success = (Session::get('reset_success')) ? true : false;
        $username = (Auth::check()) ? Auth::user()->username : null;
        return view('home.home-index')
            ->with('layout',$this->layout)
            ->with('username',$username)
            ->with('reset_success',$reset_success);
    }

    public function postIndex()
    {
        // $search_array_count = 0;
        // $paginate_num = 10;
        // $new_paginate_num = 10;
        //FIND SEARCH RESULTS
        $search_query = Input::get('searched-content');
        $searched_results_html = '';
        if ($search_query) {
            if (strlen($search_query) > 2) {
                $searched_results_html = '<h4>You searched for : '.$search_query.'</h4> ';
                $search_results = Search::index_search_function($search_query);
                if (!empty($search_results)) {
                    // $search_array_count = sizeof($search_results);
                    $searched_results_html = Thread::prepareSearchedResults($search_results);
                    // $new_paginate_num =  $paginate_num - $search_array_count;
                    // $new_paginate_num = $new_paginate_num < 1?$new_paginate_num = 1:$new_paginate_num;
                } else {
                    $searched_results_html .= '"'.$search_query.'" Did not match any threads.';
                    $searched_results_html .= '<hr><h4>Suggestions:</h4>
                                    <ul>
                                      <li>Make sure all words spelled correctly</li>
                                      <li>Try diffrent or fewer words</li>
                                    </ul> 
                                    <h4 class="other-thread">Other threads:</h4><hr>';
                }
            }
        }
        //ALL THREADS
        $prepared_thread = Thread::prepareThreadForView(Thread::Where('status',1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10));
        $prepared_thread_clone = Thread::Where('status',1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $this->layout = 'layouts.master-layout';
        $categories_for_select = Category::prepareForSelect(Category::where('status',1)->get());
        $categories_for_side = Category::prepareForSide(Category::where('status',1)->get());

        return view('home.results')
            ->with('layout',$this->layout)
            ->with('threads',$prepared_thread)
            ->with('prepared_thread_clone',$prepared_thread_clone)
            ->with('categories_for_select',$categories_for_select)
            ->with('categories_for_side',$categories_for_side)
            ->with('searched_results_html',$searched_results_html);       
        
    } 
}
