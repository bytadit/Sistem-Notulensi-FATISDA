<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topik;

class TopikRapatUpdate extends Component
{
    public $topik_rapat, $topik_rapat_id, $topik_rapat_weight;
    protected $listeners = [
        'getTopikRapat' => 'showTopikRapat'
    ];
    public function render()
    {
        return view('livewire.topik-rapat-update');
    }
    protected $messages = [
        'topik_rapat.required' => 'Input Topik Rapat tidak boleh kosong!',
        'topik_rapat_weight.required' => 'Input Urgensi Topik tidak boleh kosong !'
    ];
    public function showTopikRapat($topikRapat){
        $this->topik_rapat = $topikRapat['nama'];
        $this->topik_rapat_weight = $topikRapat['weight'];
        $this->topik_rapat_id = $topikRapat['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function updateTopikRapat()
    {
        $this->validate([
            'topik_rapat' => 'required',
            'topik_rapat_weight' => 'required'
        ]);
        if($this->topik_rapat_id){
            $topikRapat = Topik::find($this->topik_rapat_id);
            $topikRapat->update([
                'nama' => $this->topik_rapat,
                'weight' => $this->topik_rapat_weight
            ]);
        }
        $this->resetInput();
        $this->emit('topikUpdated', $topikRapat);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->topik_rapat = '';
        $this->topik_rapat_weight = '';
        $this->topik_rapat_id = '';
    }
}
