<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JabatanPegawai;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Unit;

class JabatanPegawaiCreate extends Component
{
    public $pegawai_nama, $unit_nama, $jabatan_nama;
    public function render()
    {
        return view('livewire.jabatan-pegawai-create', [
            // 'units' => Unit::latest()->get(),
            'units' => Unit::whereIn('id', JabatanPegawai::where('id_pegawai', Pegawai::where('id_user', auth()->user()->id)->first()->id)->pluck('id_unit'))->get(),
            'jabatans' => Jabatan::latest()->get(),
            'pegawais' => Pegawai::latest()->get(),
            'users' => User::latest()->get()
        ]);
    }
    protected $messages = [
        'pegawai_nama.required' => 'Input Nama Pegawai tidak boleh kosong !',
        'unit_nama.required' => 'Input Nama Unit tidak boleh kosong !',
        'jabatan_nama.required' => 'Input Nama Jabatan tidak boleh kosong !',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'pegawai_nama' => 'required',
            'unit_nama' => 'required',
            'jabatan_nama' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->unit_nama = '';
        $this->jabatan_nama = '';
        $this->pegawai_nama = '';
    }
    public function storeJabatanPegawai()
    {
        $this->validate([
            'unit_nama' => 'required',
            'jabatan_nama' => 'required',
            'pegawai_nama' => 'required'
        ]);

        $jabatanPegawai = JabatanPegawai::create([
            'id_unit' => $this->unit_nama,
            'id_pegawai' => $this->pegawai_nama,
            'id_jabatan' => $this->jabatan_nama
        ]);
        $this->resetInput();
        $this->emit('jabatanPegawaiStored', $jabatanPegawai);
        $this->dispatchBrowserEvent('close-create-modal');
    }
}
