<?php

namespace App\Http\Livewire;

use App\Models\Jabatan;
use App\Models\JabatanPegawai;
use App\Models\KategoriRapat;
use App\Models\Pegawai;
use App\Models\Permission;
use App\Models\Rapat;
use App\Models\Team;
use App\Models\Topik;
use App\Models\User;
use App\Models\Role;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Livewire\Component;

class RolesCreate extends Component
{
    public $name, $display_name, $description, $permission_array = [], $role_id, $old_role, $team;
    public function render()
    {
        return view('livewire.roles-create', [
            'permissions' => Permission::all()
        ])->layout('layouts.dashboard');
    }

    public function mount()
    {
        $this->team = request()->team;
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
    public function storeRole(Request $request)
    {
        $this->validate([
            'display_name' => 'required',
            'description' => 'required'
        ]);
        $role = Role::create([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);
        $this->role_id = $role->id;
        $role->permissions()->attach($this->permission_array);
        $this->resetInput();
        $this->emit('roleStored', $role);
        return redirect()->route('manage-roles')->with('message', 'Role ' . $this->old_role . ' telah ditambahkan !');
        // $this->dispatchBrowserEvent('close-create-modal');
    }
}
