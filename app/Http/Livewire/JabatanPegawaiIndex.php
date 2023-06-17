<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JabatanPegawai;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Unit;
use App\Models\User;
use App\Models\Team;

class JabatanPegawaiIndex extends Component
{
    public $statusUpdate = false;
    public $jabatan_pegawai_delete_id;
    public $jabatan_pegawai_old, $team_id;
    public function render()
    {
        return view('livewire.jabatan-pegawai-index', [
            'units' => Unit::latest()->get(),
            'pegawais' => Pegawai::latest()->get(),
            'jabatans' => Jabatan::latest()->get(),
            'jabatanPegawais' => JabatanPegawai::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team_id)->first()->name . '%')->pluck('id'))->get(),
            'users' => User::latest()->get()
        ])->layout('layouts.dashboard');
    }
    public function mount()
    {
        $this->team_id = request()->team;
    }
    protected $listeners = [
        'jabatanPegawaiStored' => 'handleStored',
        'jabatanPegawaiUpdated' => 'handleUpdated'
    ];
    public function getJabatanPegawai($id)
    {
        $this->statusUpdate = true;
        $jabatanPegawai = JabatanPegawai::find($id);
        $this->emit('getJabatanPegawai', $jabatanPegawai);
    }
    public function getTeam()
    {
        $team_id = $this->team_id;
        $this->emit('getTeam', $team_id);
    }

    public function deleteConfirmation($id)
    {
        if($id){
            $this->jabatan_pegawai_delete_id = $id;
            $jabatanPegawai = JabatanPegawai::find($this->jabatan_pegawai_delete_id);
            $this->jabatan_pegawai_old = User::where('id', Pegawai::where('id', $jabatanPegawai->id_pegawai)->first()->id_user)->first()->name;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteJabatanPegawai()
    {
        $jabatanPegawai = JabatanPegawai::find($this->jabatan_pegawai_delete_id);
        $jabatanPegawai->delete();
        session()->flash('message', 'Pejabat ' . $this->jabatan_pegawai_old . ' Berhasil Dihapus !');
        $this->jabatan_pegawai_delete_id = '';
        $this->jabatan_pegawai_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->jabatan_pegawai_delete_id = '';
    }
    public function handleStored($jabatanPegawai)
    {
        session()->flash('message', 'Pejabat ' . User::where('id', Pegawai::where('id', $jabatanPegawai['id_pegawai'])->first()->id_user)->first()->nama . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($jabatanPegawai)
    {
        session()->flash('message', 'Data Pejabat Berhasil Diubah !');
    }
}
