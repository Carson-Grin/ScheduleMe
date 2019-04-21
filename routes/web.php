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


// this will open up welcome page
Route::get('/', function () {
    if(Auth::check()){
        return view('welcome');
    }else{
        return view('login');
    }
    
});

Route::get('events', 'EventController@index')->name('events.index');
Route::post('events', 'EventController@addEvent')->name('events.add');




