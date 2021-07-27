@extends('admin.body')
@php
    $pageName = 'Người dùng';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row ">
            @can('add_users')
            <div class="col-sm-12">
                <div class="text-right mb-20">
                    <a href="{{url($routeName.'/create')}}" class="btn btn-primary"><i
                            class="feather icon-plus"></i> Thêm mới</a>
                </div>
            </div>
            @endcan
            <div class="col-sm-12 mt-2">
                <div class="panel panel-primary">
                    <div class="panel-heading bg-primary">{{ $pageName }}</div>
                    <div class="panel-body p-2">
                        <div class="dt-responsive table-responsive">
                            <table id="datatable" class="table table-striped table-bordered w100">
                                <thead>
                                    <tr>
                                        <th>Tên {{ $pageName }}</th>
                                        <th>Email</th>
                                        <th>Quyền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($users))
                                        @foreach($users as $row)
                                            <tr>
                                                <td><img width="40" style="border-radius:50%;margin-right:10px" src="{{ asset($row->avatar) }}" alt="User avatar"> {{$row->name}} </td>
                                                <td>{{$row->email}}</td>
                                                <td>{{ optional($row->roles->first())->display_name }}</td>
                                                <td>
                                                    {!! $row->status ? '<label class="label label-success">Hoạt động</label>' : '<label class="label label-danger">Ngừng hoạt động</label>' !!}
                                                </td>
                                                <td>
                                                    @can('edit_users')
                                                    <a class="btn btn-primary" href="{{url($routeName.'/edit/'.$row->id)}}" title="Chỉnh sửa"> <i class="feather icon-edit-1 "></i></a>
                                                    @endcan

                                                    @can('delete_users')
                                                    <a class="btn btn-danger notify-confirm" href="{{url($routeName.'/delete/'.$row->id)}}" title="Xóa"> <i class="feather icon-trash-2"></i></a>
                                                    @endcan
                                                </form>
                                                </td>
                                            </tr>
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
</script>
@endsection