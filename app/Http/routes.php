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

Route::resource('/', 'User\IndexController');

//Route::group(['prefix' => 'admin/management', 'middleware' => ['web']], function () {
	Route::resource('/story', 'Admin\StoryController');
	Route::resource('/category', 'Admin\CategoryController');
	Route::get('/auto', 'Admin\StoryController@automatic');
//});