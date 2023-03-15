<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard/pdf/', [App\Http\Controllers\DashboardController::class, 'pdf'])->name('dashboard.pdf');
Route::get('/dashboard/pdf2/', [App\Http\Controllers\DashboardController::class, 'pdf2'])->name('dashboard.pdf2');


Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
Route::resource('solicitudes', App\Http\Controllers\SolicitudeController::class);
Route::resource('clientes', App\Http\Controllers\ClienteController::class);

