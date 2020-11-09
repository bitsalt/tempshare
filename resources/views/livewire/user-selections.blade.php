<div>
    <div class="row ml-1">
        <div class="form-group">
            <label for="selectYear">Year: {{$selectedYearDisplay}}</label>
            <select class="form-control" id="selectYear" wire:model="selectedYear">
                <option value="">Select Year</option>
                @foreach($schoolYears as $year)
                    <option value="{{$year->school_year}}">{{$year->display}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row ml-1">
        <div class="form-group">
            <label for="selectLevel">Level</label>
            <select class="form-control" id="selectLevel">
                <option value="">Select Level</option>
                @if(isset($gradeLevelsArray))
                    @foreach($gradeLevelsArray as $level)
                        <option value="{{$level->school_year}}">{{$level->display}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
