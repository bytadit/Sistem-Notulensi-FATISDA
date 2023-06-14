<?php

namespace App\Http\Livewire;

use App\Models\JabatanPegawai;
use Livewire\Component;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Unit;

class JabatanPegawaiUpdate extends Component
{
    public $jabatan_pegawai_id, $pegawai_nama, $unit_nama, $jabatan_nama;
    public function render()
    {
        return view('livewire.jabatan-pegawai-update', [
            // 'units' => Unit::latest()->get(),
            'units' => Unit::whereIn('id', JabatanPegawai::where('id_pegawai', Pegawai::where('id_user', auth()->user()->id)->first()->id)->pluck('id_unit'))->get(),
            // 'units' => Unit::where('kode', 'like', )
            'jabatans' => Jabatan::latest()->get(),
            'pegawais' => Pegawai::latest()->get(),
            'users' => User::latest()->get()
        ]);
    }
    protected $listeners = [
        'getJabatanPegawai' => 'showJabatanPegawai'
    ];
    protected $messages = [
        'pegawai_nama.required' => 'Input Nama Pegawai tidak boleh kosong !',
        'unit_nama.required' => 'Input Nama Unit tidak boleh kosong !',
        'jabatan_nama.required' => 'Input Nama Jabatan tidak boleh kosong !',
    ];
    public function showJabatanPegawai($jabatanPegawai){
        $this->pegawai_nama = $jabatanPegawai['id_pegawai'];
        $this->jabatan_nama = $jabatanPegawai['id_jabatan'];
        $this->unit_nama = $jabatanPegawai['id_unit'];
        $this->jabatan_pegawai_id = $jabatanPegawai['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function updateJabatanPegawai()
    {
        $this->validate([
            'pegawai_nama' => 'required',
            'unit_nama' => 'required',
            'jabatan_nama' => 'required'
        ]);
        if($this->jabatan_pegawai_id){
            $jabatanPegawai = JabatanPegawai::find($this->jabatan_pegawai_id);
            $jabatanPegawai->update([
                'id_pegawai' => $this->pegawai_nama,
                'id_unit' => $this->unit_nama,
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
        $this->unit_nama = '';
    }
}
