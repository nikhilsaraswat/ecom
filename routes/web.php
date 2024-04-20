<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginConrtoller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\loginpg;
use App\Http\Controllers\Admin\subCategoryController;

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
    Route::get('/category', [CategoryController::class, 'categorypage'])->name('admincategorypanel');
    Route::get('/category/create', [CategoryController::class, 'categorycreationpage'])->name('admincategorypanelcreation');
    Route::post('/category/create/post',[CategoryController::class,'categorycreate'])->name('admincategorypanelcreationpost');
    Route::post('/categorydelete/{id}', [CategoryController::class, 'categorydelete'])->name('adminpanelcategorydelete');
    Route::get('/{id}/categoryedit',[CategoryController::class,'categoryedit'])->name('adminpanelcategoryedit');
    Route::put('/categoryedit/{id}',[CategoryController::class,'categoryupdate'])->name('adminpanelcategoryupdate');
    Route::get('/product', [ProductController::class,'productpage'])->name('adminproductpanel');
    Route::get('/product/create',[ProductController::class,'productcreationpage'])->name('adminproductpanelcreation');
    Route::post('/product/create/post',[ProductController::class,'productcreate'])->name('adminproductpanelcreationpost');
    Route::post('/productdelete/{id}',[ProductController::class,'productdelete'])->name('adminpanelproductdelete');
    Route::get('/{id}/productedit',[ProductController::class,'productedit'])->name('adminpanelproductedit');
    Route::put('/productedit/{id}',[ProductController::class,'productupdate'])->name('adminpanelproductupdate');
    Route::get('/subcategory/create', [CategoryController::class, 'categorycreationpage'])->name('adminsubcategorypanelcreation');
    Route::get('/subcategory', [subCategoryController::class, 'subcategorypage'])->name('adminsubcategorypanel');
    Route::get('/subcategory/create',[subCategoryController::class,'subcategorycreationpage'])->name('adminsubcategorypanelcreation');
    Route::post('/subcategory/create/post/{id}',[subCategoryController::class,'subcategorycreate'])->name('adminsubcategorypanelcreationpost');
    Route::post('/subcategorydelete/{id}', [subCategoryController::class, 'subcategorydelete'])->name('adminpanelsubcategorydelete');
    Route::get('/{id}/subcategoryedit',[subCategoryController::class,'subcategoryedit'])->name('adminpanelsubcategoryedit');
    Route::put('/subcategoryedit/{id}',[subCategoryController::class,'subcategoryupdate'])->name('adminpanelsubcategoryupdate');

  });
// to showcase custome user i am using this new route
Route::post('/adduser',[RegistrationController::class,'create'])->name('adduser');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [loginpg::class, 'login'])->name('loginpage');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
