<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/products', [productController::class, 'index'])->name('products.index');
 Route::get('/products.create', [productController::class, 'create'])->name('products.create');
 Route::post('/products', [productController::class, 'store'])->name('products.store');
 Route::get('/products/{product}/edit', [productController::class, 'edit'])->name('products.edit');
 Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
 Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('products.delete');