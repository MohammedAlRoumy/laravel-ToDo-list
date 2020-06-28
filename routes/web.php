<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('tasks/changeStatus', 'TasksController@changeStatus')->name('tasks.changeStatus');
Route::get('tasks/getData', 'TasksController@getData')->name('tasks.getData');
Route::resource('tasks', 'TasksController')->except(['show']);
