<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminMenuController;
use App\Models\Menu;
use Illuminate\Http\Request;

// Route untuk halaman depan sekarang lewat Controller
Route::get('/', [MenuController::class, 'index'])->name('home');
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/menus', [AdminMenuController::class, 'index'])->name('admin.menus');
    Route::get('/menus/create', [AdminMenuController::class, 'create'])->name('admin.create');
    Route::post('/menus/store', [AdminMenuController::class, 'store'])->name('admin.store');
    Route::get('/menus/{id}/edit', [AdminMenuController::class, 'edit'])->name('admin.edit');
    Route::put('/menus/{id}/update', [AdminMenuController::class, 'update'])->name('admin.update');
    Route::delete('/menus/{id}/delete', [AdminMenuController::class, 'destroy'])->name('admin.destroy');
});

Route::get('/login-rahasia', function () {
    session(['is_admin' => true]);
    return redirect('/admin/menus')->with('success', 'Halo Admin Arya! Selamat bekerja ☕');
});

Route::get('/logout', function () {
    session()->forget('is_admin');
    return redirect('/')->with('success', 'Berhasil logout!');
});