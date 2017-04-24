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

Route::group(['prefix' => 'project/{project}'], function () {

    // Static
    Route::get('add-eloquent', 'ProjectController@addEloquent')->name('project.add-eloquent');

    // Class
    Route::get('add-model', 'ProjectController@addModel')->name('project.add-model');
    Route::post('add-model', 'ProjectController@addModel')->name('project.post-add-model');
    
    Route::get('add-controller', 'ProjectController@addController')->name('project.add-controller');
    Route::post('add-controller', 'ProjectController@addController')->name('project.post-add-controller');

    Route::get('add-helper', 'ProjectController@addHelper')->name('project.add-helper');
    Route::post('add-helper', 'ProjectController@addHelper')->name('project.post-add-helper');

    Route::get('add-class', 'ProjectController@addClass')->name('project.add-class');
    Route::post('add-class', 'ProjectController@addClass')->name('project.post-add-class');

    Route::get('add-trait', 'ProjectController@addTrait')->name('project.add-trait');
    Route::post('add-trait', 'ProjectController@addTrait')->name('project.post-add-trait');

    // Function
    Route::get('add-function', 'ProjectController@addFunction')->name('project.add-function');
    Route::post('add-function', 'ProjectController@addFunction')->name('project.post-add-function');

    // Function
    Route::get('add-entire-view', 'ProjectController@addEntireView')->name('project.add-entire-view');
    Route::post('add-entire-view', 'ProjectController@addEntireView')->name('project.post-add-entire-view');

    // Install
//    Route::get('add-route', 'ProjectController@addRoute')->name('project.add-class');
//    Route::post('add-route', 'ProjectController@addRoute')->name('project.post-add-class');
    Route::get('install/{installer}', 'ProjectController@install')->name('project.install');
});

// === HQ ===========================================================

Route::get('hq/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
