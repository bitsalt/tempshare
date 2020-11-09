<?php

namespace App\Http\Livewire;

use App\Models\SchoolYear;
use Livewire\Component;

class YearSelect extends Component
{
    public function render()
    {
        return view('livewire.year-select',[
            'schoolYears' => SchoolYear::all()
        ]);
    }
}
