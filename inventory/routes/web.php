<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StockController;


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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('barang', BarangController::class);

    Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk_index');
    Route::get('/barangmasuk/create_hdr', [BarangMasukController::class, 'create_hdr'])->name('barangmasuk_createhdr');
    Route::post('/barangmasuk/store_hdr', [BarangMasukController::class, 'store_hdr'])->name('barangmasuk_storehdr');
    Route::post('/barangmasuk/update_hdr/{id}', [BarangMasukController::class, 'update_hdr'])->name('barangmasuk_updatehdr');
    Route::get('/barangmasuk/list_dtl', [BarangMasukController::class, 'list_dtl'])->name('barangmasuk_list_dtl');
    Route::get('/barangmasuk/create_dtl/{id}', [BarangMasukController::class, 'create_dtl'])->name('barangmasuk_createdtl');
    Route::post('/barangmasuk/store_dtl', [BarangMasukController::class, 'store_dtl'])->name('barangmasuk_storedtl');
    Route::delete('/barangmasuk/destroy_dtl/{id}', [BarangMasukController::class, 'destroy_dtl'])->name('barangmasuk_destroy_dtl');
    Route::get('/barangmasuk/edit/{id}', [BarangMasukController::class, 'edit'])->name('barangmasuk_edit');

    Route::get('/barangkeluar', [BarangKeluarController::class, 'index'])->name('barangkeluar_index');
    Route::get('/barangkeluar/create_hdr', [BarangKeluarController::class, 'create_hdr'])->name('barangkeluar_createhdr');
    Route::post('/barangkeluar/store_hdr', [BarangKeluarController::class, 'store_hdr'])->name('barangkeluar_storehdr');
    Route::post('/barangkeluar/update_hdr/{id}', [BarangKeluarController::class, 'update_hdr'])->name('barangkeluar_updatehdr');
    Route::get('/barangkeluar/list_dtl', [BarangKeluarController::class, 'list_dtl'])->name('barangkeluar_list_dtl');
    Route::get('/barangkeluar/create_dtl/{id}', [BarangKeluarController::class, 'create_dtl'])->name('barangkeluar_createdtl');
    Route::post('/barangkeluar/store_dtl', [BarangKeluarController::class, 'store_dtl'])->name('barangkeluar_storedtl');
    Route::delete('/barangkeluar/destroy_dtl/{id}', [BarangKeluarController::class, 'destroy_dtl'])->name('barangkeluar_destroy_dtl');
    Route::get('/barangkeluar/edit/{id}', [BarangKeluarController::class, 'edit'])->name('barangkeluar_edit');

    Route::get('/stock', [StockController::class, 'index'])->name('stock_index');
});



