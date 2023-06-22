<?php

namespace App\Http\Livewire;

use App\Models\JabatanPegawai;
use App\Models\Pegawai;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\PermissionUser;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class JabatanPegawaiPermission extends Component
{
    public $user_name, $user_id, $user, $permission_array = [], $role_array = [], $old_user, $team, $team_name, $pejabat;
    public function render()
    {
        return view('livewire.jabatan-pegawai-permission', [
            'permissions' => Permission::all(),
            'roles' => Role::where('id', '>', 3)->get(),
            'role_users' => RoleUser::all(),
            'permission_roles' => PermissionRole::all(),
            'permission_users' => PermissionUser::all()
        ])->layout('layouts.dashboard');
    }
    public function mount(Role $role)
    {
        $this->team = request()->team;
        $this->team_name = Team::find($this->team)->first()->name;
        $this->pejabat = request()->pejabat; //id_jabatan_pegawai (pejabat)
        $this->user = User::where('id', Pegawai::where('id', JabatanPegawai::where('id', $this->pejabat)->first()->id_pegawai)->first()->id_user)->first();
        $this->team_name = Team::where('id', $this->team)->first()->display_name;
//        $this->user_id = request()->user;
        $this->user_name = User::where('id', $this->user->id)->first()->name;
        $this->role_array = RoleUser::where('user_id', $this->user->id)->where('team_id', $this->team)->pluck('role_id')->toArray();
        $this->permission_array = PermissionUser::where('user_id', $this->user->id)->where('team_id', $this->team)->pluck('permission_id')->toArray();
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
        $this->old_user = $this->user->name;
        $this->permission_array = [];
        $this->role_array = [];

    }
//    public function generateSlug()
//    {
//        $this->name = SlugService::createSlug(Role::class, 'name', $this->display_name);
//    }
    public function updatePermission(Request $request)
    {
//        $this->validate([
//            'display_name' => 'required',
//            'description' => 'required'
//        ]);

        if($this->user){
            $this_user = $this->user;
            $this_team = Team::find($this->team);
            $this_user->syncRoles($this->role_array, $this_team);
            $this_user->syncPermissions($this->permission_array, $this_team);
        }
        $this->resetInput();
        $this->emit('permissionUpdated', $this_user);
        return redirect()->route('manage-pejabat', ['team'=>$this->team])->with('message', 'Permission User ' . $this->old_user . ' di Unit ' . $this->team_name . ' telah diupdate !');
        // $this->dispatchBrowserEvent('close-create-modal');
    }
}
