<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\MasterdataController;
use App\Http\Controllers\PemasukanController;
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
// Public Routing
Route::get('/', function () {
    return redirect('login');
});

Route::get('/login',[LoginController::class, 'index']);
Route::post('/act_login', [LoginController::class, 'Authenticate']);
Route::get('/logout',[LoginController::class, 'logout']);

// ==========  bendahara routing ==========
Route::middleware('level-user:bendahara')->group(function () {
    Route::get('/dashboard', [BendaharaController::class, 'index']);

    // master data produk
    Route::get('/produk', [MasterdataController::class, 'view_produk']);
    Route::post('/add_produk', [MasterdataController::class, 'store_produk']);
    Route::post('/edit_produk', [MasterdataController::class, 'update_produk']);
    Route::get('/delete_produk/{id_produk}', [MasterdataController::class, 'delete_produk']);

    // master data kontak
    Route::get('/kontak', [MasterdataController::class, 'view_kontak']);
    Route::post('/add_kontak', [MasterdataController::class, 'store_kontak']);
    Route::post('/edit_kontak', [MasterdataController::class, 'update_kontak']);
    Route::get('/delete_kontak/{id_kontak}', [MasterdataController::class, 'delete_kontak']);

    // master data prson level
    Route::get('/prson_level', [MasterdataController::class, 'view_prson']);
    Route::post('/add_prson_level', [MasterdataController::class, 'store_prson']);
    Route::post('/edit_prson_level', [MasterdataController::class, 'update_prson']);
    Route::get('/delete_prson_level/{id_prson}', [MasterdataController::class, 'delete_prson']);

    // master data akun
    Route::get('/akun', [MasterdataController::class, 'view_akun']);
    Route::post('/add_akun', [MasterdataController::class, 'store_akun']);
    Route::post('/edit_akun', [MasterdataController::class, 'update_akun']);
    Route::get('/delete_akun/{id_akun}', [MasterdataController::class, 'delete_akun']);

     // master data administrator
    Route::get('/administrator', [MasterdataController::class, 'view_administrator']);
    Route::post('/add_administrator', [MasterdataController::class, 'store_administrator']);
    Route::post('/edit_administrator', [MasterdataController::class, 'update_administrator']);
    Route::get('/delete_administrator/{id_administrator}', [MasterdataController::class, 'delete_administrator']);

    // Pemasukan
    Route::get('/pemasukan', [PemasukanController::class, 'index']);
    Route::post('/get_produk', [PemasukanController::class, 'get_produk'])->name('get-produk');
    Route::post('/add_pemasukan', [PemasukanController::class, 'add_pemasukan']);
    Route::get('/result_transaksi/{id}', [PemasukanController::class, 'result_transaksi']);
});

// ==========  pimpinan routing ==========
Route::middleware('level-user:pimpinan')->group(function () {
    Route::get('pimpinan/dashboard', [PimpinanController::class, 'index']);
});
