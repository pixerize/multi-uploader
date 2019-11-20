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

Route::get('/', 'ImagesController@index');

Route::post('/images-upload', 'ImagesController@upload');
Route::post('/deleteFile', 'FileController@destroy')->name('deletefile');
