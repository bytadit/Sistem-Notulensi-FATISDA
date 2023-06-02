<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topik;

class TopikRapatCreate extends Component
{
    public $topik_rapat, $topik_rapat_priority;
    protected $messages = [
        'topik_rapat.required' => 'Input Topik Rapat tidak boleh kosong !',
        'topik_rapat_priority.required' => 'Input Urgensi Topik tidak boleh kosong !'
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'topik_rapat' => 'required',
            'topik_rapat_priority' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->topik_rapat = '';
        $this->topik_rapat_priority = '';
    }
    public function storeTopikRapat()
    {
        $this->validate([
            'topik_rapat' => 'required',
            'topik_rapat_priority' => 'required'
        ]);
        $topik_rapat = Topik::create([
            'nama' => $this->topik_rapat,
            'priority' => $this->topik_rapat_priority
        ]);
        $this->resetInput();
        $this->emit('topikStored', $topik_rapat);
        $this->dispatchBrowserEvent('close-create-modal');
    }
    public function render()
    {
        return view('livewire.topik-rapat-create');
    }
}
