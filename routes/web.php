<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//main
Route::get('/', function () {
	if(Auth::check()){
		return redirect('/home');
	}
    return view('index');
});

//sign-in
Route::get('auth/google', 'Auth\AuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\AuthController@handleProviderCallback');

//project
Route::get('/project/create', 'ProjectController@showCreateForm');
Route::post('/project/create', 'ProjectController@create');
Route::get('/project/edit', 'ProjectController@showEditForm');
Route::post('/project/edit', 'ProjectController@edit');
Route::get('/project/{id}', 'ProjectController@getById')->where('id', '[0-9]+');
Route::delete('/project/delete', 'ProjectController@delete');
Route::patch('/project/manage-status','ProjectController@manageStatus');

//home page
Route::get('/home', 'HomeController@index');

//user profile
Route::get('/user/{id}', 'UserController@index')->where('id', '[0-9]+');

//admin page
Route::get('/admin', 'AdminController@index');
Route::patch('/admin/manage-role', 'AdminController@manage');

//errors
Route::get("/forbidden", function(){
   return View::make("errors.403");
});

Auth::routes();
