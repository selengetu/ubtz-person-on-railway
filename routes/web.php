<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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

Auth::routes();

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Route::get('/home', [App\Http\Controllers\DetailController::class, 'index'])->name('home');
Route::get('/report', [App\Http\Controllers\DetailController::class, 'report'])->name('report');
Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/detail', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::get('/detail/delete/{id}', [App\Http\Controllers\DetailController::class, 'destroy']);
Route::post('/adddetail', [App\Http\Controllers\DetailController::class, 'store']);
Route::get('/detailfill/{id?}', function ($id = 0) {
    $dt = DB::table('ribbon_detail')->where('detail_id', '=', $id)->get();
    return $dt;
});
Route::get('/detailribbonfill/{id?}', function ($id = 0) {
    $dt = DB::table('ribbon_detail')->where('ribbon_id', '=', $id)->get();
    return $dt;
});
Route::get('/filter_childabbr/{date}', 'DetailController@filter_childabbr');
Auth::routes();
