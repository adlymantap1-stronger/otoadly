<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    $cars = \App\Models\Car::latest()->take(6)->get();
    return view('home', compact('cars'));
})->name('home');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Car routes
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Order routes
    Route::get('/cars/{car}/checkout', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/cars/{car}/checkout', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/checkout/success', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/notifications', [OrderController::class, 'notifications'])->name('orders.notifications');
    Route::post('/orders/{order}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
});

Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
Route::get('/simulasi-kredit', function () {
return view('simulasi-kredit'); })->name('simulasi-kredit');

require __DIR__.'/auth.php';