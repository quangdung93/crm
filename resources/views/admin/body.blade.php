@extends('admin.master')
@section('body')
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            {{-- Header --}}
            @include('admin.menu.header')
            {{-- End Header --}}

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    {{-- Menu --}}
                    @include('admin.menu.menu_admin')
                    {{-- End menu --}}

                    {{-- Main content --}}
                    @yield('content')
                    {{-- End Main content --}}

                </div>
            </div>
        </div>
    </div>
@endsection