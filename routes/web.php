<?php

use App\Http\Controllers\AtributController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/', 'DashboardController@view')->name('home');
    Route::get('/', [DashboardController::class, 'view'])->name('home');

    Route::prefix('brand')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index-brand');
        Route::get('/create', [BrandController::class, 'create'])->name('create-brand');
        Route::post('/store', [BrandController::class, 'store'])->name('store-brand');
        Route::get('/edit/{idBrand}', [BrandController::class, 'edit'])->name('edit-brand');
        Route::put('/update/{idBrand}', [BrandController::class, 'update'])->name('update-brand');
        Route::delete('/delete/{idBrand}', [BrandController::class, 'delete'])->name('delete-brand');
    });

    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index-kategori');
        Route::get('/create', [KategoriController::class, 'create'])->name('create-kategori');
        Route::post('/store', [KategoriController::class, 'store'])->name('store-kategori');
        Route::get('/edit/{idKategori}', [KategoriController::class, 'edit'])->name('edit-kategori');
        Route::put('/update/{idKategori}', [KategoriController::class, 'update'])->name('update-kategori');
        Route::delete('/delete/{idKategori}', [KategoriController::class, 'delete'])->name('delete-kategori');
    });

    Route::prefix('supplier')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index-supplier');
        Route::get('/create', [SupplierController::class, 'create'])->name('create-supplier');
        Route::post('/store', [SupplierController::class, 'store'])->name('store-supplier');
        Route::get('/edit/{idSupplier}', [SupplierController::class, 'edit'])->name('edit-supplier');
        Route::put('/update/{idSupplier}', [SupplierController::class, 'update'])->name('update-supplier');
        Route::delete('/delete/{idSupplier}', [SupplierController::class, 'delete'])->name('delete-supplier');
    });

    Route::prefix('atribut')->group(function () {
        Route::get('/', [AtributController::class, 'index'])->name('index-atribut');
        Route::get('/create', [AtributController::class, 'create'])->name('create-atribut');
        Route::post('/store', [AtributController::class, 'store'])->name('store-atribut');
        Route::get('/edit/{idAtribut}', [AtributController::class, 'edit'])->name('edit-atribut');
        Route::put('/update/{idAtribut}', [AtributController::class, 'update'])->name('update-atribut');
        Route::delete('/delete/{idAtribut}', [AtributController::class, 'delete'])->name('delete-atribut');
    });

    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('index-barang');
        Route::get('/create', [BarangController::class, 'create'])->name('create-barang');
        Route::post('/store', [BarangController::class, 'store'])->name('store-barang');
        Route::get('/edit/{idBarang}', [BarangController::class, 'edit'])->name('edit-barang');
        Route::put('/update/{idBarang}', [BarangController::class, 'update'])->name('update-barang');
        Route::delete('/delete/{idBarang}', [BarangController::class, 'delete'])->name('delete-barang');
    });
    
});
