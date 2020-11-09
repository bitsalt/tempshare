<div>
    <div class="form-group">
        <label for="selectYear">Select Year</label>
        <select class="form-control" id="selectYear" wire:model="selectedYear">
            @foreach($schoolYears as $year)
            <option value="{{$year->school_year}}">{{$year->display}}</option>
            @endforeach
        </select>
    </div>
</div>
