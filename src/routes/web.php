<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;

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

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'index']);
    Route::post('/like', [LikeController::class, 'store']);
    Route::post('/unlike', [LikeController::class, 'destroy']);
    Route::post('/done', [ReservationController::class, 'store']);
    // Route::patch('/todos/update', [TodoController::class, 'update']);
    Route::post('/delete', [ReservationController::class, 'destroy']);
});
