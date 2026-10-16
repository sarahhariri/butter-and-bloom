<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CakeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FlavourController;
use App\Http\Controllers\Admin\UnavailableDateController;
use App\Http\Controllers\CakeCollectionController;
use App\Http\Controllers\CakeOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/cakes', [CakeCollectionController::class, 'index'])
    ->name('cakes.index');
Route::get('/custom-order', [CakeOrderController::class, 'create'])
    ->name('orders.create');
Route::post('/custom-order', [CakeOrderController::class, 'store'])
    ->name('orders.store');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('login.store');

    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/orders/{order}', [DashboardController::class, 'show'])
            ->name('orders.show');
        Route::get('/orders/{order}/reference', [DashboardController::class, 'reference'])
            ->name('orders.reference');
        Route::patch('/orders/{order}', [DashboardController::class, 'update'])
            ->name('orders.update');

        Route::resource('cakes', CakeController::class)
            ->except('show');


        Route::get('/unavailable-dates', [UnavailableDateController::class, 'index'])
            ->name('unavailable-dates.index');

        Route::post('/unavailable-dates', [UnavailableDateController::class, 'store'])
            ->name('unavailable-dates.store');
        Route::delete('/unavailable-dates/{unavailableDate}', [UnavailableDateController::class, 'destroy'])
            ->name('unavailable-dates.destroy');

        Route::get('/flavours', [FlavourController::class, 'index'])
            ->name('flavours.index');

        Route::post('/flavours', [FlavourController::class, 'store'])
            ->name('flavours.store');
        Route::resource('faqs', FaqController::class)
            ->except('show');

        Route::get('/flavours/{flavour}/edit', [FlavourController::class, 'edit'])
            ->name('flavours.edit');

        Route::put('/flavours/{flavour}', [FlavourController::class, 'update'])
            ->name('flavours.update');
        Route::delete('/flavours/{flavour}', [FlavourController::class, 'destroy'])
            ->name('flavours.destroy');

        Route::post('/logout', [AuthController::class, 'destroy'])
            ->name('logout');
    });
});
