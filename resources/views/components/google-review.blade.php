@if(!empty($model))
<div class="card">
    <div class="card-block">
        <h4 class="sub-title">Google</h4>
        <div class="google-review">
            <div class="google-url">{{ $model->link() }}</div>
            <div class="google-title">{{ $model->meta_title ? $model->meta_title : $model->name }}</div>
            <div class="google-description">{{ $model->meta_description }}</div>
        </div>
    </div>
</div>
@endif