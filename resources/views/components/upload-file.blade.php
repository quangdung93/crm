<div class="form-group">
    @if($type == 'long')
        <div class="row">
        <label class="col-sm-3 col-form-label text-right">{{ $title }}</label>
        <div class="col-sm-9">
    @endif
    <div class="box-image" style="{{ $width ? 'width:'.$width : '' }}">
        <img src="{{ asset($image) }}" class="img-responsive input-img {{ !$image ? 'hidden' : '' }}">
        <input type="file" 
            name="{{ $name }}" 
            accept="image/jpg,image/png,image/jpeg,image/webp"
            data-original-title="Thêm {{ $title }}" 
            class="form-control input-file">
        <div class="text-center">
            <a href="#" class="btn btn-primary btn-upload-file">
                <i class="feather icon-upload-cloud"></i>
            </a>
        </div>
    </div>
    @if($note)
        <label class="mark mt-2">Kích thước {{ $note }}</label>
    @endif

    @if($type == 'long')</div></div>@endif
</div>