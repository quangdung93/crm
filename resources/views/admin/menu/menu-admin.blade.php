<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{request()->is('*hita_enterprise') ? 'active' : ''}} pcoded-submenu">
                <a href="{{url('/hita_enterprise')}}">
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
        </ul>
    </div>
</nav>