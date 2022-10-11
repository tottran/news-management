<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects', 'ProjectController@index')->name('project.all');

Route::post('/projects', 'ProjectController@store')->name('project.store');

Route::get('/projects/{project}', 'ProjectController@show')->name('project.show');

Route::put('/projects/{project}', 'ProjectController@update')->name('project.update');

Route::delete('/projects/{project}', 'ProjectController@destroy')->name('project.destroy');

// User api
// Route::resource('users', 'API\UserController');
