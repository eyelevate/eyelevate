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



Route::get('/admins',  [
	'uses' => 'AdminsController@getIndex',
	'middleware' => ['acl:admins']
	]);

// Route::get('/admins',  [
// 	'uses' => 'AdminsController@getIndex',
// 	'middleware' => ['acl:admins']
// 	]);

//ADMINS CONTROLLER
// Route::get('/admins', 'AdminsController@getIndex');	
Route::get('/admins/roles/add', 'AdminsController@getAddRoles');
Route::post('/admins/roles/add', 'AdminsController@postAddRoles');
Route::get('/admins/permissions/add', 'AdminsController@getAddPermission');
Route::post('/admins/permissions/add', 'AdminsController@postAddPermission');
Route::get('/admins/permission-roles/add', 'AdminsController@getAddPermissionRole');
Route::post('/admins/permission-roles/add', 'AdminsController@postAddPermissionRole');
// Route::get('/admins/add', 'AdminsController@getAdd');
// Route::post('/admins/add', 'AdminsController@postAdd');
// Route::get('/admins/edit', 'AdminsController@getEdit');
// Route::post('/admins/edit', 'AdminsController@postEdit');

//CATEGORY ROUTE
Route::post('/categories/search-cat', 'CategoriesController@postCatSearch');

// Route::post('/search','HomeController@postIndex');
Route::get('/search', ['middleware' => 'auth', 'uses' => 'HomeController@postIndex']);
Route::post('/search', ['middleware' => 'auth', 'uses' => 'HomeController@postIndex']);

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
