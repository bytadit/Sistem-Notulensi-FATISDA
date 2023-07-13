<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MemberEdit extends Component
{
    public $team, $rapat;
    public function render()
    {
        return view('livewire.member-edit')
                    ->layout('layouts.dashboard');
    }
    public function mount()
    {
        $this->team = request()->team;
        $this->rapat = request()->rapat;
    }
}
