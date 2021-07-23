<ul class="{{ isset($children) ? 'pcoded-submenu' : 'pcoded-item pcoded-left-item'}}">
    @foreach ($items as $item)
        @php
            $isActive = null;

            // Check if link is current
            if($item->url == '/'.request()->path()){
                $isActive = 'active';
            }

        @endphp

        @if(!$item->permission || $item->permission && \Auth::user()->can($item->permission))
            <li class="{{ $isActive }} {{ $item->children->isNotEmpty() ? 'pcoded-hasmenu' : '' }}">
                <a href="{{ $item->children->isNotEmpty() ? 'javascript:void(0)' : url($item->url)}}" target="{{ $item->target }}">
                    <span class="pcoded-micon"><i class="{{ $item->icon_class }}"></i></span>
                    <span class="pcoded-mtext">{{ Str::limit($item->title, 20) }}</span>
                </a>
                @if($item->children->isNotEmpty())
                    @include('admin.menus.template.admin', ['items' => $item->children, 'children' => true])
                @endif
            </li>
        @endif
    @endforeach
</ul>
