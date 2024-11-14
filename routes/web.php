<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarungController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\WhatsappController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});


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

Route::get('/menu/create/{warung_id}', [MenuController::class, 'create'])->name('menu.create');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');

Route::get('/warung/{warung_id}/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');

Route::post('/whatsapp/send', [WhatsAppController::class, 'send'])->name('whatsapp.send');


