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
    'except' => ['create', 'edit',]
]);
Route::get('destaques', 'PropertyController@destaques');
Route::post('property/user', 'PropertyController@propertyByUser');

Route::put('user/edit/{user}', 'UserController@update');

Route::get('auth/init', 'UserController@init');
Route::post('auth/login', 'UserController@login');
Route::post('auth/logout', 'UserController@logout');
Route::post('auth/register', 'UserController@store');

