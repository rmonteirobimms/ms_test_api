<?php

use App\Http\Controllers\RestoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::middleware('auth:sanctum')->group(function () {
   
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::post('/restore', [RestoreController::class, 'bulk_restore']);
Route::post('/restore/{resource}/{id}', [RestoreController::class, 'restore']);


Route::get('/', function () {
    return response("Welcome to the MS Test API. For the full documentation visit https://github.com/rmonteirobimms/ms_test_api.", 200);
});
