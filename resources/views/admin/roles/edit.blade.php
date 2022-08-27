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
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                        <i data-feather="lock"></i><span class="d-none d-sm-block">Chỉnh sửa quyền</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    <!-- users edit account form start -->
                    <form class="form-validate" action="{{ route('roles.update', ['id' => $role->id]) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-1">
                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Thông tin phân quyền</span>
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username">Tên nhóm quyền</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên nhóm quyền" value="{{  $role->name }}" name="name" id="name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Tên hiển thị</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên hiển thị" value="{{ $role->display_name }}" name="display_name" id="display_name" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="table-responsive border rounded mt-1">
                                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                        <span class="align-middle">Phân quyền</span>
                                    </h6>
                                    <table class="table table-striped table-borderless">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Chức năng</th>
                                                <th>Xem</th>
                                                <th>Thêm</th>
                                                <th>Sửa</th>
                                                <th>Xóa</th>
                                                <th>Tất cả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions as $key => $permission)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                @foreach($permission as $value)
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" 
                                                        name="permission[{{ $value->id }}]" 
                                                        id="{{ $value->name }}" 
                                                        class="checkbox-item custom-control-input" 
                                                        {{ $role->permissions->pluck('id')->contains($value->id) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="{{ $value->name }}"></label>
                                                    </div>
                                                </td>
                                                @endforeach
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="all_{{ $value->name }}" class="check-all custom-control-input">
                                                        <label class="custom-control-label" for="all_{{ $value->name }}"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Lưu</button>
                                <button type="reset" class="btn btn-outline-secondary">Hủy bỏ</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
                <!-- Account Tab ends -->
            </div>
        </div>
    </div>
</section>
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