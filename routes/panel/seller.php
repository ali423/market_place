<?php

use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register',[RegisterController::class,'register'])->name('register');

Route::middleware(['auth:sanctum','seller'])->group(function (){
  Route::apiResource('product',ProductController::class);
});
