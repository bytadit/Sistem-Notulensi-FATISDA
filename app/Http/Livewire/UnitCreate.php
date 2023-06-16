<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Unit;
class UnitCreate extends Component
{
    public $team_nama, $unit_kode, $unit_isaktif;
    protected $messages = [
        'team_nama.required' => 'Input Nama Unit tidak boleh kosong !',
        'unit_kode.required' => 'Input Kode Unit tidak boleh kosong !',
        'unit_isaktif.required' => 'Input Status Unit tidak boleh kosong !',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'team_nama' => 'required',
            'unit_kode' => 'required',
            'unit_isaktif' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->team_nama = '';
        $this->unit_kode = '';
        $this->unit_isaktif = '';
    }
    public function storeUnit()
    {
        $this->validate([
            'team_nama' => 'required',
            'unit_kode' => 'required',
            'unit_isaktif' => 'required'
        ]);

        $unit = Unit::create([
            'nama' => $this->team_nama,
            'kode' => $this->unit_kode,
            'is_aktif' => $this->unit_isaktif
        ]);
        $team = $unit->team()->create([
            'name' => $unit->kode,
            'display_name' => $unit->nama,
            'description' => $unit->nama
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
