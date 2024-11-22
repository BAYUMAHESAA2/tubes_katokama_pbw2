<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarungController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\WhatsappController;

Route::get('/foodexplore', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/warung', [WarungController::class, 'index'])->name('warung.index');
    Route::get('/warung/search', [WarungController::class, 'search'])->name('warung.search');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/warung', [WarungController::class, 'index'])->name('warung.index');
    Route::get('/warung/search', [WarungController::class, 'search'])->name('warung.search');
});



require __DIR__.'/auth.php';

Route::get('/warung', [WarungController::class, 'index'])->name('warung.index');
Route::get('/warung/add', function () {
    return view('warung.addwarung');
})->name('warung.add');

Route::post('/warung', [WarungController::class, 'store'])->name('warung.store');
Route::get('/warung/search', [WarungController::class, 'search'])->name('warung.search');

// routes/web.php
Route::get('/warung/{id}/menu', [WarungController::class, 'showMenu'])->name('warung.menu');
Route::get('/warung/{id}/menu/add', [WarungController::class, 'addMenu'])->name('warung.menu.add');
Route::post('/warung/{id}/menu', [WarungController::class, 'storeMenu'])->name('warung.menu.store');
Route::get('warung/{warung_id}/menu', [MenuController::class, 'index'])->name('warung.menu.index');

Route::get('/menu/create/{warung_id}', [MenuController::class, 'create'])->name('menu.create');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');

Route::get('/warung/{warung_id}/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');

Route::post('/whatsapp/send', [WhatsAppController::class, 'send'])->name('whatsapp.send');

Route::get('/warung/{warung_id}/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');


Route::post('/warung/{warung_id}/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::post('/warung/{warung_id}/ulasan', [UlasanController::class, 'store'])
    ->middleware('auth')
    ->name('ulasan.store');

Route::get('/ulasan/{warung_id}', [UlasanController::class, 'lihatUlasan'])->name('ulasan.lihatUlasan');









