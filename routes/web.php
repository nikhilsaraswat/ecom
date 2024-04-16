<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginConrtoller;


Route::get('/', function () {
    return view('welcome');
})->name('base');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', [App\Http\Controllers\RegistrationController::class, 'register'])->name('register');
Route::get('/admin', [App\Http\Controllers\AdminPanelController::class, 'login'])->name('adminpanel');
// to showcase custome user i am using this new route
Route::post('/adduser',[App\Http\Controllers\RegistrationController::class,'create'])->name('adduser');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/login', [App\Http\Controllers\loginpg::class, 'login'])->name('loginpage');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
