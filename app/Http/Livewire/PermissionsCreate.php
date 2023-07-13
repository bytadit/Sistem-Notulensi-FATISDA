<?php

namespace App\Http\Livewire;

use App\Models\KategoriRapat;
use App\Models\Permission;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PermissionsCreate extends Component
{
    public $permission, $display_name, $description, $name, $team;
    public function render()
    {
        return view('livewire.permissions-create');
    }
    protected $messages = [
        'display_name.required' => 'Nama Permission tidak boleh kosong!',
        'description.required' => 'Deskripsi tidak boleh kosong!'
    ];
    public function mount()
    {
        $this->team = request()->team;
        $this->name = 'nama-permission';
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'display_name' => 'required',
            'description' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->display_name = '';
        $this->description = '';
        $this->name = '';
    }
    public function generateSlug()
    {
        $this->name = SlugService::createSlug(Permission::class, 'name', $this->display_name);
    }
    public function storePermission(Request $request)
    {
        $this->validate([
            'display_name' => 'required',
            'description' => 'required'
        ]);
        $permission = Permission::create([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);
        $this->resetInput();
        $this->emit('permissionStored', $permission);
        $this->dispatchBrowserEvent('close-create-modal');
    }
}
