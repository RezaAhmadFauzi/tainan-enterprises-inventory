<?php

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
    
});
