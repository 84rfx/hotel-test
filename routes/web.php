<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('/reservation', [PageController::class, 'reservation'])->name('reservation');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/history', [PageController::class, 'history'])->name('history');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [PageController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/rooms', [PageController::class, 'adminRooms'])->name('admin.rooms');
    Route::get('/rooms/add', [PageController::class, 'adminAddRoom'])->name('admin.rooms.add');
    Route::get('/rooms/edit/{id}', [PageController::class, 'adminEditRoom'])->name('admin.rooms.edit');
    Route::get('/users', [PageController::class, 'adminUsers'])->name('admin.users');
    Route::get('/users/add', [PageController::class, 'adminAddUser'])->name('admin.users.add');
    Route::get('/users/edit/{id}', [PageController::class, 'adminEditUser'])->name('admin.users.edit');
    Route::get('/reservations', [PageController::class, 'adminReservations'])->name('admin.reservations');
    Route::get('/history', [PageController::class, 'adminHistory'])->name('admin.history');
});
