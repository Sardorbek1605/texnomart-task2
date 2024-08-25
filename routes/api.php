<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FakeApiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('send-sms-code',[LoginController::class, 'sendSMS']);
    Route::post('login-or-register',[LoginController::class, 'loginOrRegister']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::get('me', [LoginController::class, 'me']);
});

Route::group(['prefix' => 'users', 'middleware' => ['jwtauth']], function (){
   Route::get('/', [UserController::class, 'index']);
   Route::get('/show/{id}', [UserController::class, 'show']);
   Route::delete('/delete/{id}', [UserController::class, 'delete']);
});

Route::group(['prefix' => 'orders', 'middleware' => ['jwtauth']], function (){
   Route::post('calculate-order-price', [OrderController::class, 'calculateOrderPrice']);
   Route::post('create', [OrderController::class, 'create']);
   Route::get('/', [OrderController::class, 'orders']);
});

Route::group(['prefix' => 'fake'], function (){
   Route::post('sms', [FakeApiController::class, 'fake_sms'])->name('fake.fake_sms');
});
