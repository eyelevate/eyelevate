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


		Route::get('/admins/roles/index',  ['as'=>'roles_index', 'uses' => 'RolesController@getIndex']);
		Route::get('/admins/roles/add',  ['as'=>'roles_add', 'uses' => 'RolesController@getAdd']);
		Route::post('/admins/roles/add',  ['uses' => 'RolesController@postAdd']);
		Route::get('/admins/roles/edit/{id}',  ['as'=>'roles_edit', 'uses' => 'RolesController@getEdit']);
		Route::post('/admins/roles/edit',  ['as'=>'roles_update','uses' => 'RolesController@postEdit']);
		Route::get('/admins/roles/delete-data/{id}',  ['as'=>'roles_delete', 'uses' => 'RolesController@getDelete']);



		Route::get('/admins/permissions/index',  ['as'=>'permissions_index', 'uses' => 'PermissionsController@getIndex']);
		Route::get('/admins/permissions/add',  ['as'=>'permissions_add','uses' => 'PermissionsController@getAdd']);
		Route::post('/admins/permissions/add',  ['uses' => 'PermissionsController@postAdd']);
		Route::get('/admins/permissions/edit/{id}',  ['as'=>'permissions_edit','uses' => 'PermissionsController@getEdit']);
		Route::post('/admins/permissions/edit',  ['uses' => 'PermissionsController@postEdit']);
		Route::get('/admins/permissions/delete-data/{id}',  ['as'=>'permissions_delete','uses' => 'PermissionsController@getDelete']);



		Route::get('/admins/permission-roles/index',  ['as'=>'permission_roles_index', 'uses' => 'PermissionRolesController@getIndex']);
		Route::get('/admins/permission-roles/add',  ['as'=>'permission_roles_add', 'uses' => 'PermissionRolesController@getAdd']);
		Route::post('/admins/permission-roles/add',  ['uses' => 'PermissionRolesController@postAdd']);
		Route::get('/admins/permission-roles/edit/{id}',  ['as'=>'permission_roles_edit', 'uses' => 'PermissionRolesController@getEdit']);
		Route::post('/admins/permission-roles/edit',  ['uses' => 'PermissionRolesController@postEdit']);
		Route::get('/admins/permission-roles/delete-data/{id}',  ['as'=>'permission_roles_delete', 'uses' => 'PermissionRolesController@getDelete']);

		Route::get('/admins/flags/index',  ['as'=>'flags_index', 'uses' => 'FlagsController@getIndex']);
		Route::get('/admins/flags/view/{id}',  ['as'=>'flag_view', 'uses' => 'FlagsController@getView']);
		Route::post('/admins/flags/view',  ['uses' => 'FlagsController@postView']);
		Route::get('/admins/flags/index/approved',  ['as'=>'flags_app', 'uses' => 'FlagsController@getApproved']);
		Route::get('/admins/flags/index/rejected',  ['as'=>'flags_rej', 'uses' => 'FlagsController@getRejected']);
		Route::get('/admins/flags/index/re-flagged',  ['as'=>'flags_re', 'uses' => 'FlagsController@getReflagged']);
		Route::get('/admins/flags/index/final-approved',  ['as'=>'flags_f_app', 'uses' => 'FlagsController@getFinalApproved']);
		Route::get('/admins/flags/index/final-reject',  ['as'=>'flags_f_rej', 'uses' => 'FlagsController@getFinalRejected']);
		Route::get('/admins/flags/index/banned',  ['as'=>'flags_banned', 'uses' => 'FlagsController@getBanned']);

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
		Route::get('/threads/view/{id}',  ['as'=>'thread_view','uses' => 'ThreadsController@getView']);
		Route::post('/threads/search-query', 'ThreadsController@postSearchQuery');
		Route::post('/threads/retrive-quotes', 'ThreadsController@postRetriveQuotes');
		Route::post('/threads/post-answer', 'ThreadsController@postPostAnswer');
		Route::post('/threads/post-quote', 'ThreadsController@postPostQuote');
		Route::post('/threads/submit-flag', 'ThreadsController@postSubmitFlag');
		Route::post('/threads/remove-flag', 'ThreadsController@postRemoveFlag');
		Route::post('/threads/check-flag', 'ThreadsController@postCheckFlag');
		Route::post('/threads/submit-like', 'ThreadsController@postSubmitLike');
		Route::post('/threads/submit-dislike', 'ThreadsController@postSubmitDislike');
		Route::post('/threads/inpage-search', 'ThreadsController@postInpageSearch');

	Route::controller('password', 'Auth\PasswordController');

	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
		Route::post('password/email', 'Auth\PasswordController@postEmail');

	//PERMISSIONS ROUTE
	Route::controller('permissions', 'PermissionsController');
		Route::get('/permissions/auto-update', 'PermissionsController@getAutoUpdate');
	// // Password reset routes...
	// Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	// 	Route::post('password/reset', 'Auth\PasswordController@postReset');

});
