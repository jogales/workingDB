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

Route::get('/productsFill','ProductController@syncDB');

Route::post('/productsTable','ProductController@fillTable');

//Route::resource('job','JobController');
//
//Route::resource('offices','OfficeController');
//
//Route::resource('employees','EmployeeController');

Route::resource('products','ProductController');

