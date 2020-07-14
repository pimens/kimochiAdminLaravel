<?php

use App\Http\Controllers\HomeController;
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
//makanan
Route::get('/makanan', 'MakananController@index');
Route::Post('/makanan', 'MakananController@store');
Route::get('/makanan/create', 'MakananController@create');
Route::get('/makanan/{id}/edit','MakananController@edit');
Route::delete('/makanan/{id}','MakananController@destroy');
Route::patch('/makanan/{id}', 'MakananController@update');

//login
Route::get('/','HomeController@index');
Route::get('/logout','HomeController@logout');
Route::Post('/','HomeController@loginPost');

//cabang
Route::get('/cabang', 'CabangController@index');
Route::Post('/cabang', 'CabangController@store');
Route::get('/cabang/create', 'CabangController@create');
Route::get('/cabang/{id}/edit','CabangController@edit');
Route::delete('/cabang/{id}','CabangController@destroy');
Route::patch('/cabang/{id}', 'CabangController@update');

//promo
Route::get('/promo', 'PromoController@index');
Route::Post('/promo', 'PromoController@store');
Route::get('/promo/create', 'PromoController@create');
Route::get('/promo/{id}/edit','PromoController@edit');
Route::delete('/promo/{id}','PromoController@destroy');
Route::patch('/promo/{id}', 'PromoController@update');
// Route::get('/login',function(){
//     return view('login');
// });
// Route::get('tes',function(){
//     return view('login',['n'=>"xxx"]);
// });
// Route::get('/beranda', 'HomeController@beranda');
// Route::get('/makanan', function () {
//     $query = "select * from makanan";
//     return $query;
// });
