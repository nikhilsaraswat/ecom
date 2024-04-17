<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginConrtoller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\loginpg;

Route::get('/', function () {
    return view('welcome');
})->name('base');

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegistrationController::class, 'register'])->name('register');

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\checkadmin'], function () {
    Route::get('/', [AdminPanelController::class, 'login'])->name('adminpanel');
    Route::post('/userdelete/{id}', [AdminPanelController::class, 'userdelete'])->name('adminpaneluserdelete');
    Route::get('/{id}/useredit',[AdminPanelController::class,'useredit'])->name('adminpaneluseredit');
    Route::put('/useredit/{id}',[AdminPanelController::class,'userupdate'])->name('adminpaneluserupdate');
  });
// to showcase custome user i am using this new route
Route::post('/adduser',[RegistrationController::class,'create'])->name('adduser');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [loginpg::class, 'login'])->name('loginpage');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
