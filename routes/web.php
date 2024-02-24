<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');

// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');


/* Auto-generated admin routes */
Route::get('/m-foods-categories/list', [App\Http\Controllers\Admin\MFoodsCategoriesController::class,
'list'])->name('m-foods-categories-list');
Route::resource('/m-foods-categories', App\Http\Controllers\Admin\MFoodsCategoriesController::class);

/* Auto-generated admin routes */
Route::get('/m-event-categories/list', [App\Http\Controllers\Admin\MEventCategoriesController::class,
'list'])->name('m-event-categories-list');
Route::resource('/m-event-categories', App\Http\Controllers\Admin\MEventCategoriesController::class);