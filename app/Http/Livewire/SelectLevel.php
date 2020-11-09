<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectLevel extends Component
{
    protected $listeners = ['yearSelected' => 'getLevelsForYear'];


    public function render()
    {
        return view('livewire.select-level');
    }

    public function getLevelsForYear(Request $request)
    {

    }
}
