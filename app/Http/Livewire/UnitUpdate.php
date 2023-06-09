<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Unit;

class UnitUpdate extends Component
{
    public $unit_nama, $unit_id, $unit_kode, $unit_isaktif;
    public function render()
    {
        return view('livewire.unit-update');
    }
    protected $listeners = [
        'getUnit' => 'showUnit'
    ];
    protected $messages = [
        'unit_nama.required' => 'Input Nama Unit tidak boleh kosong!',
        'unit_kode.required' => 'Input Kode Unit tidak boleh kosong !',
        'unit_isaktif.required' => 'Input Status Unit tidak boleh kosong !',
    ];
    public function showUnit($unit){
        $this->unit_nama = $unit['nama'];
        $this->unit_kode = $unit['kode'];
        $this->unit_isaktif = $unit['is_aktif'];
        $this->unit_id = $unit['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function updateUnit()
    {
        $this->validate([
            'unit_nama' => 'required',
            'unit_kode' => 'required',
            'unit_isaktif' => 'required'
        ]);
        if($this->unit_id){
            $unit = Unit::find($this->unit_id);
            $unit->update([
                'nama' => $this->unit_nama,
                'kode' => $this->unit_kode,
                'is_aktif' => $this->unit_isaktif,
            ]);
        }
        $this->resetInput();
        $this->emit('unitUpdated', $unit);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->unit_nama = '';
        $this->unit_kode = '';
        $this->unit_isaktif = '';
        $this->unit_id = '';
    }
}
