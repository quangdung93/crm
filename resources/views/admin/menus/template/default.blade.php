<ul class="{{ isset($children) ? 'sub-menu' : ''}}">
@foreach ($items as $item)
    <li class="{{ $item->children->isNotEmpty() ? 'has-submenu' : '' }}">
        <a href="{{ url($item->url) }}" target="{{ $item->target }}">
            <span>{{ $item->title }}</span>
            @if($item->children->isNotEmpty())
                <span class="icon-show"><i class="feather icon-chevron-down"></i></span>
            @endif
        </a>
        @if($item->children->isNotEmpty())
            @include('admin.menus.template.default', ['items' => $item->children, 'children' => true])
        @endif
    </li>
@endforeach
</ul>