<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">{{ $title }}</label>
    <div class="col-sm-9">
        <select class="form-control populate select2" name="{{ $name }}">
            <option value="">Chọn {{ $title }}</option>
            @if($lists)
                @foreach($lists as $list)
                    <option value="{{$list->$value}}" {{ $selected && $list->$value == $selected ? 'selected' : '' }}>{{$list->$display}}</option>
                @endforeach
            @endif
        </select>
        @if ($errors->has($name))
            <div class="text-danger mt-2">{{ $errors->first($name) }}</div>
        @endif
    </div>
</div>