<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// http://localhost/blog/public/api/makanan

// Route::patch('/makanan/{id}', 'ApiApps@update');

//api
//makananProv
Route::get('/makanan/getMakananOffset/{s}/{off}','ApiApps@getMakananOffset');
//order
Route::get('/makanan/getMaxTrx','ApiApps@getMaxTrx');
Route::get('/makanan/getJUser/{nohp}','ApiApps@getJUser');
Route::Post('/makanan/insertInvoice/','ApiApps@insertInvoice');


Route::get('/makanan/getJumlahOrder','ApiApps@getJumlahOrder');
Route::get('/makanan/getNewTrx/','ApiApps@getNewTrx');
Route::get('/makanan/getTrxById/{id}','ApiApps@getTrxById');
Route::get('/makanan/deleteTrx/{id}','ApiApps@deleteTrx');
//beranda
Route::get('/makanan/promo','ApiApps@promo');
//cabangprov
Route::get('/makanan/getCabang','ApiApps@getCabang');
//recent
Route::get('/makanan/getTrx/{id}','ApiApps@getTrx');


//=============admin
Route::get('/makanan/getCabangOrder','ApiApps@getCabangOrder');
Route::get('/makanan/getNewTrx','ApiApps@getNewTrx');
Route::get('/makanan/getTrxByCabang/{id}','ApiApps@getTrxByCabang');
Route::get('/makanan/finish/{id}/{status}','ApiApps@finish');

//auth
Route::Post('/makanan/login/','ApiWeb@login');
//dash
Route::get('/makanan/getMakanan/','ApiWeb@index');
Route::get('/makanan/pemasukan/','ApiWeb@pemasukan');
Route::delete('/makanan/deleteMakanan/{id}','ApiWeb@deleteMakanan');
Route::get('/makanan/getMakananById/{id}','ApiWeb@getMakananById');
Route::Post('/makanan/editMakanan/','ApiWeb@editMakanan');
Route::Post('/makanan/insertMakanan/','ApiWeb@insertMakanan');

Route::get('/makanan/getCabang/','ApiWebCabang@index');
Route::delete('/makanan/deleteCabang/{id}','ApiWebCabang@deleteCabang');
Route::get('/makanan/getCabangById/{id}','ApiWebCabang@getCabangById');
Route::Post('/makanan/editCabang/','ApiWebCabang@editCabang');
//kalau pake pacth image ubah base64
Route::Post('/makanan/insertCabang/','ApiWebCabang@insertCabang');


Route::get('/makanan/getPromo/','ApiWebPromo@index');
Route::delete('/makanan/deletePromo/{id}','ApiWebPromo@deletePromo');
Route::get('/makanan/getPromoById/{id}','ApiWebPromo@getPromoById');
Route::Post('/makanan/editPromo/','ApiWebPromo@editPromo');
Route::Post('/makanan/insertPromo/','ApiWebPromo@insertPromo');




// Route::get('/makanan','ApiApps@get');
// Route::Post('/makanan', 'ApiApps@post');
// Route::patch('/makanan/{id}','ApiApps@put');









// Route::get('/makanan',function(){
//     return response()->json(
//         [
//             "message" => "succes"
//         ]
//         );
// });