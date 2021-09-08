@extends('admin.body')
@php
    $pageName = 'Nhật ký quản trị';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row ">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">{{ $pageName }}</h4>
                        <div class="dt-responsive table-responsive">
                            <table class="table stableweb-table center w100">
                                <thead>
                                    <tr>
                                        <th>Trường có thay đổi</th>
                                        <th>Trước chỉnh sửa</th>
                                        <th></th>
                                        <th>Sau chỉnh sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $new = $log->new;
                                        $old = $log->old;
                                        $changed = $log->changed;
                                    @endphp

                                    @if($changed)
                                        @foreach($changed as $key => $value)
                                            @if(!in_array($key, \App\Models\Log::HIDDEN_LOG))
                                            <tr>
                                                <td><label class="code">{{ $key }}</label></td>
                                                <td>{!! handle_show_attribute($key, $old[$key], $log->logable_type) !!}</td>
                                                <td>
                                                    <label class="label label-primary">
                                                        <i class="feather icon-arrow-right"></i>
                                                    </label>
                                                </td>
                                                <td>{!! handle_show_attribute($key, $value, $log->logable_type) !!}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-body end -->
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>
@endsection