<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
    return view('index');
});

// Route::post('/login', [LoginController::class, 'index'])->name('login');


Route::post('/show', [LoginController::class,'index'],function ($log){

} )->name('show');



Route::get('/login1', function () {
    return view('manage.login');
});

Route::get('/login2', function () {
    return view('promote.login');
});
