<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PostController@index')->name('index');
Route::get('/posts/create', 'PostController@create')->name('new-post')->middleware('auth');
Route::get('/posts/{id}', 'PostController@show')->name('single-post');
Route::post('/posts', 'PostController@store')->name('save-post')->middleware('auth');
Route::patch('/posts/{id}', 'PostController@update')->name('update-post')->middleware('auth');
Route::get('/posts/{id}/edit', 'PostController@edit')->name('edit-post')->middleware('auth');
Route::delete('/posts/{id}', 'PostController@destroy')->name('delete-post')->middleware('auth');

Route::post('/', 'PostController@searchPost')->name('search-post');

Route::get('/posts/author/{id}', 'PostController@author')->name('author');

Route::post('/comment', 'CommentController@store')->name('post-comment');
Route::delete('/comment/{id}', 'CommentController@destroy')->name('delete-comment')->middleware('auth');


Route::get('/category', 'PostController@newCategory')->name('new-category')->middleware('auth');
Route::post('/category', 'PostController@makeCategory')->name('make-category')->middleware('auth');

Route::get('/category/{categoryName}','PostController@category')->name('category');