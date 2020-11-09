<?php

namespace App\Http\Livewire;

use App\Models\GradeLevel;
use App\Models\School;
use App\Models\SchoolYear;
use Livewire\Component;

class UserSelections extends Component
{

    public $selectedYear = '';
    public $selectedYearDisplay = '';
    public $selectedLevel = '';
    public $selectedLevelDisplay = '';
    public $selectedSchool = '';
    public $selectedSchoolDisplay = '';
    public $schoolYears = [];
    public $gradeLevels = [];
    public $schools = [];

    public function render()
    {
        if ($this->selectedYear) {
            $this->gradeLevels = GradeLevel::where('school_year', '=', $this->selectedYear);
        }

        $this->schoolYears = SchoolYear::all();

        if ($this->selectedLevel) {
            $this->schools = School::where('school_year', $this->selectedYear)
                ->where('school_grade_level_id', $this->selectedLevel);
        }

        return view('livewire.user-selections');
    }

    public function update($data)
    {
        dd($data);
        $this->selectedYear = $selectedYear;
        $this->setDisplayYear();

    }

    private function getLevels()
    {
        if (isset($this->selectedYear))
        {

        }
    }

    private function setDisplayYear()
    {
        if (isset($this->selectedYear)) {
            $this->selectedYearDisplay = SchoolYear::where('school_year', $this->selectedYear)
                ->first()
                ->display;
        }
    }
}
