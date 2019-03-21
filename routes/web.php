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
Route::get('/', function() {
    return view('welcome');
});
Route::get('/logout', 'Homecontroller@logout');
Route::get('/login', 'Homecontroller@login');
Route::get('/register', 'Homecontroller@register');
Route::get('/list-harga', 'Homecontroller@daftarharga');
Route::get('/list-hargapln', 'Homecontroller@daftarhargapln');
Route::get('/dashboard', 'Homecontroller@dashboard');
Route::get('/deposit', 'Homecontroller@deposit');
Route::get('/beli/{string}', 'Homecontroller@beli');
Route::get('/pln', 'Homecontroller@pln');
Route::get('/konfirmasi/{id}', 'Homecontroller@konfirmasi');
Route::get('/transfer', 'Homecontroller@transfer');
Route::get('/history/{string}', 'Homecontroller@history');
Route::get('/listharga/{string}', 'Homecontroller@listharga');
Route::get('/topup', 'Homecontroller@topup');
Route::get('/tambah_pembayaran', 'Homecontroller@tambahbank');
Route::get('/cekkonfirmasi', 'Homecontroller@cekkonfirmasi');
Route::get('/gantihargapulsa', 'Homecontroller@ubahpulsa');
Route::get('/gantihargapln', 'Homecontroller@ubahpln');
Route::Post('/dologin', 'Proses@dologin');
Route::Post('/doregis', 'Proses@doregis');
Route::get('/getpulsa', 'Proses@getpulsa');
Route::get('/gettransfer', 'Proses@getdata');
Route::get('/setting', 'Homecontroller@setting');
Route::get('/savetxt', 'proses@gettxtfile');
Route::any('/updatedata', 'Homecontroller@refresh');
Route::any('/updatedatapulsa', 'Homecontroller@refresh2');
Route::any('/updatedatapln', 'Homecontroller@refresh3');
Route::Post('/action/{string}', 'Homecontroller@proses');
Route::Post('/verifikasi/{id}', 'proses@verifikasi');
Route::Post('/dosetting', 'Homecontroller@dosetting');
Route::post('/finish', function(){
    return redirect()->route('dashboard');
})->name('donation.finish');
Route::post('/depositsaldo', 'Proses@deposit');
Route::post('/notification/handler', 'Proses@notificationHandler');
Route::Post('/konfirmasisaldo', 'Proses@konfirmasisaldo');
Route::Post('/actbank', 'Proses@actbank');
Route::Post('/delbank/{id}', 'Proses@deletebank');
Route::Post('/updatehargapulsa', 'Proses@updatehargapulsa');
Route::any('/addmutasi', 'Homecontroller@addcekmutasi');
Route::any('/apaantau', 'Homecontroller@apaantau');
Route::any('/apaantuh', 'Proses@put');

 