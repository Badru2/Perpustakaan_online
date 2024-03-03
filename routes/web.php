<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/tambahBuku', [BukuController::class, 'create'])->name('create.buku');
    Route::post('/storeBuku', [BukuController::class, 'store'])->name('store.buku');
    Route::get('show/{id}', [BukuController::class, 'show'])->name('show.buku');
    Route::get('edit/{id}', [BukuController::class, 'edit'])->name('edit.buku');
    Route::put('update/{id}', [BukuController::class, 'update'])->name('update.buku');
    Route::post('/tambahKategori', [BukuController::class, 'categoryStore'])->name('store.kategori');

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
