<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReseController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\VerifyQrCodeController;
use App\Http\Controllers\Auth\EmailVerificationController;


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/logout', [LoginController::class,'getLogout']);

    Route::get('/', [ReseController::class, 'shop_all']);


    Route::post('/done', [ReseController::class, 'done']);
    Route::get('/mypage', [ReseController::class, 'mypage'])->name('mypage');

    Route::get('/detail/{shop_id}', [ReseController::class, 'shop_detail'])->name('shop_detail');

    Route::post('/favorite/toggle/{shop_id}', [ReseController::class, 'toggleFavorite'])->name('favorite.toggle');

    Route::delete('/reservation/cancel/{id}', [ReseController::class, 'cancelReservation']);

    Route::get('/reservation/edit/{id}', [ReseController::class, 'editReservation'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [ReseController::class, 'updateReservation'])->name('reservation.update');

    // QRコードの生成ルート
    Route::get('/qr-code', [VerifyQrCodeController::class, 'generate'])->name('qr.code');
    // QRコード照合のルート
    Route::post('/verify-qr-code', [VerifyQrCodeController::class, 'verify'])->name('qr.verify');

    Route::get('/rating/{shop_id}', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/rating/{shop_id}', [RatingController::class, 'store'])->name('ratings.store');



});

Route::get('/login', [LoginController::class,'getLogin'])->name('login');
Route::post('/login', [LoginController::class,'postLogin']);
Route::get('/register', [RegisterController::class,'getRegister'])->name('register');
Route::post('/register', [RegisterController::class,'postRegister'])->name('register.post');
Route::get('/thanks', [RegisterController::class, 'thanks']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');