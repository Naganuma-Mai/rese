<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;

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

Route::middleware('verified')->group(function () {
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
