<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Companyinformation\CompanyInformationController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::get('company-information', [CompanyInformationController::class, 'companyinfo']);
Route::get('product/category', [ProductController::class, 'productCategory']);
Route::prefix('product')->as('product')->group(function () {
    Route::get('featured_product', [ProductController::class, 'index']);
    Route::get('today_deals', [ProductController::class, 'today_deals']);
    Route::get('new_arrival', [ProductController::class, 'new_arrival']);
    Route::get('product-details/{id}', [ProductController::class, 'productDetails']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('user', [UserController::class, 'index']);
});
