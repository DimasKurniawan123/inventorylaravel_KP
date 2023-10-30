<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
//login
Route::get('/',[AuthController::class, 'index']);
Route::post('/cek_login',[AuthController::class, 'cek_login']);
Route::get('/home',[HomeController::class, 'index']);

//Data User
Route::get('/user',[UserController::class, 'index']);
Route::post('/user/store',[UserController::class, 'store']);
Route::post('/user/update/{id}',[UserController::class, 'update']);
Route::get('/user/destroy/{id}',[UserController::class, 'destroy']);