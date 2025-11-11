<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Public Route
Route::post('login', [AuthController::class, 'handleLogin']);
Route::post('register', [AuthController::class, 'handleRegister']);

// Protected Route (Authenticated Users Only)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('tickets', [TicketController::class, 'index']);
    Route::post('tickets', [TicketController::class, 'store']);
    Route::get('tickets/{ticket}', [TicketController::class, 'show']);
    Route::put('tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('tickets/ticket', [TicketController::class, 'destroy']);
    Route::get('logout', [AuthController::class, 'handleLogout']);
});

