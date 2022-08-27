<div class="form-group">
    <label for="name">{{ $title }}</label>
    <select class="form-control populate select2" id="{{ $id ?? "" }}" name="{{ $name }}">
        <option value="">Chọn {{ $title }}</option>
        @if($lists)
            @foreach($lists as $list)
                <option value="{!! $list[$value] !!}" {{ $selected && $list[$value] == $selected ? 'selected' : '' }}>{{$list[$display]}}</option>
            @endforeach
        @endif
    </select>
    @if ($errors->has($name))
        <div class="text-danger mt-1">{{ $errors->first($name) }}</div>
    @endif
</div>