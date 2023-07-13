<?php

namespace App\Http\Livewire;

use App\Models\KategoriRapat;
use App\Models\Permission;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;

class PermissionsUpdate extends Component
{
    public $permission, $permission_id, $display_name, $description, $name, $team;
    public function render()
    {
        return view('livewire.permissions-update');
    }
    protected $listeners = [
        'getPermission' => 'showPermission'
    ];
    public function mount()
    {
        $this->team = request()->team;
    }
    protected $messages = [
        'display_name.required' => 'Nama Permission tidak boleh kosong!',
        'description.required' => 'Deskripsi tidak boleh kosong!'
    ];
    public function showPermission($permission){
        $this->name = $permission['name'];
        $this->display_name = $permission['display_name'];
        $this->description = $permission['description'];
        $this->permission_id = $permission['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function generateSlug()
    {
        $this->name = SlugService::createSlug(Permission::class, 'name', $this->display_name);
    }
    public function updatePermission()
    {
        $this->validate([
            'display_name' => 'required',
            'description' => 'required'
        ]);
        if($this->permission_id){
            $permission = Permission::find($this->permission_id);
            $permission->update([
                'name' => $this->name,
                'display_name' => $this->display_name,
                'description' => $this->description
            ]);
        }
        $this->resetInput();
        $this->emit('permissionUpdated', $permission);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->display_name = '';
        $this->description = '';
        $this->name = '';
    }
}
