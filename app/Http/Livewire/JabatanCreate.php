<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jabatan;

class JabatanCreate extends Component
{
    public $jabatan_nama;
    protected $messages = [
        'jabatan_nama.required' => 'Input Nama Jabatan tidak boleh kosong !',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'jabatan_nama' => 'required',
        ]);
    }
    private function resetInput()
    {
        $this->jabatan_nama = '';
    }
    public function storeJabatan()
    {
        $this->validate([
            'jabatan_nama' => 'required',
        ]);

        $jabatan = Jabatan::create([
            'nama' => $this->jabatan_nama,
        ]);
        $this->resetInput();
        $this->emit('jabatanStored', $jabatan);
        $this->dispatchBrowserEvent('close-create-modal');
    }
    public function render()
    {
        return view('livewire.jabatan-create');
    }
}
