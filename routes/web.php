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
    $result = array();
    return view('welcome', compact('result'));
})->name('welcome');
Route::get('/upload', function () {
    return view('upload');
});
Route::post('/uploadFile', 'UploadController@uploadFile')->name('uploadFile');
Route::post('/search', 'UploadController@search')->name('search');
Route::get('/uploadAll', 'UploadController@uploadAllFiles')->name('uploadAll');
Route::get('/delete', 'UploadController@delete')->name('delete');
//Route::get('/update', 'UploadController@updateAll')->name('update');
Route::post('/deleteAll', 'UploadController@deleteAll')->name('deleteAll');
