<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OutdoorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;


Route::post('/place-order', [OutdoorController::class, 'placeOrder'])->name('outdoor.placeOrder');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/sewa', [OutdoorController::class, 'index'])->middleware(['auth'])->name('sewa');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth',RoleMiddleware::class.':admin'])->group(function () {
    Route::post('/create/store', [AdminController::class, 'store'])->name('items.store');
    Route::get('/create', [AdminController::class, 'create'])->name('admin_create');
    Route::get('/admin/outdoor-items', [AdminController::class, 'showOutdoorItems'])->name('admin.outdoor-items');
    
    Route::get('/admin/outdoor-items/{item}/edit', [AdminController::class, 'editOutdoorItem'])->name('admin.outdoor-items.edit');
    Route::put('/admin/outdoor-items/{item}', [AdminController::class, 'updateOutdoorItem'])->name('admin.outdoor-items.update');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroyOutdoorItem'])->name('admin.outdoor-items.destroy');
    
    Route::post('/admin/outdoor-items', [AdminController::class, 'storeOrder'])->name('admin.outdoor-items.store');

    Route::get('/admin/sewa', [AdminController::class, 'showSewa'])->name('admin.sewa')->middleware('auth');
});

Route::get('/history', [OutdoorController::class, 'history'])->middleware('auth')->name('history');

Route::patch('/update-status/{id}', [OrderController::class, 'updateStatus'])->name('update.status');


require __DIR__.'/auth.php';
