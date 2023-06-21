<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Rapat;
use App\Models\Team;
use App\Models\Role;
use App\Models\PermissionRole;
use Livewire\Component;

class RolesIndex extends Component
{
    public $statusUpdate = false, $role_delete_id, $role_old, $role_show_id, $team;
    public function render()
    {
        return view('livewire.roles-index', [
            'roles' => Role::latest()->get(),
            'permission_roles' => PermissionRole::all(),
            'permissions' => Permission::latest()->get()
        ])->layout('layouts.dashboard');
    }
    protected $listeners = [
        'roleStored' => 'handleStored',
    ];
    public function mount()
    {
        $this->team = request()->team;
    }
    public function getRole($id)
    {
//        $this->statusUpdate = true;
        return redirect()->route('manage-roles.edit', ['role' => $id]);
    }
    public function editRole($id)
    {
        $role_name = Role::where('id', $id)->first()->name;
        return redirect()->route('manage-roles.edit', ['role' => $role_name]);
    }
    public function createRole()
    {
        return redirect()->route('manage-roles.create');
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->role_delete_id = $id;
            $role = Role::find($this->role_delete_id);
            $this->role_old = $role->display_name;
        }
    }
    public function showCreateModal(){
//        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteRole()
    {
        $role = Role::find($this->role_delete_id);
        $role->delete();
        session()->flash('message', 'Role ' . $this->role_old . ' Berhasil Dihapus !');
        $this->role_delete_id = '';
        $this->role_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->role_delete_id = '';
    }
    public function handleStored($role)
    {
        session()->flash('message', 'Role ' . $role['display_name'] . ' Berhasil Ditambahkan !');
    }
}
