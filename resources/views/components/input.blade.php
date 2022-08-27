<div class="form-group">
    <label for="name">{{ $title }}</label>
    <input type="{{ $type }}" 
        name="{{ $name }}"
        value="{{ old($name, $value)  }}"
        @if($id) id="{{ $id }}" @endif
        placeholder="Nhập {{ $title }}" 
        data-toggle="tooltip" 
        data-placement="bottom"
        data-original-title="Nhập {{ $title }}"
        class="form-control @if($class){{$class}}@endif"
        {{ $required ? 'required' : '' }}/>
        @if ($errors->has($name))
            <div class="text-danger mt-1">{{ $errors->first($name) }}</div>
        @endif
</div>