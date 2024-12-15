<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderInfosController;

Route::post('/orders', [OrderInfosController::class, 'store']);
Route::get('/orders/{id}', [OrderInfosController::class, 'show']);