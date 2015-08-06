<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//HOME ROUTE
Route::get('/', 'HomeController@getIndex');



/**
 * ADMIN SECTION
 */
$acl_variable = "admins";
Route::get('/admins',  ['uses' => 'AdminsController@getIndex',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/roles/add',  ['uses' => 'AdminsController@getAddRoles',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::post('/admins/roles/add',  ['uses' => 'AdminsController@postAddRoles',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/permissions/add',  ['uses' => 'AdminsController@getAddPermission',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::post('/admins/permissions/add',  ['uses' => 'AdminsController@postAddPermission',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/permission-roles/add',  ['uses' => 'AdminsController@getAddPermissionRole',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::post('/admins/permission-roles/add',  ['uses' => 'AdminsController@postAddPermissionRole',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/acl/view',  ['uses' => 'AdminsController@getViewAcl',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/category/view',  ['uses' => 'AdminsController@getViewCategory',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/categories/add',  ['uses' => 'CategoriesController@getAdd',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::post('/admins/categories/add',  ['uses' => 'CategoriesController@postAdd',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/categories/edit',  ['uses' => 'CategoriesController@getEdit',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::post('/admins/categories/edit',  ['uses' => 'CategoriesController@postEdit',
						'middleware' => ['auth','acl:'.$acl_variable]
						]);
Route::get('/admins/login', 'AdminsController@getLogin');
Route::post('/admins/login', 'AdminsController@postLogin');
Route::get('/admins/logout', 'AdminsController@getLogout');


//CATEGORY ROUTE
Route::post('/categories/search-cat', 'CategoriesController@postCatSearch');

// Route::post('/search','HomeController@postIndex');
Route::get('/search', 'HomeController@postIndex');
Route::post('/search', 'HomeController@postIndex');

//USER ROUTE
Route::controller('users', 'UsersController');
	Route::get('/users/login', 'UsersController@getLogin');
	Route::get('/users/profile/{$username}', 'UsersController@getProfile');
	Route::get('/registration', 'UsersController@getRegistration');
	Route::post('/validate', 'UsersController@getValidate');
	Route::get('/logout', 'UsersController@getLogout');
	Route::post('/users/user-auth', 'UsersController@postUserAuth');
	Route::post('/users/send-file', 'UsersController@postSendFile');
	Route::post('/users/send-file-temp', 'UsersController@postSendFileTemp');


//REMINDERS ROUTE
Route::controller('reminders', 'RemindersController');
	Route::get('/password-reset', 'RemindersController@getForgot');

//THREAD ROUTE 
Route::controller('threads', 'ThreadsController');
	Route::get('/threads/view/{$id}', 'ThreadsController@getView');
	Route::post('/threads/search-query', 'ThreadsController@postSearchQuery');
	Route::post('/threads/retrive-quotes', 'ThreadsController@postRetriveQuotes');
	Route::post('/threads/post-answer', 'ThreadsController@postPostAnswer');
	Route::post('/threads/post-quote', 'ThreadsController@postPostQuote');

Route::controller('password', 'Auth\PasswordController');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
