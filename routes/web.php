<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MerchController;
use App\Http\Controllers\ProdusenController;
use App\Http\Controllers\WarehouseController;

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

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [MerchController::class, 'index'])->name('merch.index');
});

Route::get('add', [MerchController::class, 'create'])->name('merch.create'); 
Route::post('store', [MerchController::class, 'store'])->name('merch.store');
Route::get('edit/{id}', [MerchController::class, 'edit'])->name('merch.edit'); 
Route::post('update/{id}', [MerchController::class,  'update'])->name('merch.update');
Route::post('delete/{id}', [MerchController::class,  'delete'])->name('merch.delete');
Route::post('softdelete/{id}', [MerchController::class,  'softDelete'])->name('merch.softDelete');
Route::get('restore', [MerchController::class,  'restore'])->name('merch.restore');

Route::get('produsen/add', [ProdusenController::class, 'create'])->name('produsen.create');
Route::post('produsen/store', [ProdusenController::class, 'store'])->name('produsen.store');
Route::get('produsen/edit/{id}', [ProdusenController::class, 'edit'])->name('produsen.edit');
Route::post('produsen/update/{id}', [ProdusenController::class, 'update'])->name('produsen.update');
Route::post('produsen/delete/{id}', [ProdusenController::class, 'delete'])->name('produsen.delete');

Route::get('warehouse/add', [WarehouseController::class, 'create'])->name('warehouse.create');
Route::post('warehouse/store', [WarehouseController::class, 'store'])->name('warehouse.store');
Route::get('warehouse/edit/{id}', [WarehouseController::class, 'edit'])->name('warehouse.edit');
Route::post('warehouse/update/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
Route::post('warehouse/delete/{id}', [WarehouseController::class, 'delete'])->name('warehouse.delete');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

