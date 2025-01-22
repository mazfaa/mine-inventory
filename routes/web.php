<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StorageLocationController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('index');
});

Route::get('/fetch-categories', [CategoryController::class, 'fetch_categories'])->name('fetch-categories');
Route::resource('category', CategoryController::class);

Route::get('/fetch-suppliers', [SupplierController::class, 'fetch_suppliers'])->name('fetch-suppliers');
Route::resource('supplier', SupplierController::class);

Route::get('/fetch-storage-locations', [StorageLocationController::class, 'fetch_storage_locations'])->name('fetch-storage-locations');
Route::resource('storage-location', StorageLocationController::class);