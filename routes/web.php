<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\KeranjangPesananController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Karyawan

    Route::resource('karyawan', UserController::class)->except('create', 'show', 'edit');
    Route::get('/karyawan/readData', [UserController::class, 'readData'])->name('karyawan.readData');
    Route::get('/karyawan/showForm', [UserController::class, 'showForm'])->name('karyawan.showForm');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Inventory

    Route::resource('kategori-barang', KategoriBarangController::class)->except('create', 'show', 'edit');
    Route::get('/kategori-barang/readData', [KategoriBarangController::class, 'readData'])->name('kategori-barang.readData');
    Route::get('/kategori-barang/showForm', [KategoriBarangController::class, 'showForm'])->name('kategori-barang.showForm');

    Route::resource('barang', BarangController::class)->except('create', 'show', 'edit');
    Route::get('/barang/readData', [BarangController::class, 'readData'])->name('barang.readData');
    Route::get('/barang/showForm', [BarangController::class, 'showForm'])->name('barang.showForm');
    Route::get('/barang/showFormStock', [BarangController::class, 'showFormStock'])->name('barang.showFormStock');
    Route::post('/barang/addStock', [BarangController::class, 'addStock'])->name('barang.addStock');

    // Kasir

    Route::resource('pesan', PesanController::class)->except('create', 'show', 'edit');
    Route::get('/pesan/readData', [PesanController::class, 'readData'])->name('pesan.readData');

    Route::resource('keranjang-pesanan', KeranjangPesananController::class)->except('create', 'show', 'edit');
    Route::get('/keranjang-pesanan/readData', [KeranjangPesananController::class, 'readData'])->name('keranjang-pesanan.readData');
    Route::get('/keranjang-pesanan/showForm', [KeranjangPesananController::class, 'showForm'])->name('keranjang-pesanan.showForm');
    Route::post('/keranjang-pesanan/reset-keranjang', [KeranjangPesananController::class, 'resetKeranjang'])->name('keranjang-pesanan.reset-keranjang');
    Route::post('/keranjang-pesanan/pembayaran', [KeranjangPesananController::class, 'pembayaran'])->name('keranjang-pesanan.pembayaran');

    Route::get('/list-penjualan', [KeranjangPesananController::class, 'listPenjualan'])->name('list-penjualan.index');
    Route::get('/list-penjualan/readData', [KeranjangPesananController::class, 'readDataPenjualan'])->name('list-penjualan.readData');
    Route::get('/list-penjualan/detailTransaksi', [KeranjangPesananController::class, 'detailTransaksi'])->name('list-penjualan.detailTransaksi');
});

require __DIR__.'/auth.php';
