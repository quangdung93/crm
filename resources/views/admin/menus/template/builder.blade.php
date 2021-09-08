<ol class="dd-list">

@foreach ($items as $item)

    <li class="dd-item" data-id="{{ $item->id }}">
        <div class="pull-right item_actions">
            @can('delete_menus')
                <a href="{{ url(route('menus.item.delete', ['id' => $item->id])) }}" class="btn btn-sm btn-danger pull-right notify-confirm">
                    <i class="feather icon-trash-2"></i> Xóa
                </a>
            @endcan

            @can('edit_menus')
                <div class="btn btn-sm btn-primary pull-right edit"
                    data-id="{{ $item->id }}"
                    data-title="{{ $item->title }}"
                    data-type="{{ $item->type }}"
                    data-url="{{ $item->url }}"
                    data-permission="{{ $item->permission }}"
                    data-target="{{ $item->target }}"
                    data-icon_class="{{ $item->icon_class }}"
                    data-css_class="{{ $item->css_class }}">
                    <i class="feather icon-edit"></i> Sửa
                </div>
            @endcan
        </div>
        <div class="dd-handle">
            <span>{{ $item->title }}</span> <small class="url"></small>
        </div>
        @if(!$item->children->isEmpty())
            @include('admin.menus.template.builder', ['items' => $item->children])
        @endif
    </li>

@endforeach

</ol>