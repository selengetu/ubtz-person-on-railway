<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\DetailController;
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

Route::get('/home', [DetailController::class, 'index'])->name('home');
Route::get('/report', [DetailController::class, 'report'])->name('report');
Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/detail', [DetailController::class, 'index'])->name('detail');
Route::get('/detail/delete/{id}', [DetailController::class, 'destroy']);
Route::post('/adddetail', [DetailController::class, 'store']);
Route::get('/filter_childabbr/{date}', 'DetailController@filter_childabbr');
Auth::routes();
