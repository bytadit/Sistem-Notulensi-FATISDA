<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use Livewire\Component;

class PermissionsIndex extends Component
{
    public function render()
    {
        return view('livewire.permissions-index', [
            'permissions' => Permission::all()
        ])->layout('layouts.dashboard');
    }
}
