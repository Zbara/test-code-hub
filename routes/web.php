<?php

use App\Http\Controllers\CanvasController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CanvasController::class, 'canvas'])
    ->name('canvas');

Route::get('/{route}', [CanvasController::class, 'canvas'])
    ->where('route', '.*')
    ->name('canvas.route');
