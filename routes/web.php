<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthControllerFE;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestoreController;
use App\Http\Controllers\ProfileContrllerFE;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage');
});

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

    Route::get('/profiles', [ProfileContrllerFE::class, 'index']);
    Route::get('/profiles/create', [ProfileContrllerFE::class, 'create']);
    Route::get('/profiles/{id}', [ProfileContrllerFE::class, 'show']);
    Route::post('/profiles', [ProfileContrllerFE::class, 'store']);
    Route::put('/profiles/{id}', [ProfileContrllerFE::class, 'update']);
    Route::delete('/profiles/{id}', [ProfileContrllerFE::class, 'destroy']);

    /**
     *  Basic Task CRUD. Requires a valid session.
     */

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    /**
     *  Basic Deliverable CRUD. Requires a valid session.
     */

    Route::get('/deliverables', [DeliverableController::class, 'index']);
    Route::get('/deliverables/{id}', [DeliverableController::class, 'show']);
    Route::post('/deliverables', [DeliverableController::class, 'store']);
    Route::put('/deliverables/{id}', [DeliverableController::class, 'update']);
    Route::delete('/deliverables/{id}', [DeliverableController::class, 'destroy']);

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

Route::get('/register', [AuthControllerFE::class, 'create']);
Route::post('/register', [AuthControllerFE::class, 'store']);
Route::get('/login', [AuthControllerFE::class, 'login_form']);
Route::post('/login', [AuthControllerFE::class, 'login']);
Route::post('/logout', [AuthControllerFE::class, 'logout']);



/**
 * JUST AN EXAMPLE BELOW 
 */


/*
 // Show register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create user account
Route::post('/register', [UserController::class, 'store']);

// Log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show user login form
Route::get('/login', [UserController::class, 'login_form'])->name('login')->middleware('guest');

// Log user in
Route::post('/login', [UserController::class, 'login']);

// Returns all projects
Route::get('/projects', [ProjectController::class, 'index']);

// Show create new project form
Route::get('/projects/create', [ProjectController::class, 'create'])->middleware('auth');

// Stores newly created project form
Route::post('/projects', [ProjectController::class, 'store'])->middleware('auth');

// Edits a single project
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->middleware('auth');

// Update a single project
Route::put('/projects/{project}', [ProjectController::class, 'update'])->middleware('auth');

// Delete a single project
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->middleware('auth');

// Returns a single project
Route::get('/projects/{project}', [ProjectController::class, 'show']);

// Manage all projects
Route::get('/management', [ManagementController::class, 'index'])->middleware('auth');
*/