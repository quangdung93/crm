<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{request()->is('*admin') ? 'active' : ''}} pcoded-submenu">
                <a href="{{url('/admin')}}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Tổng quan</span>
                </a>
            </li>
            @can('read_users')
            <li class="{{request()->is('*/users*') ? 'active' : ''}} pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                    <span class="pcoded-mtext">Người dùng</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{{ url('admin/users') }}">
                            <span class="pcoded-mtext">Danh sách người dùng</span>
                        </a>
                    </li>
                    @can('read_roles')
                    <li>
                        <a href="{{ url('admin/roles') }}">
                            <span class="pcoded-mtext">Phân quyền</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif

            @can('read_posts')
            <li class="{{request()->is('*/posts*') ? 'active' : ''}} pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                    <span class="pcoded-mtext">Bài viết</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{{ url('admin/category_posts') }}">
                            <span class="pcoded-mtext">Danh mục</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/posts') }}">
                            <span class="pcoded-mtext">Danh sách bài viết</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('read_settings')
            <li class="{{request()->is('*/tools*') ? 'active' : ''}} pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-sliders"></i></span>
                    <span class="pcoded-mtext">Công cụ</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('read_menus')
                    <li>
                        <a href="{{ url('admin/menus') }}">
                            <span class="pcoded-mtext">Menu</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('read_settings')
            <li class="{{request()->is('*/settings*') ? 'active' : ''}}">
                <a href="{{url('admin/settings')}}">
                    <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                    <span class="pcoded-mtext">Cấu hình</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</nav>