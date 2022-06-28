<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\PhotoAlbumController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SejarahMasjidController;
use App\Http\Controllers\StrukturDKMController;
use App\Http\Controllers\TransAcaraController;
use App\Http\Controllers\TransInventarisController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [LoginController::class, 'index'])->name('login.index');

Route::resource('jamaah', JamaahController::class);
Route::resource('sejarah-masjid', SejarahMasjidController::class);
Route::resource('struktur-dkm', StrukturDKMController::class);
Route::resource('users', UsersController::class);
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::resource('role', RoleController::class);
Route::resource('album', AlbumController::class);
Route::resource('photo-album', PhotoAlbumController::class);
Route::resource('notulen', NotulenController::class);
Route::resource('acara', AcaraController::class);
Route::resource('trans-acara', TransAcaraController::class);
Route::resource('inventaris', InventarisController::class);
Route::resource('trans-inv', TransInventarisController::class);