@extends('admin.body')
@php
    $pageName = 'Trang';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row ">
            @can('add_pages')
            <div class="col-sm-12">
                <div class="text-left mb-3">
                    <a href="{{url($routeName.'/create')}}" class="btn btn-primary"><i
                            class="feather icon-plus"></i> Thêm mới</a>
                </div>
            </div>
            @endcan
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">{{ $pageName }}</h4>
                        <div class="dt-responsive table-responsive">
                            <table id="datatable" class="table stableweb-table center w100">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên {{ $pageName }}</th>
                                        <th>Ngày tạo</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($pages)
                                        @foreach($pages as $row)
                                            <tr>
                                                <td><img width="70" src="{{ asset($row->image) }}" alt=""></td>
                                                <td> {{$row->name}} </td>
                                                <td>{{ format_date($row->created_at) }}</td>
                                                <td>
                                                    {!! $row->status ? '<label class="label label-success">Hoạt động</label>' : '<label class="label label-danger">Ngừng hoạt động</label>' !!}
                                                </td>
                                                <td>
                                                    @can('edit_pages')
                                                    <a class="btn btn-primary" href="{{url($routeName.'/edit/'.$row->id)}}" title="Chỉnh sửa"> <i class="feather icon-edit-1 "></i></a>
                                                    @endcan

                                                    @can('delete_pages')
                                                    <a href="{{url($routeName.'/delete/'.$row->id)}}" class="btn btn-danger notify-confirm" title="Xóa"> <i class="feather icon-trash-2"></i></a>
                                                    @endcan

                                                    <a class="btn btn-success" href="{{ url($row->link()) }}" target="_blank" title="Xem"> <i class="feather icon-eye"></i></a>
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