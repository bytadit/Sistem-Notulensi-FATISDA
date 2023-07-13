<?php

namespace App\Http\Livewire;

use App\Models\JabatanPegawai;
use Livewire\Component;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Unit;
use App\Models\Team;

class JabatanPegawaiUpdate extends Component
{
    public $jabatan_pegawai_id, $pegawai_nama, $team_nama, $jabatan_nama, $team_id;
    public function render()
    {
        return view('livewire.jabatan-pegawai-update', [
            // 'units' => Unit::latest()->get(),
            // 'units' => Unit::whereIn('id', JabatanPegawai::where('id_pegawai', Pegawai::where('id_user', auth()->user()->id)->first()->id)->pluck('id_unit'))->get(),
            'teams' => Team::where('name', 'like', Team::where('id', $this->team_id)->first()->name . '%')->get(),
            // 'units' => Unit::where('kode', 'like', )
            'jabatans' => Jabatan::latest()->get(),
            'pegawais' => Pegawai::latest()->get(),
            'users' => User::latest()->get()
        ]);
    }
    public function mount($team_id)
    {
        $this->team_id = $team_id;
    }
    protected $listeners = [
        'getJabatanPegawai' => 'showJabatanPegawai',
        // 'getTeam' => 'showTeam'
    ];

    protected $messages = [
        'pegawai_nama.required' => 'Input Nama Pegawai tidak boleh kosong !',
        'team_nama.required' => 'Input Nama Unit tidak boleh kosong !',
        'jabatan_nama.required' => 'Input Nama Jabatan tidak boleh kosong !',
    ];
    public function showJabatanPegawai($jabatanPegawai){
        $this->pegawai_nama = $jabatanPegawai['id_pegawai'];
        $this->jabatan_nama = $jabatanPegawai['id_jabatan'];
        $this->team_nama = $jabatanPegawai['id_team'];
        $this->jabatan_pegawai_id = $jabatanPegawai['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    // public function showTeam($team_id)
    // {
    //     $this->team = $team_id;
    // }
    public function updateJabatanPegawai()
    {
        $this->validate([
            'pegawai_nama' => 'required',
            'team_nama' => 'required',
            'jabatan_nama' => 'required'
        ]);
        if($this->jabatan_pegawai_id){
            $jabatanPegawai = JabatanPegawai::find($this->jabatan_pegawai_id);
            $jabatanPegawai->update([
                'id_pegawai' => $this->pegawai_nama,
                'id_team' => $this->team_nama,
                'id_jabatan' => $this->jabatan_nama
            ]);
        }
        $this->resetInput();
        $this->emit('jabatanPegawaiUpdated', $jabatanPegawai);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->pegawai_nama = '';
        $this->jabatan_nama = '';
        $this->team_nama = '';
    }
}
