<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Unit;

class UnitIndex extends Component
{
    public $statusUpdate = false;
    public $unit_delete_id;
    public $unit_old;
    protected $listeners = [
        'unitStored' => 'handleStored',
        'unitUpdated' => 'handleUpdated'
    ];
    public function render()
    {
        return view('livewire.unit-index', [
            'units' => Unit::latest()->get()
        ])->layout('layouts.dashboard');
    }
    public function getUnit($id)
    {
        $this->statusUpdate = true;
        $unitRapat = Unit::find($id);
        $this->emit('getUnit', $unitRapat);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->unit_delete_id = $id;
            $unitRapat = Unit::find($this->unit_delete_id);
            $this->unit_old = $unitRapat->nama;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteUnit()
    {
        $unitRapat = Unit::find($this->unit_delete_id);
        $unitRapat->delete();
        session()->flash('message', 'Unit ' . $this->unit_old . ' Berhasil Dihapus !');
        $this->unit_delete_id = '';
        $this->unit_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->unit_delete_id = '';
    }
    public function handleStored($unit)
    {
        session()->flash('message', 'Unit ' . $unit['nama'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($unit)
    {
        session()->flash('message', 'Data Unit Berhasil Diubah !');
    }
}
