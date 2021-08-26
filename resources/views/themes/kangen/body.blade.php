@extends('themes.kangen.master')
@section('body')
    <div id="main">
        @include('themes.kangen.header')
        @yield('content')
    </div>
@endsection