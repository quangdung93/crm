<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#">
                <i class="feather icon-menu"></i>
            </a>
            <a class="logo-admin" href="{{url('/')}}" target="_blank">
                <img class="img-fluid" width="40" src="{{asset(setting('admin_logo'))}}" alt="Theme-Logo">
                <span>{{ setting('admin_title') }}</span>
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="#!" onclick="toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">

                {{-- @include('hita_admin.notification.notify') --}}

                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset(Auth::user()->avatar)}}" class="img-radius" alt="user avatar">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut">
                            <li>
                                <a href="{{url('admin/users')}}">
                                    <i class="feather icon-user"></i> Thông tin <label class="code mb-0" style="padding:0 10px">{{ Auth::user()->roles->first()->display_name }}</label>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/setting')}}">
                                    <i class="feather icon-settings"></i> Cấu hình
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/logout')}}">
                                    <i class="feather icon-log-out"></i> Đăng xuất
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>