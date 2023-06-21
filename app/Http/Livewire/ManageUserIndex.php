<?php

namespace App\Http\Livewire;

use App\Models\PermissionRole;
use App\Models\PermissionUser;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Team;
use App\Models\RoleUser;
use App\Models\Permission;

class ManageUserIndex extends Component
{
    public $statusUpdate = false, $kategori_delete_id, $kategori_rapat_old, $team;
    public function render()
    {
        return view('livewire.manage-user-index', [
            'teams' => Team::all(),
            'users' => User::whereNotIn('id', RoleUser::where('role_id', 1)->pluck('user_id'))->get(),
            'roles' => Role::where('name', '!=', 'superadministrator')->get(),
            'permissions' => Permission::all(),
            'role_users' => RoleUser::all(),
            'permission_users' => PermissionUser::whereNotIn('user_id', RoleUser::where('role_id', 1)->pluck('user_id'))->get(),
            'permission_roles' => PermissionRole::all()
        ])->layout('layouts.dashboard');
    }
    protected $listeners = [
        'kategoriStored' => 'handleStored',
        'kategoriUpdated' => 'handleUpdated'
    ];
    public function mount()
    {
        $this->team = request()->team;
    }
    public function getKategoriRapat($id)
    {
        $this->statusUpdate = true;
        $kategoriRapat = KategoriRapat::find($id);
        $this->emit('getKategoriRapat', $kategoriRapat);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->kategori_delete_id = $id;
            $kategoriRapat = KategoriRapat::find($this->kategori_delete_id);
            $this->kategori_rapat_old = $kategoriRapat->nama;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteKategoriRapat()
    {
        $kategoriRapat = KategoriRapat::find($this->kategori_delete_id);
        $kategoriRapat->delete();
        session()->flash('message', 'Kategori ' . $this->kategori_rapat_old . ' Berhasil Dihapus !');
        $this->kategori_delete_id = '';
        $this->kategori_rapat_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->kategori_delete_id = '';
    }
    public function handleStored($kategori_rapat)
    {
        session()->flash('message', 'Kategori ' . $kategori_rapat['nama'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($kategori_rapat)
    {
        session()->flash('message', 'Data Kategori Berhasil Diubah !');
    }
}
