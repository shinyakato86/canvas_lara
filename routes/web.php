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
    return view('index');
});

Auth::routes();

Route::get('/', 'App\Http\Controllers\IllustrationController@index')->name('index');

Route::get('/illustration/new', 'App\Http\Controllers\IllustrationController@create')->name('illustration.new');

Route::post('/illustration', 'App\Http\Controllers\IllustrationController@store')->name('illustration.store');

Route::get('/illustration/edit/{id}', 'App\Http\Controllers\IllustrationController@edit')->name('illustration.edit');

Route::post('/illustration/update/{id}', 'App\Http\Controllers\IllustrationController@update')->name('illustration.update');

Route::get('/illustration/{id}', 'App\Http\Controllers\IllustrationController@show')->name('illustration.detail');

Route::post('/illustration/comments/{id}', 'App\Http\Controllers\IllustrationController@addComment')->name('illustration.addComment');

Route::delete('/illustration/{id}', 'App\Http\Controllers\IllustrationController@destroy')->name('illustration.destroy');

Route::post('/like', 'App\Http\Controllers\IllustrationController@like')->name('illustration.like');