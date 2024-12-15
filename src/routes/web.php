<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReseController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\VerifyQrCodeController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Admin\StoreRepresentativeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreRepresentative\ShopManagementController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\PaymentController;



// 管理者専用ページ
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.admin_dashboard');

    // 店舗代表者登録フォームのルート
    Route::get('/admin/store-representatives/create', [StoreRepresentativeController::class, 'create'])->name('admin.store-representatives.create');

    // 店舗代表者を保存するルート
    Route::post('/admin/store-representatives', [StoreRepresentativeController::class, 'store'])->name('admin.store-representatives.store');

    Route::get('/admin/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');

    Route::post('/admin/notifications', [AdminNotificationController::class, 'store'])->name('admin.notifications.store');

});


Route::middleware(['auth', 'role:store-representative'])->group(function () {
    Route::get('/store/dashboard', [ShopManagementController::class, 'dashboard'])
        ->name('store.dashboard'); // ダッシュボード表示

    Route::get('/store/shops/create', [ShopManagementController::class, 'create'])
        ->name('store.shops.create'); // 店舗作成フォーム表示

    Route::post('/store/shops', [ShopManagementController::class, 'store'])
        ->name('store.shops.store'); // 店舗作成処理

    Route::get('/store/shops/{shop}/edit', [ShopManagementController::class, 'edit'])->name('store.shops.edit');

    Route::put('/store/shops/{shop}', [ShopManagementController::class, 'update'])->name('store.shops.update');

    Route::get('/store/shops/{shop}/reservations', [ShopManagementController::class, 'reservations'])->name('store.reservations.index');
});

Route::get('/', [ReseController::class, 'shop_all']);
Route::get('/detail/{shop_id}', [ReseController::class, 'shop_detail'])->name('shop_detail');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/logout', [LoginController::class,'getLogout']);

    Route::post('/done', [ReseController::class, 'done']);
    Route::get('/mypage', [ReseController::class, 'mypage'])->name('mypage');


    Route::post('/favorite/toggle/{shop_id}', [ReseController::class, 'toggleFavorite'])->name('favorite.toggle');

    Route::delete('/reservation/cancel/{id}', [ReseController::class, 'cancelReservation']);

    Route::get('/reservation/edit/{id}', [ReseController::class, 'editReservation'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [ReseController::class, 'updateReservation'])->name('reservation.update');

    // QRコードの生成ルート
    Route::get('/qr-code/{reservation_id}', [VerifyQrCodeController::class, 'generate'])->name('qr.generate');
    Route::post('/verify-qr-code', [VerifyQrCodeController::class, 'verify'])->name('qr.verify');

    // QRコード照合のルート
    Route::post('/verify-qr-code', [VerifyQrCodeController::class, 'verify'])->name('qr.verify');

    Route::get('/rating/{shop_id}', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/rating/{shop_id}', [RatingController::class, 'store'])->name('ratings.store');

    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');


});

Route::get('/login', [LoginController::class,'getLogin'])->name('login');
Route::post('/login', [LoginController::class,'postLogin']);
Route::get('/register', [RegisterController::class,'getRegister'])->name('register');
Route::post('/register', [RegisterController::class,'postRegister'])->name('register.post');
Route::get('/thanks', [RegisterController::class, 'thanks'])->name('thanks');


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