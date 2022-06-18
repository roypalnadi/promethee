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

Auth::routes();

Route::get('/proses', 'HomeController@proses')->name('proses');

Route::resource('users', 'UserController')
    ->middleware('auth');

Route::resource('alternatif', 'AlternatifController')
    ->middleware('auth');

Route::resource('kriteria', 'KriteriaController')
    ->middleware('auth');

Route::resource('bobot', 'BobotController')
    ->middleware('auth');

// Route::get('/alternatif', 'HomeController@alternatif')->name('alternatif');
// Route::get('/kriteria', 'HomeController@kriteria')->name('kriteria');
// Route::get('/proses', 'HomeController@proses')->name('proses');

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
