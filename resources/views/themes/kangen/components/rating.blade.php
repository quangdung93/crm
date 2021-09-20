<div class="rating" 
    data-action="{{ route('ratings.increment') }}" 
    data-model="{{ get_class($model) }}"
    data-id="{{ $model->id }}"
>
    <div class="star-box">
        <i class="feather icon-star active"></i>
        <i class="feather icon-star active"></i>
        <i class="feather icon-star active"></i>
        <i class="feather icon-star active"></i>
        <i class="feather icon-star active"></i>
    </div>
    <div class="text">
        Có (<span>{{ $model->rating_count }}</span>) đánh giá
    </div>
</div>