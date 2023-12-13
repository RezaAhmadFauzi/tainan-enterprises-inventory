<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
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
    
});
