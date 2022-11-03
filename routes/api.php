<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ AuthController, OrderController, ProcuctController, IngredientController };

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout']);
Route::get('refresh', [AuthController::class, 'refresh']);
Route::post('register', [RegisterController::class, 'create'])->name('register');
Route::get('me', [AuthController::class, 'me']);


Route::group(['middleware' => 'auth:api', 'prefix' => 'orders'], function ($router) {
    Route::post('', [OrderController::class, 'store'])->name('order.add');
    Route::get('', [OrderController::class, 'index'])->name('order.list');
    // Route::apiResource('orders', OrderController::class);
});
Route::get('refill', [OrderController::class, 'refill'])->name('refill');