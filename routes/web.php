<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PostsController@list');
Route::get('/post/{id}', 'PostsController@show');

Route::get('/post/insert', 'PostsController@insert');
Route::post('/post/insert', 'PostsController@do_insert');

Route::get('/post/{id}/update', 'PostsController@update');
Route::post('/post/{id}/update', 'PostsController@do_update');

Route::get('/post/{id}/delete', 'PostsController@delete');


Auth::routes(['reset'=>false]);

// Route::get('/home', 'HomeController@index')->name('home');

