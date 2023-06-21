<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Presensi;
use App\Models\Rapat;
use App\Models\Role;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\PermissionRole;

class RolesEdit extends Component
{
    public $name, $display_name, $description, $permission_array = [], $role_id, $old_role, $team;
    public function render()
    {
        return view('livewire.roles-edit', [
            'permissions' => Permission::all(),
            'permission_roles' => PermissionRole::all()
        ])->layout('layouts.dashboard');
    }
    public function mount(Role $role)
    {
        $this->team = request()->team;
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->display_name = $role->display_name;
        $this->description = $role->description;
        $this->permission_array = PermissionRole::where('role_id', $role->id)->pluck('permission_id');
    }

    protected $messages = [
        'display_name.required' => 'Display Name Role tidak boleh kosong!',
        'description.required' => 'Deskripsi Role tidak boleh kosong!',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'display_name' => 'required',
            'description' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->old_role = $this->display_name;
        $this->name = '';
        $this->display_name = '';
        $this->description = '';
        $this->permission_array = [];
    }
    public function generateSlug()
    {
        $this->name = SlugService::createSlug(Role::class, 'name', $this->display_name);
    }
    public function updateRole(Request $request)
    {
        $this->validate([
            'display_name' => 'required',
            'description' => 'required'
        ]);

        if($this->role_id){
            $this_role = Role::find($this->role_id);
            if($this->display_name != $this_role->display_name){
                $this_role->display_name= null;
            }
            $this_role->update([
                'name' => $this->name,
                'display_name' => $this->display_name,
                'description' => $this->description,
            ]);
        $this->role_id = $this_role->id;
        $this_role->permissions()->sync($this->permission_array);
        }
        $this->resetInput();
        $this->emit('roleUpdated', $this_role);
        return redirect()->route('manage-roles')->with('message', 'Role ' . $this->old_role . ' telah diupdate !');
        // $this->dispatchBrowserEvent('close-create-modal');
    }
}
