<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login_register_controller as controller_login_register;
use App\Http\Controllers\dashboard_controller;
use App\Http\Controllers\exit_account;
use \App\Http\Controllers\login_controller;
use App\Http\Middleware\access_page;
use App\Http\Middleware\admin_access;

Route::middleware([access_page::class])->group(function () {
    Route::get('/', [controller_login_register::class, 'index'])->name('index');
    Route::get('/register', [controller_login_register::class, 'register'])->name('register');
    Route::post('/login_register', [controller_login_register::class, 'login_register'])->name('login_register');
    Route::post('/save_data_user', [controller_login_register::class, 'save_data_user'])->name('save_data_user');
});

Route::middleware([admin_access::class])->group(function () {
Route::post('image_upload', [ dashboard_controller::class, 'image_upload' ])->name('image_upload');
});

Route::post('/login', [login_controller::class,'login'])->name('login');

Route::get('/dashboard', [dashboard_controller::class, 'dashboard'])->name('dashboard');
Route::get('/code', [login_controller::class, 'code'])->name('code');
Route::get('/logout', [exit_account::class, 'logout'])->name('logout');


