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

//Route::get('/', 'MainController@index')->name('mainpage');
Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('mainpage');

Route::get('project/{name}', \App\Http\Controllers\ProjectController::class . '@show')->name('project.show');

Route::group(['prefix' => 'project/{project}'], function () {

    // Static
    Route::get('add-eloquent', \App\Http\Controllers\ProjectController::class . '@addEloquent')->name('project.add-eloquent');

    // Class
    Route::get('add-model', \App\Http\Controllers\ProjectController::class . '@addModel')->name('project.add-model');
    Route::post('add-model', \App\Http\Controllers\ProjectController::class . '@addModel')->name('project.post-add-model');

    Route::get('add-controller', \App\Http\Controllers\ProjectController::class . '@addController')->name('project.add-controller');
    Route::post('add-controller', \App\Http\Controllers\ProjectController::class . '@addController')->name('project.post-add-controller');

    Route::get('add-helper', \App\Http\Controllers\ProjectController::class . '@addHelper')->name('project.add-helper');
    Route::post('add-helper', \App\Http\Controllers\ProjectController::class . '@addHelper')->name('project.post-add-helper');

    Route::get('add-class', \App\Http\Controllers\ProjectController::class . '@addClass')->name('project.add-class');
    Route::post('add-class', \App\Http\Controllers\ProjectController::class . '@addClass')->name('project.post-add-class');

    Route::get('add-service', \App\Http\Controllers\ProjectController::class . '@addService')->name('project.add-service');
    Route::post('add-service', \App\Http\Controllers\ProjectController::class . '@addService')->name('project.post-add-service');

    Route::get('add-trait', \App\Http\Controllers\ProjectController::class . '@addTrait')->name('project.add-trait');
    Route::post('add-trait', \App\Http\Controllers\ProjectController::class . '@addTrait')->name('project.post-add-trait');

    // Function
    Route::get('add-function', \App\Http\Controllers\ProjectController::class . '@addRouteAndFunction')->name('project.add-function');
    Route::post('add-function', \App\Http\Controllers\ProjectController::class . '@addRouteAndFunction')->name('project.post-add-function');

    // Post Function
    Route::get('add-post-function', \App\Http\Controllers\ProjectController::class . '@addPostFunction')->name('project.add-post-function');
    Route::post('add-post-function', \App\Http\Controllers\ProjectController::class . '@addPostFunction')->name('project.post-add-post-function');

    // View + Function + Route
    Route::get('add-entire-view', \App\Http\Controllers\ProjectController::class . '@addEntireView')->name('project.add-entire-view');
    Route::post('add-entire-view', \App\Http\Controllers\ProjectController::class . '@addEntireView')->name('project.post-add-entire-view');

    // Partial
    Route::get('add-partial', \App\Http\Controllers\ProjectController::class . '@addPartial')->name('project.add-partial');
    Route::post('add-partial', \App\Http\Controllers\ProjectController::class . '@addPartial')->name('project.post-add-partial');

    // Install
//    Route::get('add-route', \App\Http\Controllers\ProjectController::class . '@addRoute')->name('project.add-class');
//    Route::post('add-route', \App\Http\Controllers\ProjectController::class . '@addRoute')->name('project.post-add-class');
    Route::get('install/{installer}', \App\Http\Controllers\ProjectController::class . '@install')->name('project.install');
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
