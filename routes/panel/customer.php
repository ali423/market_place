<?php

use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Controllers\Customer\SellerController;
use App\Http\Controllers\Seller\ProductController;
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

Route::post('register',[RegisterController::class,'register']);

Route::middleware(['auth:sanctum','customer'])->group(function (){

Route::get('seller/product',[SellerController::class,'index'])->name('seller.index');

Route::post('order/{seller_profile:uuid}',[OrderController::class,'store']);

});
