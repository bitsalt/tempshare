<div>
    <div class="form-group">
        <label for="selectLevel">Select Level</label>
        <select class="form-control" id="selectLevel">
            @if(isset($gradeLevel))
              @foreach($gradeLevel as $level)
                <option value="{{$level->school_year}}">{{$level->display}}</option>
              @endforeach
            @else
                <option>Nothing to see here...move along</option>
            @endif
        </select>
    </div>
</div>
