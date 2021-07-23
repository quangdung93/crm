@extends('admin.body')
@php
    $pageName = 'Media';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <iframe src="{{ url('admin/media/filemanager') }}" style="width: 100%; height: 600px; overflow: hidden; border: none;"></iframe>
    </div>
    <!-- Page-body end -->
@endsection

@section('javascript')
<script type="text/javascript">
</script>
@endsection