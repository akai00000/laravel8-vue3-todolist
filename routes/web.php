<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Auth::routes();

Route::get('/top', [App\Http\Controllers\HomeController::class, 'index'])->name('top');
Route::get('/top', [App\Http\Controllers\HomeController::class, 'top'])->name('top');

Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
Route::post('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('update');

Route::get('/del', [App\Http\Controllers\HomeController::class, 'del'])->name('del');
Route::post('/del', [App\Http\Controllers\HomeController::class, 'remove'])->name('remove');

//vue_test(axiosAPI)
Route::get('/top2', [App\Http\Controllers\HomeController::class, 'vueDataGet'])->name('vueDataGet');
// ↓toptitle_test
Route::get('/toptitle', [App\Http\Controllers\HomeController::class, 'toptitle'])->name('toptitle');