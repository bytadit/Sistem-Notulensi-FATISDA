<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function(){
    Route::get('/', function (){
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::prefix('admin')->group(function () {
        Route::get('/kategori-rapat', function () {
            return view('dashboard.admin.kategori-rapat');
        })->name('kategori-rapat');
        Route::get('/topik-rapat', function () {
            return view('dashboard.admin.topik-rapat');
        })->name('topik-rapat');
        Route::get('/daftar-rapat', function () {
            return view('dashboard.admin.daftar-rapat');
        })->name('daftar-rapat');
    });
});
