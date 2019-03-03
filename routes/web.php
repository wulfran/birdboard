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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){
    Route::get('projects', ['as' => 'projects.list', 'uses' => 'ProjectsController@getIndex']);
    Route::get('projects/create', ['as' => 'projects.create', 'uses' => 'ProjectsController@getAdd']);
    Route::post('projects', ['as' => 'projects.save', 'uses' => 'ProjectsController@postSave']);
    Route::get('/projects/{project}', [ 'as' => 'projects.show', 'uses' => 'ProjectsController@getShow']);
    Route::patch('/projects/{project}', ['as' => 'projects.update', 'uses' => 'ProjectsController@postUpdate']);


    Route::post('/projects/{project}/tasks/add', ['as' => 'projects.tasks.add', 'uses' => 'ProjectTasksController@postSave']);
    Route::patch('/projects/{project}/tasks/{task}', ['as' => 'projects.tasks.patch', 'uses' => 'ProjectTasksController@postUpdate']);
});
