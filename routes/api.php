<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$controller_path = 'App\Http\Controllers';

//User Registration and Login
Route::post('register',[App\Http\Controllers\UserAuthController::class,'register']);
Route::post('login',[App\Http\Controllers\UserAuthController::class,'login']);
Route::post('logout',[App\Http\Controllers\UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');

//Sample
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Ticketing APIs
//category
Route::get('/events/category/list', [App\Http\Controllers\Admin\MEventCategoriesController::class,
'activeList']);
//Events
Route::get('/events/list', [App\Http\Controllers\Admin\EventsController::class,
'activeList'])->name('events-list'); //Events list
Route::get('/events/admin/list', [App\Http\Controllers\Admin\EventsController::class,
'adminList'])->name('events-admin-list')->middleware('auth:sanctum'); //Admin Events list
Route::post('/event/create', [App\Http\Controllers\Admin\EventsController::class,
'store'])->name('event-create')->middleware('auth:sanctum'); //Create event
Route::post('/event/{id}', [App\Http\Controllers\Admin\EventsController::class,
'show'])->name('event-details'); //Get event details
Route::post('/event/{id}/delete', [App\Http\Controllers\Admin\EventsController::class,
'destroy'])->name('event-destroy')->middleware('auth:sanctum'); //destroy event
Route::post('/event/{id}/edit', [App\Http\Controllers\Admin\EventsController::class,
'store'])->name('event-update')->middleware('auth:sanctum'); //update event
Route::post('/event/booking/create', [App\Http\Controllers\Admin\EventsOrdersController::class,
'store'])->name('event-booking-add')->middleware('auth:sanctum'); //add event booking