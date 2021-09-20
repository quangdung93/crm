@extends('admin.body')
@php
    $pageName = 'Phân quyền';
    $routeName = getCurrentSlug();
@endphp
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets\icon\icofont\css\icofont.css')}}">
@endsection
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body panels-wells">
        <form class="form-horizontal" method="post"
                            action="{{url($routeName)}}" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">Thông tin {{ $pageName }}</h4>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right">Tên quyền</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control" placeholder="Nhập tên quyền" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right">Tên hiển thị</label>
                            <div class="col-sm-6">
                                <input type="text" name="display_name" value="{{ $role->display_name }}" class="form-control" placeholder="Nhập tên hiển thị" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">{{ $pageName }}</h4>
                        <div class="form-group row">
                            <div class="col-sm-12 mt-2">
                                <div class="dt-responsive table-responsive">
                                    <table class="table stableweb-table center w100">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Tên quyền</th>
                                                <th>Đọc</th>
                                                <th>Thêm</th>
                                                <th>Sửa</th>
                                                <th>Xóa</th>
                                                <th>Tất cả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions as $key => $permission)
                                                <tr>
                                                    <td class="text-capitalize text-left" style="width:15%">{{ $key }}</td>
                                                    @foreach($permission as $value)
                                                        <td class="text-center">
                                                            <div class="checkbox-zoom zoom-primary m-0">
                                                                <label>
                                                                    <input type="checkbox" name="permission[{{ $value->id }}]" id="{{ $value->name }}" class="checkbox-item" {{ $role->permissions->pluck('id')->contains($value->id) ? 'checked' : '' }}>
                                                                    <span class="cr">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                    {{-- <span>Primary</span> --}}
                                                                </label>
                                                            </div>
                                                        </td>
                                                        {{-- <td><input type="checkbox" name="permission[{{ $value->id }}]" id="{{ $value->name }}" class="checkbox-item" {{ $role->permissions->pluck('id')->contains($value->id) ? 'checked' : '' }}/></td> --}}
                                                    @endforeach
                                                    <td class="text-center">
                                                        <div class="checkbox-zoom zoom-danger m-0">
                                                            <label>
                                                                <input type="checkbox" class="check-all">
                                                                <span class="cr">
                                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <x-submit-button :route="$routeName"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Page-body end -->
@endsection
@section('javascript')
<script type="text/javascript">
    $('table tbody tr').each(function(){
        if($(this).find('.checkbox-item:checked').length == 4){
            $(this).find('.check-all').prop('checked',true);
        }
    });

    $(document).on('click', '.check-all', function(){
        if($(this).is(':checked')){
            $(this).closest('tr').find('.checkbox-item').prop('checked',true);
        }
        else{
            $(this).closest('tr').find('.checkbox-item').prop('checked',false);
        }
    });

    $(document).on('click', '.checkbox-item', function(){
        let check_all = $(this).closest('tr').find('.check-all');

        if(!$(this).is(':checked')){
            check_all.is(':checked') && check_all.prop('checked',false);
        }
        else{
            let count_checked = $(this).closest('tr').find('.checkbox-item:checked').length;
            count_checked == 4 && check_all.prop('checked',true);
        }
    })
</script>
@endsection