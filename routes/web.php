<?php

use App\Http\Controllers\ScheduleOptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/fetch-data-for-input',[\App\Http\Controllers\FetchOutputController::class, 'fetchDataForInput']);
Route::resource('schedule-option', ScheduleOptionController::class);

