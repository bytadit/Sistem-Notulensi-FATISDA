<?php

namespace App\Http\Livewire;

use App\Models\KategoriRapat;
use App\Models\Permission;
use App\Models\Team;
use Livewire\Component;

class PermissionsIndex extends Component
{
    public $statusUpdate = false, $permission_delete_id, $permission_old, $team;
    public function render()
    {
        return view('livewire.permissions-index', [
            'permissions' => Permission::latest()->get()
        ])->layout('layouts.dashboard');
    }
    protected $listeners = [
        'permissionStored' => 'handleStored',
        'permissionUpdated' => 'handleUpdated'
    ];
    public function mount()
    {
        $this->team = request()->team;
    }
    public function getPermission($id)
    {
        $this->statusUpdate = true;
        $permission = Permission::find($id);
        $this->emit('getPermission', $permission);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->permission_delete_id = $id;
            $permission = Permission::find($this->permission_delete_id);
            $this->permission_old = $permission->display_name;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deletePermission()
    {
        $permission = Permission::find($this->permission_delete_id);
        $permission->delete();
        session()->flash('message', 'Permission ' . $this->permission_old . ' Berhasil Dihapus !');
        $this->permission_delete_id = '';
        $this->permission_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->permission_delete_id = '';
    }
    public function handleStored($permission)
    {
        session()->flash('message', 'Permission ' . $permission['display_name'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($permission_rapat)
    {
        session()->flash('message', 'Data Permission Berhasil Diubah !');
    }
}
