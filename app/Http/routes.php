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
// Route::post('/search','HomeController@postIndex');
Route::get('/search', ['middleware' => 'auth', 'uses' => 'HomeController@postIndex']);
Route::post('/search', ['middleware' => 'auth', 'uses' => 'HomeController@postIndex']);

//USER ROUTE
Route::controller('users', 'UsersController');
	Route::get('/registration', 'UsersController@getRegistration');
	Route::post('/validate', 'UsersController@getValidate');
	Route::get('/logout', 'UsersController@getLogout');
	Route::post('/users/user-auth', 'UsersController@postUserAuth');

//REMINDERS ROUTE
Route::controller('reminders', 'RemindersController');
	Route::get('/password-reset', 'RemindersController@getForgot');

//THREAD ROUTE 
Route::controller('threads', 'ThreadsController');
	Route::post('/threads/search-query', 'ThreadsController@postSearchQuery');


Route::controller('password', 'Auth\PasswordController');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
	
