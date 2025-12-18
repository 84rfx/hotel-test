<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodOrderController; // Import FoodOrderController
use App\Http\Controllers\PersonalDataController;


/*
|--------------------------------------------------------------------------
| Public & Guest Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/rooms', 'rooms')->name('rooms');
    Route::get('/amenities', 'amenities')->name('amenities');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/food', 'food')->name('food');
    Route::get('/booking', 'booking')->name('booking');
    Route::get('/reservations', 'reservations')->name('reservations'); // Pindahkan ke Authenticated jika hanya untuk user sendiri
    Route::get('/reservations/{reservation}', 'showReservation')->name('reservation.show');
    
    // Rute Booking ini seharusnya POST
    Route::post('/booking', 'store')->name('booking.store');
});

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Non-Admin)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Food Order routes
    Route::controller(FoodOrderController::class)->prefix('food-order')->name('food-orders.')->group(function () {
        Route::get('/', 'index')->name('index'); // food-orders.index
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{foodOrder}', 'show')->name('show');
    });

    // Profile routes for all authenticated users
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');

    // User Management (Menggunakan konvensi penamaan resource)
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', 'users')->name('index'); // admin.users.index
        Route::get('/create', 'createUser')->name('create');
        Route::post('/', 'storeUser')->name('store');
        Route::get('/{user}/edit', 'editUser')->name('edit');
        Route::put('/{user}', 'updateUser')->name('update');
        Route::delete('/{user}', 'deleteUser')->name('destroy');
        Route::patch('/{user}/role', 'updateUserRole')->name('update-role');
    });

    // Room Management (Menggunakan konvensi penamaan resource)
    Route::prefix('rooms')->name('rooms.')->group(function () {
        Route::get('/', 'rooms')->name('index'); // admin.rooms.index
        Route::get('/create', 'createRoom')->name('create');
        Route::post('/', 'storeRoom')->name('store');
        Route::get('/{room}/edit', 'editRoom')->name('edit');
        Route::put('/{room}', 'updateRoom')->name('update');
        Route::delete('/{room}', 'deleteRoom')->name('destroy');
    });

    // Message Management
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', 'messages')->name('index'); // admin.messages.index
        Route::get('/{message}', 'showMessage')->name('show');
        Route::delete('/{message}', 'deleteMessage')->name('destroy');
        Route::patch('/{message}/read', 'markMessageRead')->name('mark-read');
        Route::patch('/mark-all-read', 'markAllMessagesRead')->name('mark-all-read');
    });

    // Food Order Management (Menggunakan konvensi penamaan resource)
    Route::prefix('food-orders')->name('food-orders.')->group(function () {
        Route::get('/', 'foodOrders')->name('index'); // admin.food-orders.index
        Route::get('/{foodOrder}', 'showFoodOrder')->name('show');
        Route::get('/{foodOrder}/edit', 'editFoodOrder')->name('edit');
        Route::put('/{foodOrder}', 'updateFoodOrder')->name('update');
        Route::delete('/{foodOrder}', 'deleteFoodOrder')->name('destroy');
        Route::patch('/{foodOrder}/status', 'updateFoodOrderStatus')->name('update-status');
    });



    // Reservation Management (Menggunakan konvensi penamaan resource)
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', 'reservations')->name('index'); // admin.reservations.index
        Route::get('/{reservation}', 'showReservation')->name('show');
        Route::patch('/{reservation}/status', 'updateReservationStatus')->name('update-status');
    });

    // Revenue Management
    Route::prefix('revenue')->name('revenue.')->group(function () {
        Route::get('/', 'revenue')->name('index'); // admin.revenue.index
        Route::get('/export', 'exportRevenue')->name('export');
        Route::get('/rooms', 'roomRevenue')->name('rooms');
        Route::get('/food', 'foodRevenue')->name('food');
    });

    // Personal Data Management
    Route::prefix('personal-data')->name('personal-data.')->group(function () {
        Route::get('/{personalData}/view', [PersonalDataController::class, 'viewDocument'])->name('view');
    });
});
