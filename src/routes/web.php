<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LikeController;

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

Route::middleware('auth')->group(function () {
    Route::get('/detail/:shop_id', [ShopController::class, 'getDetail']);
    Route::get('/mypage', [UserController::class, 'index']);
    Route::post('/like', [LikeController::class, 'like']);
    Route::post('/done', [ReservationController::class, 'store']);
    // Route::patch('/todos/update', [TodoController::class, 'update']);
    Route::delete('/delete', [ReservationController::class, 'destroy']);
});

Route::get('/', [ShopController::class, 'index']);
Route::get('/shops/search', [ShopController::class, 'search']);
