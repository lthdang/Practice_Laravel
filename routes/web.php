<?php

use Illuminate\Support\Facades\Route;
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


Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('/login', [App\Http\Controllers\admin\AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [App\Http\Controllers\admin\AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard', [\App\Http\Controllers\admin\HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [\App\Http\Controllers\admin\HomeController::class, 'logout'])->name('admin.logout');
    });
});
