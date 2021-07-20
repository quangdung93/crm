<div class="form-group row">
    <div class="{{ $type == 'long' ? 'col-sm-3 text-right' : 'col-sm-9'}}">
        <label class="col-form-label">{{ $title }}</label>
    </div>
    <div class="{{ $type == 'long' ? 'col-sm-9' : 'col-sm-3'}} col-form-label">
        <input 
            type="checkbox" 
            name="{{ $name }}" 
            id="{{ str_replace('-','_', $name) }}" 
            class="js-single" 
            {{ $checked == "true" ? 'checked' : '' }}>
    </div>
</div>