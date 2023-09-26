<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TampungBayarController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\DetailPembelianController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('detail-penjualans', DetailPenjualanController::class);
        Route::resource('barangs', BarangController::class);
        Route::resource('detail-transaksis', DetailTransaksiController::class);
        Route::resource('jenis-pembayarans', JenisPembayaranController::class);
        Route::resource('pelanggans', PelangganController::class);
        Route::resource('pemasoks', PemasokController::class);
        // Route::resource('pembelians', PembelianController::class);
        Route::resource('penjualans', PenjualanController::class);
        Route::resource('produks', ProdukController::class);
        Route::resource('rombels', RombelController::class);
        Route::resource('transaksis', TransaksiController::class);
        Route::resource('users', UserController::class);
        Route::resource('tampung-bayars', TampungBayarController::class);
        Route::resource('detail-pembelians', DetailPembelianController::class);

        Route::get('pembelians', [PembelianController::class, 'index'])->name('pembelians.index');
        Route::post('make-pembelian', [PembelianController::class, 'store']);
        Route::get('data-pembelian', [PembelianController::class, 'show'])->name('pembelians.show');

        Route::get('produk-export', [ProdukController::class, 'export'])->name('produks.export');
        Route::get('pembelian-export', [PembelianController::class, 'export'])->name('pembelians.export');
        Route::post('produk-import', [ProdukController::class, 'import'])->name('produk.import');
    });
    Route::get('pembelian/faktur/{id}', [PembelianController::class, 'faktur']);

