<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::prefix('todos')->group(function () {
    //Create todo
    Route::post('/', [TodoController::class, 'store']);
    // Route::get('/export', [TodoReportController::class, 'export']);
});

// Route::get('/chart', [ChartController::class, 'index']); 
