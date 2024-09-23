<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\Auth\RepresentativeLoginController;
use App\Http\Controllers\Auth\RepresentativeRegisterController;

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

Route::get('/', [ShopController::class, 'index']);
Route::get('/shops/search', [ShopController::class, 'search']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/thanks', [RegisterController::class, 'thanks']);
    Route::get('/mypage', [UserController::class, 'index']);
    Route::post('/like', [LikeController::class, 'store']);
    Route::post('/unlike', [LikeController::class, 'destroy']);
    Route::post('/done', [ReservationController::class, 'store']);
    Route::get('/edit', [ReservationController::class, 'edit']);
    Route::post('/edit', [ReservationController::class, 'update']);
    Route::post('/delete', [ReservationController::class, 'destroy']);
    Route::get('/qrcode', [ReservationController::class, 'showQrCode']);
    Route::get('/review', [ReviewController::class, 'index']);
    Route::post('/review', [ReviewController::class, 'store']);
    Route::post('/pay', [PaymentController::class, 'pay']);
});

Route::prefix('admin')->group(function () {
    Route::get('/register', [AdminRegisterController::class, 'create'])->name('admin.register');
    Route::post('/register', [AdminRegisterController::class, 'store']);

    Route::get('/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'store']);

    Route::post('/logout', [AdminLoginController::class, 'destroy']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/representative/register', [RepresentativeRegisterController::class, 'create'])->name('admin.representative.register');
        Route::post('/representative/register', [RepresentativeRegisterController::class, 'store']);

        Route::get('/representative/done', [RepresentativeRegisterController::class, 'showDone']);
    });
});

Route::prefix('representative')->group(function () {
    Route::get('/login', [RepresentativeLoginController::class, 'create'])->name('representative.login');
    Route::post('/login', [RepresentativeLoginController::class, 'store']);

    Route::post('/logout', [RepresentativeLoginController::class, 'destroy']);

    Route::middleware('auth:representative')->group(function () {
        Route::get('/admin', [RepresentativeController::class, 'index']);
        Route::get('/shops/create', [ShopController::class, 'add']);
        Route::post('/shops/create', [ShopController::class, 'store']);
        Route::get('/shops/update', [ShopController::class, 'edit']);
        Route::post('/shops/update', [ShopController::class, 'update']);
        Route::get('/reservation', [ReservationController::class, 'search']);
    });
});
