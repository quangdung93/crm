<ul>
@foreach ($items as $item)
    @php
        $originalItem = $item;
        $isActive = null;
        $styles = null;
        $icon = null;

        // Check if link is current
        if(url($item->link()) == url()->current()){
            $isActive = 'active';
        }

        // Set Icon
        if(isset($options->icon) && $options->icon == true){
            $icon = '<i class="' . $item->icon_class . '"></i>';
        }
    @endphp

    <li class="{{ $isActive }}">
        <a href="{{ url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}">
            {!! $icon !!}
            <span>{{ $item->title }}</span>
        </a>
        @if(!$originalItem->children->isEmpty())
            @include('admin.menus.template.default', ['items' => $originalItem->children, 'options' => $options])
        @endif
    </li>
@endforeach
</ul>
