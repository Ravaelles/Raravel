<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('add-service', 'ProjectController@addService')->name('project.add-service');
    Route::post('add-service', 'ProjectController@addService')->name('project.post-add-service');

    Route::get('add-trait', 'ProjectController@addTrait')->name('project.add-trait');
    Route::post('add-trait', 'ProjectController@addTrait')->name('project.post-add-trait');

    // Function
    Route::get('add-function', 'ProjectController@addRouteAndFunction')->name('project.add-function');
    Route::post('add-function', 'ProjectController@addRouteAndFunction')->name('project.post-add-function');

    // Post Function
    Route::get('add-post-function', 'ProjectController@addPostFunction')->name('project.add-post-function');
    Route::post('add-post-function', 'ProjectController@addPostFunction')->name('project.post-add-post-function');

    // View + Function + Route
    Route::get('add-entire-view', 'ProjectController@addEntireView')->name('project.add-entire-view');
    Route::post('add-entire-view', 'ProjectController@addEntireView')->name('project.post-add-entire-view');

    // Partial
    Route::get('add-partial', 'ProjectController@addPartial')->name('project.add-partial');
    Route::post('add-partial', 'ProjectController@addPartial')->name('project.post-add-partial');

    // Install
//    Route::get('add-route', 'ProjectController@addRoute')->name('project.add-class');
//    Route::post('add-route', 'ProjectController@addRoute')->name('project.post-add-class');
    Route::get('install/{installer}', 'ProjectController@install')->name('project.install');
});

// === HQ ===========================================================

Route::get('hq/mongo/{class}/{id?}/remove', 'MongoController@remove')
    ->name('mongo.remove')->where('id', '.*');
Route::get('hq/mongo/{class}/{id?}/edit', 'MongoController@edit')
    ->name('mongo.edit')->where('id', '.*');
Route::post('hq/mongo/{class}/{id?}/edit', 'MongoController@edit')
    ->name('mongo.update')->where('id', '.*');
Route::get('hq/mongo/{class}/add', 'MongoController@edit')
    ->name('mongo.add');
Route::post('hq/mongo/{class}/add', 'MongoController@edit')
    ->name('mongo.store');
Route::get('hq/mongo/{class?}/{id?}', 'MongoController@show')
    ->name('mongo.show')->where('id', '.*');

Route::get('hq/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('hq/whoami', 'HQController@whoAmI');

Route::get('hq/phpinfo', 'HQController@phpinfo');

Route::get('hq/session', 'HQController@session');

Route::get('hq/session-destroy', 'HQController@sessionDestroy');

Route::get('test', 'MainController@test')->name('main.test');

Route::get('tests/{params}', 'TestsController@run')->name('tests');
