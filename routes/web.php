<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@index')->name('mainpage');

Route::get('project/{name}', 'ProjectController@show')->name('project.show');

Route::group(['prefix' => 'project/{name}'], function () {

    Route::get('add-model', 'ProjectController@addModel')->name('project.add-model');
    Route::post('add-model', 'ProjectController@addModel')->name('project.post-add-model');
});
