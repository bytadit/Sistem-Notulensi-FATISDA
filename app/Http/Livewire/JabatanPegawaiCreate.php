<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JabatanPegawai;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Unit;
use App\Models\Team;

class JabatanPegawaiCreate extends Component
{
    public $pegawai_nama, $team_nama, $jabatan_nama, $team_id;
    public function render()
    {
        return view('livewire.jabatan-pegawai-create', [
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
    protected $messages = [
        'pegawai_nama.required' => 'Input Nama Pegawai tidak boleh kosong !',
        'team_nama.required' => 'Input Nama Unit tidak boleh kosong !',
        'jabatan_nama.required' => 'Input Nama Jabatan tidak boleh kosong !',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'pegawai_nama' => 'required',
            'team_nama' => 'required',
            'jabatan_nama' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->team_nama = '';
        $this->jabatan_nama = '';
        $this->pegawai_nama = '';
    }
    public function storeJabatanPegawai()
    {
        $this->validate([
            'team_nama' => 'required',
            'jabatan_nama' => 'required',
            'pegawai_nama' => 'required'
        ]);

        $jabatanPegawai = JabatanPegawai::create([
            'id_team' => $this->team_nama,
            'id_pegawai' => $this->pegawai_nama,
            'id_jabatan' => $this->jabatan_nama
        ]);
        $this->resetInput();
        $this->emit('jabatanPegawaiStored', $jabatanPegawai);
        $this->dispatchBrowserEvent('close-create-modal');
    }
}
