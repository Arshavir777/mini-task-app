<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CustomerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('countries')->uses([CountryController::class, 'index']);

Route::post('customers')->uses([CustomerController::class, 'store']);
Route::patch('customers/{id}')->uses([CustomerController::class, 'update']);
Route::get('customers')->uses([CustomerController::class, 'index']);
Route::get('customers/{id}')->uses([CustomerController::class, 'show']);
Route::delete('customers/{id}')->uses([CustomerController::class, 'destroy']);
