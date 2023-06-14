<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Pegawai;

class ProfilIndex extends Component
{
    public $statusUpdate = false;
    public $user_delete_id;
    public $user_old;
    public function render()
    {
        // $pegawai = Pegawai::where('id_user', 1)->get();
        // return dd($pegawai);
        return view('livewire.profil-index', [
            'user' => auth()->user(),
            'pegawai' => Pegawai::where('id_user', 1)->get()
        ])->layout('layouts.dashboard');
    }
    protected $listeners = [
        'userStored' => 'handleStored',
        'userUpdated' => 'handleUpdated'
    ];
    public function getUser($id)
    {
        $this->statusUpdate = true;
        $user= User::find($id);
        $this->emit('getUser', $user);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->user_delete_id = $id;
            $user = User::find($this->user_delete_id);
            $this->user_old = $user->name;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteUser()
    {
        $user = User::find($this->user_delete_id);
        $user->delete();
        session()->flash('message', 'Data User ' . $this->user_rapat_old . ' Berhasil Dihapus !');
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
        session()->flash('message', 'Data User ' . $user['name'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($user)
    {
        session()->flash('message', 'Data User Rapat Berhasil Diubah !');
    }
}
