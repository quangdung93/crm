<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">{{ $title }}</label>
    <div class="col-sm-9">
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
            <div class="text-danger mt-2">{{ $errors->first($name) }}</div>
        @endif
    </div>
</div>