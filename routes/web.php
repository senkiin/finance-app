<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);

