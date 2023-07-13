<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\PermissionUser;
use App\Models\Role;
use App\Models\RoleUser;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\User;
use App\Models\Team;

class ManageUserEdit extends Component
{
    public $user_name, $user_delete_id, $user_id, $user, $role_array = [], $permission_array = [], $old_user, $team, $team_name;
    public function render()
    {
        return view('livewire.manage-user-edit', [
            'permissions' => Permission::all(),
            'roles' => Role::where('id', '!=', 1)->get(),
            'role_users' => RoleUser::all(),
            'permission_roles' => PermissionRole::all(),
            'permission_users' => PermissionUser::all()
        ])->layout('layouts.dashboard');
    }
    public function mount(Role $role)
    {
        $this->team = request()->team;
        $this->team_name = Team::where('id', $this->team)->first()->display_name;
        $this->user_id = request()->user;
        $this->user_name = User::where('id', $this->user_id)->first()->name;
        $this->permission_array = PermissionUser::where('user_id', $this->user_id)->where('team_id', $this->team)->pluck('permission_id')->toArray();
        $this->role_array = RoleUser::where('user_id', $this->user_id)->where('team_id', $this->team)->pluck('role_id')->toArray();
    }

    protected $messages = [
//        'display_name.required' => 'Display Name Role tidak boleh kosong!',
//        'description.required' => 'Deskripsi Role tidak boleh kosong!',
    ];
//    public function updated($fields)
//    {
//        $this->validateOnly($fields, [
//            'display_name' => 'required',
//            'description' => 'required'
//        ]);
//    }
    private function resetInput()
    {
        $this->old_user = $this->user_name;
        $this->permission_array = [];
        $this->role_array = [];
    }
//    public function generateSlug()
//    {
//        $this->name = SlugService::createSlug(Role::class, 'name', $this->display_name);
//    }
    public function updateUser(Request $request)
    {
//        $this->validate([
//            'display_name' => 'required',
//            'description' => 'required'
//        ]);

        if($this->user_id){
            $this_user = User::find($this->user_id);
            $this_team = Team::find($this->team);
            $this_user->syncRoles($this->role_array, $this_team);
            $this_user->syncPermissions($this->permission_array, $this_team);
        }
        $this->resetInput();
        $this->emit('userUpdated', $this_user);
        return redirect()->route('manage-users.team', ['user'=>$this->user_id])->with('message', 'User ' . $this->old_user . ' telah diupdate !');
        // $this->dispatchBrowserEvent('close-create-modal');
    }
}
