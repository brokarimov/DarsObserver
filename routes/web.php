<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\Check;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('layouts.main');
});

Route::middleware(Check::class)->group(function () {
    Route::resource('student', StudentController::class);
    // Agents
    Route::get('/agent/{agent}', [AgentController::class, 'index']);
    Route::post('/agent', [AgentController::class, 'store']);
    Route::post('/agentProduct', [AgentController::class, 'addProduct']);
    Route::post('/agentProductUpdate', [AgentController::class, 'updateProductOfAgent']);
    Route::put('/agent/{agent}', [AgentController::class, 'update']);
    Route::delete('/agent/{agent}', [AgentController::class, 'destroy']);
    Route::get('/agents', [AgentController::class, 'getAll']);

    // Products
    Route::resource('product', ProductController::class);

});
Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);

Route::get('logout', [AuthController::class, 'logout']);
