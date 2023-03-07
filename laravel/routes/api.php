<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SalesOrderController;
use App\Http\Controllers\Api\CustomerReceiptController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('api.token');
Route::get('auth/verify', [AuthController::class, 'verify'])->middleware('api.token');

Route::middleware('api.token')->prefix('/v1')->group(function () {
    Route::resource('users', UserController::class)->except('create', 'edit');
    Route::resource('materials', MaterialController::class)->except('create', 'edit');
    Route::resource('customers', CustomerController::class)->except('create', 'edit');
    Route::resource('customer-receipts', CustomerReceiptController::class)->except('create', 'edit');
    Route::resource('sales-order', SalesOrderController::class)->only('index', 'show'); 
}); 