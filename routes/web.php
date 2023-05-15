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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('patients')
        ->controller(\App\Http\Controllers\PatientController::class)
        ->group(function () {
            Route::get('/', 'index')->name('patients.index');
            Route::get('/create', 'create')->name('patients.create');
            Route::get('/{patient}', 'show')->name('patients.show');
            Route::get('/{patient}/edit', 'index')->name('patients.edit');
            Route::delete('/{patient}', 'destroy')->name('patients.destroy');
        });
});
