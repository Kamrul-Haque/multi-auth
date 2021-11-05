<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware('auth', 'permit:user,admin,super-admin')->name('dashboard');

Route::get('/admin', function () {
    return Inertia::render('AdminDashboard');
})->middleware('auth', 'permit:admin,super-admin')->name('admin.dashboard');

Route::get('/super-admin', function () {
    return Inertia::render('SuperAdminDashboard');
})->middleware('auth', 'permit:super-admin')->name('super-admin.dashboard');
