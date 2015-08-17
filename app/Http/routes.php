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

Route::group(['middleware' => 'beforeFilter'], function () {
	//HOME ROUTE
	Route::get('/', 'HomeController@getIndex');



	/**
	 * ADMIN SECTION
	 */
	$acl_variable = "admins";
	/** PUBLIC SECTION **/
	Route::get('/admins/login', 'AdminsController@getLogin');
	Route::post('/admins/login', 'AdminsController@postLogin');
	Route::get('/admins/logout', 'AdminsController@getLogout');

		//NO ACL
		Route::get('/admins',  ['as'=>'admins_index', 'uses' => 'AdminsController@getIndex']);
		Route::get('/admins/roles/add',  ['as'=>'roles_add', 'uses' => 'RolesController@getAdd']);
		Route::post('/admins/roles/add',  ['uses' => 'RolesController@postAdd']);
		Route::get('/admins/permissions/add',  ['as'=>'permissions_add','uses' => 'PermissionsController@getAdd']);
		Route::post('/admins/permissions/add',  ['uses' => 'PermissionsController@postAdd']);
		Route::get('/admins/permission-roles/add',  ['as'=>'permissions_roles_add', 'uses' => 'PermissionRolesController@getAdd']);
		Route::post('/admins/permission-roles/add',  ['uses' => 'PermissionRolesController@postAdd']);
		Route::get('/admins/acl/view',  ['as' => 'acl_view','uses' => 'AdminsController@getViewAcl']);
		Route::get('/admins/categories/view',  ['as'=>'category_view', 'uses' => 'AdminsController@getViewCategory']);
		Route::get('/admins/categories/add',  ['as'=>'category_add', 'uses' => 'CategoriesController@getAdd']);
		Route::post('/admins/categories/add',  ['uses' => 'CategoriesController@postAdd']);
		Route::get('/admins/categories/edit',  ['as'=>'category_edit','uses' => 'CategoriesController@getEdit']);
		Route::post('/admins/categories/edit',  ['uses' => 'CategoriesController@postEdit']);

	/** ADMINS ACL GROUP **/
	Route::group(['middleware' => ['auth','acl:'.$acl_variable]], function(){
		// Route::get('/admins',  ['as'=>'admins_index', 'uses' => 'AdminsController@getIndex']);
		// Route::get('/admins/roles/add',  ['as'=>'roles_add', 'uses' => 'RolesController@getAdd']);
		// Route::post('/admins/roles/add',  ['uses' => 'RolesController@postAdd']);
		// Route::get('/admins/permissions/add',  ['as'=>'permissions_add','uses' => 'PermissionsController@getAdd']);
		// Route::post('/admins/permissions/add',  ['uses' => 'PermissionsController@postAdd']);
		// Route::get('/admins/permission-roles/add',  ['as'=>'permissions_roles_add', 'uses' => 'PermissionRolesController@getAdd']);
		// Route::post('/admins/permission-roles/add',  ['uses' => 'PermissionRolesController@postAdd']);
		// Route::get('/admins/acl/view',  ['as' => 'acl_view','uses' => 'AdminsController@getViewAcl']);
		// Route::get('/admins/categories/view',  ['as'=>'category_view', 'uses' => 'AdminsController@getViewCategory']);
		// Route::get('/admins/categories/add',  ['as'=>'category_add', 'uses' => 'CategoriesController@getAdd']);
		// Route::post('/admins/categories/add',  ['uses' => 'CategoriesController@postAdd']);
		// Route::get('/admins/categories/edit',  ['as'=>'category_edit','uses' => 'CategoriesController@getEdit']);
		// Route::post('/admins/categories/edit',  ['uses' => 'CategoriesController@postEdit']);
	});



	//CATEGORY ROUTE
	Route::post('/categories/search-cat', 'CategoriesController@postCatSearch');

	// Route::post('/search','HomeController@postIndex');
	Route::get('/search', 'HomeController@postIndex');
	Route::post('/search', 'HomeController@postIndex');

	//USER ROUTE
	Route::controller('users', 'UsersController');
		Route::get('/users/login', 'UsersController@getLogin');
		Route::post('/users/login-modal', 'UsersController@postLoginModal');
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
		Route::post('/threads/submit-flag', 'ThreadsController@postSubmitFlag');
		Route::post('/threads/submit-like', 'ThreadsController@postSubmitLike');
		Route::post('/threads/submit-dislike', 'ThreadsController@postSubmitDislike');
		Route::post('/threads/inpage-search', 'ThreadsController@postInpageSearch');

	Route::controller('password', 'Auth\PasswordController');

	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
		Route::post('password/email', 'Auth\PasswordController@postEmail');

	// // Password reset routes...
	// Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	// 	Route::post('password/reset', 'Auth\PasswordController@postReset');

});
