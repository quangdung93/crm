<div class="form-group row">
    @if($type != 'tinymce')
        <label class="col-sm-3 col-form-label text-right">{{ $title }}</label>
    @endif
    <div class="{{ $type == 'tinymce' ? 'col-sm-12' : 'col-sm-9' }}">
        <textarea 
        class="{{ $type ?: 'form-control' }}"
        name="{{ $name }}">{{ old($name, $value)  }}</textarea>
    </div>
</div>