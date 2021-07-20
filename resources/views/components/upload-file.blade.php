<div class="card">
    <div class="card-block">
        <h4 class="sub-title">{{ $title }}</h4>
        <div class="form-group">
            <img src="{{ asset($image) }}" id="input_img" class="img-responsive {{ !$image ? 'hidden' : '' }}"
                style="border-radius:3px;border:1px solid #ddd;margin-bottom:5px;width:100%">
            <input type="file" class="form-control" id="input_file"
                name="input_file" accept="image/jpg,image/png,image/jpeg,image/webp,image/jpf"
                data-original-title="Thêm {{ $title }}" style="overflow: hidden;display:none">
            <div class="text-center">
                <a href="#" id="btn-upload-file" class="btn btn-primary"><i class="feather icon-upload-cloud"></i></a>
            </div>
        </div>
        <div class="text-center"><label class="mark">Kích thước ({{ $width }} x {{ $height }})</label></div>
    </div>
</div>