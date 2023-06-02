<?php

namespace App\Http\Livewire;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function(){
    Route::get('/', DashboardIndex::class)->name('dashboard.index');
    Route::prefix('admin')->group(function () {
        // Route::get('/daftar-rapat/{id}', DaftarRapatShow::class)->name('daftar-rapat.show');
        Route::get('/kategori-rapat', KategoriRapatIndex::class)->name('kategori-rapat');
        Route::get('/topik-rapat', TopikRapatIndex::class)->name('topik-rapat');
        Route::get('/daftar-rapat', DaftarRapatIndex::class)->name('daftar-rapat');
        Route::get('/daftar-rapat/create', DaftarRapatCreate::class)->name('daftar-rapat.create');
        Route::get('/daftar-rapat/{rapat:slug}', DaftarRapatShow::class)->name('daftar-rapat.show');
        Route::get('/daftar-rapat/{rapat:slug}/edit', DaftarRapatEdit::class)->name('daftar-rapat.edit');
    });
});
// Administrator & SuperAdministrator Control Panel Routes
// Route::group(['middleware' => ['auth', 'role:superadministrator'], 'prefix' => 'manage-users'], function () {
//     // Route::resource('users', 'UsersController');
//     // Route::resource('permission', 'PermissionController');
//     // Route::resource('roles', 'RolesController');
// });
