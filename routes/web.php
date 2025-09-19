<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\SlotController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->group(function() {
        Route::get('/participant/registration', [ParticipantController::class, 'registration'])->name('participant.index');
        Route::post('/participant/registration/store', [ParticipantController::class, 'store'])->name('participant.store');
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login/authentication', [AuthController::class, 'authenticate'])->middleware('throttle:login')->name('authenticate');
        Route::get('participant/regenerate-qr', [ParticipantController::class, 'regenerateIndex'])->name('generate.index');
        Route::post('participant/generating-qr', [ParticipantController::class, 'regenerateQr'])->name('generate.qr');
    });

    Route::get('/', function () {
        if (!Auth::check()) {
            return view('welcome');
        }

        $role = Auth::user()->getRoleNames()->first();

        return match ($role) {
            'superadmin' => redirect()->route('superadmin.dashboard.index'),
            'admin'      => redirect()->route('admin.dashboard.index'),
            'user'       => redirect()->route('user.dashboard.index'),
            default      => abort(403, 'Unauthorized'),
        };
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
            Route::get('/account', [AuthController::class, 'accountIndex'])->name('account.index');
            Route::get('/account/store', [AuthController::class, 'accountStore'])->name('account.store');
            Route::get('/account/update/{uuid}', [AuthController::class, 'accountUpdate'])->name('account.update');
            Route::get('/account/destroy/{uuid}', [AuthController::class, 'accountDestroy'])->name('account.destroy');
            Route::get('/participants/count', [DashboardController::class, 'count'])->name('owner.count');
            Route::get('/participants/attendance/qr-scanning', [AttendanceController::class, 'index'])->name('attendance.index');
            Route::post('/participants/attendance/qr-scanning/store', [AttendanceController::class, 'scanQr'])->name('attendance.store');
            Route::resource('slot', SlotController::class);
        });

        Route::middleware('role:admin')
            ->prefix('ad')
            ->name('admin.')
            ->group(function() {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
            Route::delete('/participant/registration/destroy/{uuid}', [ParticipantController::class, 'destroy'])->name('participant.destroy');
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
            Route::post('/account/store', [AuthController::class, 'accountStore'])->name('account.store');
            Route::put('/account/update/{uuid}', [AuthController::class, 'accountUpdate'])->name('account.update');
            Route::delete('/account/destroy/{uuid}', [AuthController::class, 'accountDestroy'])->name('account.destroy');
            Route::get('/account', [AuthController::class, 'accountIndex'])->name('account.index');
            Route::get('/account/store', [AuthController::class, 'accountStore'])->name('account.store');
            Route::get('/account/update/{uuid}', [AuthController::class, 'accountUpdate'])->name('account.update');
            Route::get('/account/destroy/{uuid}', [AuthController::class, 'accountDestroy'])->name('account.destroy');
            Route::get('/participants/count', [DashboardController::class, 'count'])->name('owner.count');
            Route::get('/participants/attendance/qr-scanning', [AttendanceController::class, 'index'])->name('attendance.index');
            Route::post('/participants/attendance/qr-scanning/store', [AttendanceController::class, 'scanQr'])->name('attendance.store');
            Route::resource('slot', SlotController::class);
        });

        Route::middleware('role:user')
            ->prefix('us')
            ->name('user.')
            ->group(function() {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
            Route::delete('/participant/registration/destroy/{uuid}', [ParticipantController::class, 'destroy'])->name('participant.destroy');
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
            Route::post('/account/store', [AuthController::class, 'accountStore'])->name('account.store');
            Route::put('/account/update/{uuid}', [AuthController::class, 'accountUpdate'])->name('account.update');
            Route::delete('/account/destroy/{uuid}', [AuthController::class, 'accountDestroy'])->name('account.destroy');
            Route::get('/account', [AuthController::class, 'accountIndex'])->name('account.index');
            Route::get('/account/store', [AuthController::class, 'accountStore'])->name('account.store');
            Route::get('/account/update/{uuid}', [AuthController::class, 'accountUpdate'])->name('account.update');
            Route::get('/account/destroy/{uuid}', [AuthController::class, 'accountDestroy'])->name('account.destroy');
            Route::get('/participants/count', [DashboardController::class, 'count'])->name('owner.count');
            Route::get('/participants/attendance/qr-scanning', [AttendanceController::class, 'index'])->name('attendance.index');
            Route::post('/participants/attendance/qr-scanning/store', [AttendanceController::class, 'scanQr'])->name('attendance.store');
            Route::resource('slot', SlotController::class);
        });
    });