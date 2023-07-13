<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jabatan;

class JabatanUpdate extends Component
{
    public $jabatan_nama, $jabatan_id;
    public function render()
    {
        return view('livewire.jabatan-update');
    }
    protected $listeners = [
        'getJabatan' => 'showJabatan'
    ];
    protected $messages = [
        'jabatan_nama.required' => 'Input Nama Jabatan tidak boleh kosong!',
    ];
    public function showJabatan($jabatan){
        $this->jabatan_nama = $jabatan['nama'];
        $this->jabatan_id = $jabatan['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function updateJabatan()
    {
        $this->validate([
            'jabatan_nama' => 'required',
        ]);
        if($this->jabatan_id){
            $jabatan = Jabatan::find($this->jabatan_id);
            $jabatan->update([
                'nama' => $this->jabatan_nama,
            ]);
        }
        $this->resetInput();
        $this->emit('jabatanUpdated', $jabatan);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->jabatan_nama = '';
        $this->jabatan_id = '';
    }
}
