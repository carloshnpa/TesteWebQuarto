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


Route::resource('/property', 'PropertyController', [
    'except' => ['create', 'edit']
]);
Route::get('destaques', 'PropertyController@destaques');

Route::resource('/user', 'UserController', [
    'except' => ['index', 'login', 'logout', 'create', 'store', 'edit']
]);
Route::prefix('auth')->group(function(){
    Route::get('init', 'UserController@init');
    Route::post('login', 'UserController@login');
    Route::post('logout', 'UserController@logout');
    Route::post('register', 'UserController@create');
});

