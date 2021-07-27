@extends('admin.body')
@php
    $pageName = 'Menu';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row ">
            <div class="col-sm-12">
                <div class="text-right mb-20">
                    <a href="{{url($routeName.'/create')}}" class="btn btn-primary"><i
                            class="feather icon-plus"></i> Thêm mới</a>
                </div>
            </div>
            <div class="col-sm-12 mt-2">
                <div class="panel panel-primary">
                    <div class="panel-heading bg-primary">Danh sách {{ $pageName }}</div>
                    <div class="panel-body p-2">
                        <div class="dt-responsive table-responsive">
                            <table id="datatable" class="table table-striped table-bordered w100">
                                <thead>
                                    <tr>
                                        <th>Tên {{ $pageName }}</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($menus))
                                        @foreach($menus as $row)
                                            <tr>
                                                <td>{{$row->name}}</td>
                                                <td>
                                                    @can('edit_menus')
                                                    <a class="btn btn-info" href="{{url($routeName.'/builder/'.$row->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Sửa menu"> <i class="feather icon-sliders"></i></a>
                                                    <a class="btn btn-primary" href="{{url($routeName.'/edit/'.$row->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Chỉnh sửa"> <i class="feather icon-edit-1"></i></a>
                                                    @endcan

                                                    @role(config('permission.role_dev'))
                                                        <a class="btn btn-danger notify-confirm" href="{{url($routeName.'/delete/'.$row->id)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Xóa"> <i class="feather icon-trash-2"></i></a>
                                                    @endrole
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
