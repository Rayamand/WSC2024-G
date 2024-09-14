<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{category}/restaurant', [CategoryController::class, 'restaurant']);
Route::get('/category/{category}/restaurant', [RestaurantController::class, 'index']);