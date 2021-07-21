<ul class="{{ isset($children) ? 'pcoded-submenu' : 'pcoded-item pcoded-left-item'}}">
    @foreach ($items as $item)
        @php
            $originalItem = $item;
            $isActive = null;   

            // Check if link is current
            if('/'.request()->path() == $item->url){
                $isActive = 'active';
            }
        @endphp

        <li class="{{ $isActive }} {{ !$originalItem->children->isEmpty() ? 'pcoded-hasmenu' : '' }}">
            <a href="{{!$originalItem->children->isEmpty() ? 'javascript:void(0)' : url($item->url)}}" target="{{ $item->target }}">
                <span class="pcoded-micon"><i class="{{ $item->icon_class }}"></i></span>
                <span class="pcoded-mtext">{{ $item->title }}</span>
            </a>
            @if(!$originalItem->children->isEmpty())
                @include('admin.menus.template.admin', ['items' => $originalItem->children, 'children' => true])
            @endif
        </li>
    @endforeach
</ul>
