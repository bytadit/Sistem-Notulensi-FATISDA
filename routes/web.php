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
    Route::get('/profil-saya', ProfilIndex::class)->name('profil-saya');
    Route::get('/profil-saya/ubah', ProfilEdit::class)->name('ubah-profil');

    Route::group(['middleware' => ['role:administrator'], 'prefix' =>'admin'], function () {
        Route::get('/{team}/manage-pejabat', JabatanPegawaiIndex::class)->name('manage-pejabat');
        Route::get('/{team}/kategori-rapat', KategoriRapatIndex::class)->name('kategori-rapat');
        Route::get('/{team}/topik-rapat', TopikRapatIndex::class)->name('topik-rapat');
        Route::get('/{team}/daftar-rapat', DaftarRapatIndex::class)->name('daftar-rapat');
        Route::get('/{team}/daftar-rapat/create', DaftarRapatCreate::class)->name('daftar-rapat.create');
        Route::get('/{team}/daftar-rapat/{rapat:slug}', DaftarRapatShow::class)->name('daftar-rapat.show');
        Route::get('/{team}/daftar-rapat/{rapat:slug}/edit', DaftarRapatEdit::class)->name('daftar-rapat.edit');
    });
    Route::group(['middleware' => ['role:superadministrator'], 'prefix' => 'superadmin'], function () {
        Route::get('/manage-units', UnitIndex::class)->name('units');
        Route::get('/manage-jabatan', JabatanIndex::class)->name('jabatan');
    });
});
// Administrator & SuperAdministrator Control Panel Routes
