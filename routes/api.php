<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\TodoReportController;

Route::prefix('todos')->group(function () {
      Route::post('/', [TodoController::class, 'store']);
      Route::get('/export', [TodoReportController::class, 'export']);
});

Route::get('/chart', [ChartController::class, 'index']);
