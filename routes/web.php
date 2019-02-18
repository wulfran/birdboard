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

Route::get('/', function () {
    return view('welcome');
});

Route::get('projects', ['as' => 'projects.get', 'uses' => 'ProjectsController@getIndex']);
Route::get('/projects/{project}', [ 'as' => 'projects.show', 'uses' => 'ProjectsController@getShow']);

Route::post('projects', ['as' => 'projects.save', 'uses' => 'ProjectsController@postSave']);