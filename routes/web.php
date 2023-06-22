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

    Route::group(['prefix' =>'admin'], function () {
        Route::get('/{team}/manage-pejabat', JabatanPegawaiIndex::class)->name('manage-pejabat');
        Route::get('/{team}/manage-pejabat/{pejabat}/permission', JabatanPegawaiPermission::class)->name('manage-pejabat.permission');
        Route::get('/{team}/kategori-rapat', KategoriRapatIndex::class)->name('kategori-rapat');
        Route::get('/{team}/topik-rapat', TopikRapatIndex::class)->name('topik-rapat');
        Route::get('/{team}/daftar-rapat', DaftarRapatIndex::class)->name('daftar-rapat');
        Route::get('/{team}/daftar-rapat/create', DaftarRapatCreate::class)->name('daftar-rapat.create');
        Route::get('/{team}/daftar-rapat/{rapat:slug}', DaftarRapatShow::class)->name('daftar-rapat.show');
        Route::get('/{team}/daftar-rapat/{rapat:slug}/edit', DaftarRapatEdit::class)->name('daftar-rapat.edit');
        Route::get('/{team}/daftar-rapat/{rapat:slug}/members', MemberCreate::class)->name('rapat-members');
        Route::get('/{team}/daftar-rapat/{rapat:slug}/members-edit', MemberEdit::class)->name('members.edit');
    });
    Route::group(['middleware' => ['role:superadministrator'], 'prefix' => 'superadmin'], function () {
        Route::get('/manage-units', UnitIndex::class)->name('units');
        Route::get('/manage-jabatan', JabatanIndex::class)->name('jabatan');
        Route::get('/manage-users', ManageUserIndex::class)->name('manage-users');
        Route::get('/manage-users/{user:id}/teams', ManageUserTeam::class)->name('manage-users.team');
        Route::get('/manage-users/{user:id}/teams/{team:id}/edit', ManageUserEdit::class)->name('manage-users.edit');
        Route::get('/manage-roles', RolesIndex::class)->name('manage-roles');
        Route::get('/manage-roles/create', RolesCreate::class)->name('manage-roles.create');
        Route::get('/manage-roles/{role:name}/edit', RolesEdit::class)->name('manage-roles.edit');
        Route::get('/manage-permissions', PermissionsIndex::class)->name('manage-permissions');

    });
    Route::group( ['prefix' => 'user'], function () {
        Route::get('/{team}/jadwal-rapat', JadwalRapatIndex::class)->name('jadwal-rapat');
        // Route::get('/manage-jabatan', JabatanIndex::class)->name('jabatan');
    });
});
// Administrator & SuperAdministrator Control Panel Routes
