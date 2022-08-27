<div class="form-group">
    @if($type != 'tinymce')
        <label for="name">{{ $title }}</label>
    @endif
    <textarea 
        class="{{ $type ?: 'form-control' }}"
        name="{{ $name }}">{{ old($name, $value)  }}</textarea>
</div>