<div class="siderbar-item">
    <div class="siderbar-title">{{ $title }}</div>
    <div class="siderbar-content">
        @foreach($posts as $item)
            <div class="item">
                <a href="{{ url($item->link()) }}">
                    <div class="image lazy" data-src="&#39;{{asset($item->image)}}&#39;"></div>
                </a>
                <div class="content">
                    <a href="{{ url($item->link()) }}">{{ $item->name }}</a>
                </div>
            </div>
        @endforeach
    </div>
</div>