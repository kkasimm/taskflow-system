<?php

use App\Http\Controllers\Admin\AdminTaskController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', fn () => view('admin.auth.login'))->name('admin.login.submit');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware(['web','auth', 'admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/tasks', [AdminTaskController::class, 'index']);
    Route::get('/tasks{task}', [AdminTaskController::class, 'show']);
});
