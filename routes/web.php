<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/registration', function() {
    return view('auth.register');
});

Route::get('/login', function() {
    return view('auth.login');
});