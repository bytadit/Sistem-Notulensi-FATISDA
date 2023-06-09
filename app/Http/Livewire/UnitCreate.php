<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Unit;
class UnitCreate extends Component
{
    public $unit_nama, $unit_kode, $unit_isaktif;
    protected $messages = [
        'unit_nama.required' => 'Input Nama Unit tidak boleh kosong !',
        'unit_kode.required' => 'Input Kode Unit tidak boleh kosong !',
        'unit_isaktif.required' => 'Input Status Unit tidak boleh kosong !',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'unit_nama' => 'required',
            'unit_kode' => 'required',
            'unit_isaktif' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->unit_nama = '';
        $this->unit_kode = '';
        $this->unit_isaktif = '';
    }
    public function storeUnit()
    {
        $this->validate([
            'unit_nama' => 'required',
            'unit_kode' => 'required',
            'unit_isaktif' => 'required'
        ]);

        $unit = Unit::create([
            'nama' => $this->unit_nama,
            'kode' => $this->unit_kode,
            'is_aktif' => $this->unit_isaktif
        ]);
        $this->resetInput();
        $this->emit('unitStored', $unit);
        $this->dispatchBrowserEvent('close-create-modal');
    }
    public function render()
    {
        return view('livewire.unit-create');
    }
}
