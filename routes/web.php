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
Route::group(['as' => 'user.', 'namespace' => 'Home'], function () {
    Route::get('/auth/login', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', 'LoginController@showFormLogin')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
