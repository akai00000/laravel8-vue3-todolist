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

// topview表示
Route::get('/top', [App\Http\Controllers\HomeController::class, 'top'])->name('top');
// 新規作成ページ表示
Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
// 新規作成メソッド実行
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
// 編集ページ表示
Route::get('/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
// 更新メソッド実行
Route::post('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
// 削除ページ表示
Route::get('/done', [App\Http\Controllers\HomeController::class, 'done'])->name('done');
// 削除実行status → 1から2へ変更（物理消去）
Route::post('/del', [App\Http\Controllers\HomeController::class, 'remove'])->name('remove');

// axiosTodosデータ取得
Route::get('/todos', [App\Http\Controllers\HomeController::class, 'axiosGetTodos'])->name('axiosGetTodos');
// axiosRabelsデータ取得
Route::get('/rabels', [App\Http\Controllers\HomeController::class, 'axiosGetRabels'])->name('axiosGetRabels');