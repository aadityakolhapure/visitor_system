<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/visitor', [VisitorController::class, 'create'])->name('visitor.create');
Route::post('/visitor', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/visitor/preview/{id}', [VisitorController::class, 'preview'])->name('visitor.preview');
Route::get('/visitor/download/{id}', [VisitorController::class, 'downloadPdf'])->name('visitor.download');
Route::get('/visitor/checkout', [VisitorController::class, 'checkoutForm'])->name('visitor.checkout.form');
Route::post('/visitor/checkout', [VisitorController::class, 'checkout'])->name('visitor.checkout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
