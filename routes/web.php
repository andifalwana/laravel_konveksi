<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products/report', [ProductController::class, 'generateReport'])->name('products.report');
    Route::resource('products', ProductController::class);
    Route::get('/dashboard', [ImageController::class, 'index'])->name('dashboard');
    Route::get('/image/{filename}', [ImageController::class, 'show'])->name('image.detail');
});

require __DIR__.'/auth.php';
