<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\MasterdataController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
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
    Route::get('/dashboard', [BendaharaController::class, 'index'])->name('dashboard');

    // master data produk
    Route::get('/produk', [MasterdataController::class, 'view_produk'])->name('produk');
    Route::post('/add_produk', [MasterdataController::class, 'store_produk'])->name('add_produk');
    Route::post('/edit_produk', [MasterdataController::class, 'update_produk'])->name('edit_produk');
    Route::get('/delete_produk/{id_produk}', [MasterdataController::class, 'delete_produk'])->name('delete_produk');

    // master data kontak
    Route::get('/kontak', [MasterdataController::class, 'view_kontak'])->name('kontak');
    Route::post('/add_kontak', [MasterdataController::class, 'store_kontak'])->name('add_kontak');
    Route::post('/edit_kontak', [MasterdataController::class, 'update_kontak'])->name('edit_kontak');
    Route::get('/delete_kontak/{id_kontak}', [MasterdataController::class, 'delete_kontak'])->name('delete_kontak');

    // master data prson level
    Route::get('/prson_level', [MasterdataController::class, 'view_prson'])->name('prson_level');
    Route::post('/add_prson_level', [MasterdataController::class, 'store_prson'])->name('add_prson_level');
    Route::post('/edit_prson_level', [MasterdataController::class, 'update_prson'])->name('edit_prson_level');
    Route::get('/delete_prson_level/{id_prson}', [MasterdataController::class, 'delete_prson'])->name('delete_prson_level');

    // master data akun
    Route::get('/akun', [MasterdataController::class, 'view_akun'])->name('akun');
    Route::post('/add_akun', [MasterdataController::class, 'store_akun'])->name('add_akun');
    Route::post('/edit_akun', [MasterdataController::class, 'update_akun'])->name('edit_akun');
    Route::get('/delete_akun/{id_akun}', [MasterdataController::class, 'delete_akun'])->name('delete_akun');

     // master data administrator
    Route::get('/administrator', [MasterdataController::class, 'view_administrator'])->name('administrator');
    Route::post('/add_administrator', [MasterdataController::class, 'store_administrator'])->name('add_administrator');
    Route::post('/edit_administrator', [MasterdataController::class, 'update_administrator'])->name('edit_administrator');
    Route::get('/delete_administrator/{id_administrator}', [MasterdataController::class, 'delete_administrator'])->name('delete_administrator');

    // Pemasukan
    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
    Route::post('/get_produk', [PemasukanController::class, 'get_produk'])->name('get-produk');
    Route::post('/add_pemasukan', [PemasukanController::class, 'add_pemasukan'])->name('add_pemasukan');
    Route::get('/result_transaksi/{id}', [PemasukanController::class, 'result_transaksi'])->name('result_transaksi');
    Route::get('/delete_pemasukan/{id}', [PemasukanController::class, 'delete_transaksi'])->name('delete_pemasukan');
    
    // pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::post('/add_pengeluaran', [PengeluaranController::class, 'add_pengeluaran'])->name('add_pengeluaran');
    Route::get('/delete_pengeluaran/{id}', [PengeluaranController::class, 'delete_transaksi'])->name('delete_pengeluaran');

    Route::get('/jurnal', [LaporanController::class, 'jurnal'])->name('jurnal');
});

// ==========  pimpinan routing ==========
Route::middleware('level-user:pimpinan')->group(function () {
    Route::get('pimpinan/dashboard', [PimpinanController::class, 'index']);
});
