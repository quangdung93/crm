<div class="form-group row">
    <div class="col-sm-12">
        <textarea class="tinymce"
        name="{{ $name }}">
            {{ old($name, $value)  }}
        </textarea>
    </div>
</div>