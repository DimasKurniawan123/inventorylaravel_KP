<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProsesBarangController;
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
Route::get('/logout',[AuthController::class, 'logout']);
Route::get('/home',[HomeController::class, 'index']);
Route::get('/dashboard',[HomeController::class, 'dashboard']);

//Data User
Route::get('/user',[UserController::class, 'index']);
Route::post('/user/store',[UserController::class, 'store']);
Route::post('/user/update/{id}',[UserController::class, 'update']);
Route::get('/user/destroy/{id}',[UserController::class, 'destroy']);

//Data Barang
Route::post('/barang-simpan',[HomeController::class, 'store'])->name('barang-simpan');
Route::get('/barang/destroy/{id}',[HomeController::class, 'destroy']);
Route::post('/barang/update/{id}',[HomeController::class, 'update']);

//Data Kategori
Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori-list');
Route::post('/kategori/store',[KategoriController::class, 'store'])->name('kategori-store');
Route::post('/kategori/destroy/{id}',[KategoriController::class, 'destroy'])->name('kategori-destroy');


//Data Proses Barang
Route::get('/barang-masuk',[ProsesBarangController::class, 'masuk'])->name('barang-masuk');
Route::post('/barang-masuk/store',[ProsesBarangController::class, 'masuk_store'])->name('barang-masuk-store');
Route::post('/barang-masuk/destroy/{id}',[ProsesBarangController::class, 'masuk_destroy'])->name('barang-masuk-destroy');


Route::get('/barang-keluar',[ProsesBarangController::class, 'keluar'])->name('barang-keluar');
Route::post('/barang-keluar/store',[ProsesBarangController::class, 'keluar_store'])->name('barang-keluar-store');
Route::post('/barang-keluar/destroy/{id}',[ProsesBarangController::class, 'keluar_destroy'])->name('barang-keluar-destroy');