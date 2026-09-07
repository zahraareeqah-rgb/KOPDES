<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\KopdesController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('manager', ManagerController::class);
Route::resource('kopdes', KopdesController::class);
