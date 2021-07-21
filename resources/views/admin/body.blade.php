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
            @include('admin.navbar.header')
            {{-- End Header --}}

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    {{-- Menu --}}
                    @include('admin.navbar.menu-admin')
                    {{-- End menu --}}

                    {{-- Main content --}}
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    {{-- Content --}}
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Main content --}}

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Alert --}}
@include('admin.components.alert')