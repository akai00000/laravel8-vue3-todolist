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
// titleaxiosデータ取得
Route::get('/todos', [App\Http\Controllers\HomeController::class, 'topAxios'])->name('topAxios');
// contentaxiosデータ取得
Route::get('/todosC', [App\Http\Controllers\HomeController::class, 'contentAxios'])->name('contentAxios');
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
// 削除タスク（完了タスク）の表示

// 削除タスクの復帰（物理復帰status２から１へ）

//vue_test(税込価格表示)
Route::get('/top2', [App\Http\Controllers\HomeController::class, 'vueDataGet'])->name('vueDataGet');
