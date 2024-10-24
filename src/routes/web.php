<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReseController;


Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class,'getLogout']);

    Route::get('/', [ReseController::class, 'shop_all']);

    Route::post('/done', [ReseController::class, 'done']);
    Route::get('/mypage', [ReseController::class, 'mypage'])->name('mypage');

    Route::get('/detail/{shop_id}', [ReseController::class, 'shop_detail'])->name('shop_detail');

    Route::post('/favorite/toggle/{shop_id}', [ReseController::class, 'toggleFavorite'])->name('favorite.toggle');

    Route::delete('/reservation/cancel/{id}', [ReseController::class, 'cancelReservation']);

    Route::get('/reservation/edit/{id}', [ReseController::class, 'editReservation'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [ReseController::class, 'updateReservation'])->name('reservation.update');


});

Route::get('/login', [LoginController::class,'getLogin'])->name('login');
Route::post('/login', [LoginController::class,'postLogin']);
Route::get('/register', [RegisterController::class,'getRegister'])->name('register');
Route::post('/register', [RegisterController::class,'postRegister'])->name('register.post');
Route::get('/thanks', [RegisterController::class, 'thanks']);
