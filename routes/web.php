<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StorageLocationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/recent-activities', [DashboardController::class, 'fetch_recent_activities'])->name('dashboard.recent-activities');

Route::get('/fetch-categories', [CategoryController::class, 'fetch_categories'])->name('fetch-categories');
Route::resource('category', CategoryController::class);

Route::get('/fetch-suppliers', [SupplierController::class, 'fetch_suppliers'])->name('fetch-suppliers');
Route::resource('supplier', SupplierController::class);

Route::get('/fetch-storage-locations', [StorageLocationController::class, 'fetch_storage_locations'])->name('fetch-storage-locations');
Route::resource('storage-location', StorageLocationController::class);

Route::get('/fetch-items', [ItemController::class, 'fetch_items'])->name('fetch-items');
Route::resource('item', ItemController::class);
Route::post('item/upload-image', [ItemController::class, 'uploadImage'])->name('item.uploadImage');
Route::delete('item/delete-image', [ItemController::class, 'deleteImage'])->name('item.deleteImage');


Route::post('/items/bulk-delete', [ItemController::class, 'bulk_delete'])->name('bulk-delete-items');

Route::get('/fetch-transactions', [TransactionController::class, 'fetch_transactions'])->name('fetch-transactions');
Route::resource('transaction', TransactionController::class);

Route::get('/fetch-detail-transactions/{transaction}', [DetailTransactionController::class, 'fetch_detail_transactions'])->name('fetch-detail-transactions');
Route::resource('detail-transaction', DetailTransactionController::class);

Route::post('upload', function () {

});