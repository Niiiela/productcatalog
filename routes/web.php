<?php
use App\Http\Controllers\ProductRoutController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/products');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductRoutController::class, 'index'])->name('index');
    Route::get('/create', [ProductRoutController::class, 'create'])->name('create');
    Route::post('/', [ProductRoutController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductRoutController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductRoutController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductRoutController::class, 'destroy'])->name('destroy');
});
