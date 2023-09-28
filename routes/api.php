<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestoreController;

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
    /**
     *  Basic User CRUD. Requires a valid session.
     */
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    /**
     *  Basic Profile CRUD. Requires a valid session.
     */

    Route::get('/profiles', [ProfileController::class, 'index']);
    Route::get('/profiles/{id}', [ProfileController::class, 'show']);
    Route::post('/profiles', [ProfileController::class, 'store']);
    Route::put('/profiles/{id}', [ProfileController::class, 'update']);
    Route::delete('/profiles/{id}', [UserController::class, 'destroy']);

    /**
     *  Routes to restore Users. Will require admin permissions.
     */
    Route::post('/logout', [AuthController::class, 'logout']);

    /**
     *  Routes to restore Users. Will require admin permissions.
     */
    Route::post('/restore', [RestoreController::class, 'bulk_restore']);
    Route::post('/restore/{resource}/{id}', [RestoreController::class, 'restore']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




Route::get('/', function () {
    return response("Welcome to the MS Test API. For the full documentation visit https://github.com/rmonteirobimms/ms_test_api.", 200);
});
