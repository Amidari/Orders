<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('layouts.app');
//});
Route::get('/',\App\Http\Controllers\IndexController::class);
Route::get('/{page}',\App\Http\Controllers\IndexController::class)->where('pade', '.*');
