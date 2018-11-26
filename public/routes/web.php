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

Route::get('/', 'IndexController@index');
Route::get('/cat/{id}', 'IndexController@category');
Route::get('/date/{month}/{year}', 'IndexController@created');
Route::get('/art/{id}', 'IndexController@article');


Route::get('/users', ['middleware' => ['auth'], 'uses'=>'Core@show']);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('/article', 'Admin\ArticleResource')->middleware('auth');
Route::resource('/category', 'Admin\CategoryResource')->middleware('auth');
Route::get('/comments', 'Admin\CommentsController@index')->middleware('auth');