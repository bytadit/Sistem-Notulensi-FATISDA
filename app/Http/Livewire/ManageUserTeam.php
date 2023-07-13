<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\PermissionUser;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class ManageUserTeam extends Component
{
    public $statusUpdate = false, $user_team_delete_id, $user_team_old, $team, $user_id, $user_delete_id, $user_name;
    public function render()
    {
        return view('livewire.manage-user-team', [
            'teams' => Team::whereIn('id', RoleUser::where('user_id', $this->user_id)->pluck('team_id'))->get(),
            'users' => User::latest()->get(),
//            'users' => User::whereNotIn('id', RoleUser::where('role_id', 1)->pluck('user_id'))->get(),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'role_users' => RoleUser::all(),
            'permission_users' => PermissionUser::all(),
//            'permission_users' => PermissionUser::whereNotIn('user_id', RoleUser::where('role_id', 1)->pluck('user_id'))->get(),
            'permission_roles' => PermissionRole::all()
        ])->layout('layouts.dashboard');
    }
    protected $listeners = [
        'userTeamStored' => 'handleStored',
        'userTeamUpdated' => 'handleUpdated'
    ];
    public function mount()
    {
        $this->team = request()->team;
        $this->user_id = request()->user;
        $this->user_name = User::where('id', $this->user_id)->first()->name;
    }
    public function getUser($id)
    {
        $this->statusUpdate = true;
        $user = User::find($id);
        $this->emit('getUser', $user);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->user_team_delete_id = $id;
            $user = User::find($this->user_delete_id);
            $this->user_old = $user->name;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function editUserDetail($id)
    {
        return redirect()->route('manage-users.edit', ['user' => $this->user_id, 'team' => $this->team]);
    }
    public function deleteUser()
    {
        $user = User::find($this->user_delete_id);
        $user->delete();
        session()->flash('message', 'User ' . $this->user_old . ' Berhasil Dihapus !');
        $this->user_delete_id = '';
        $this->user_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->user_delete_id = '';
    }
    public function handleStored($user)
    {
        session()->flash('message', 'User ' . $user['name'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($user)
    {
        session()->flash('message', 'Data User Berhasil Diubah !');
    }
}
