<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->group(function() {
        Route::get('/participant/registration', [ParticipantController::class, 'registration'])->name('participant.index');
        Route::post('/participant/registration/store', [ParticipantController::class, 'store'])->name('participant.store');
        Route::get('/login', [AuthController::class, 'login'])->name('login.index');
        Route::post('/login/authentication', [AuthController::class, 'authenticate'])->name('authenticate');
    });

    Route::get('/participant/qr/{uuid}', [ParticipantController::class, 'showQr'])->name('participant.show');

Route::middleware('auth')
    ->group(function() {

        Route::middleware('role:superadmin')
            ->prefix('sa')
            ->name('superadmin.')
            ->group(function() {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
                Route::delete('/participant/registration/destroy/{uuid}', [ParticipantController::class, 'destroy'])->name('participant.destroy');
                Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
                Route::post('/account/store', [AuthController::class, 'accountStore'])->name('account.store');
                Route::put('/account/update/{uuid}', [AuthController::class, 'accountUpdate'])->name('account.update');
                Route::delete('/account/destroy/{uuid}', [AuthController::class, 'accountDestroy'])->name('account.destroy');
            });

        Route::middleware('role:admin')
            ->prefix('ad')
            ->name('admin.')
            ->group(function() {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
                Route::delete('/participant/registration/destroy', [ParticipantController::class, 'destroy'])->name('participant.destroy');
                Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
                Route::post('/account/store', [AuthController::class, 'accountStore'])->name('account.store');
                Route::put('/account/update/{uuid}', [AuthController::class, 'accountUpdate'])->name('account.update');
            });

        Route::middleware('role:user')
            ->prefix('us')
            ->name('user.')
            ->group(function() {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
            });
    });