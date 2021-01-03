<?php

use App\Http\Controllers\AuthController;
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
    return view('home');
});

Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware'=>['auth','CheckRole:Admin']],function(){
    Route::get('/siswa','SiswaController@index');
    Route::post('/siswa/create','SiswaController@store');
    Route::get('/siswa/{id}/edit','SiswaController@edit');
    Route::post('/siswa/{id}/update','SiswaController@update');
    Route::get('/siswa/{id}/delete','SiswaController@delete');
    Route::get('/siswa/{id}/profile','SiswaController@profile');
    Route::post('/siswa/{id}/addnilai','SiswaController@addnilai');
    Route::get('/siswa/{id}/{idmapel}/deletenilai','SiswaController@deletenilai');
    Route::get('/siswa/export','SiswaController@exportexcel');
    Route::get('/siswa/exportpdf','SiswaController@exportpdf');
    Route::post('/siswa/import','SiswaController@import');
    Route::get('/guru','GuruController@index');
    Route::get('/guru/{id}/Profile','GuruController@profile');
});

Route::group(['middleware'=>['auth','CheckRole:Admin,Siswa']],function(){
    Route::get('/dashboard','DashboardController@index');
});