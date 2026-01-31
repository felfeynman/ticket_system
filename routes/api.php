<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;

// rota /api
Route::apiResource('tickets', TicketController::class);
Route::apiResource('categories', CategoryController::class);

// Lista todos os tickets
Route::get('/tickets', [TicketController::class, 'index']);

Route::get('/tickets/{ticket}', [TicketController::class, 'show']);
Route::put('/tickets/{ticket}', [TicketController::class, 'update']);
