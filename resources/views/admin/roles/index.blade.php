@extends('admin.body')
@php
    $pageName = 'Phân quyền';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row ">
            <div class="col-sm-12">
                <div class="text-left mb-3">
                    <a href="{{url($routeName.'/create')}}" class="btn btn-primary"><i
                            class="feather icon-plus"></i> Thêm mới</a>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">Danh sách {{ $pageName }}</h4>
                        <div class="dt-responsive table-responsive">
                            <table id="datatable" class="table stableweb-table w100">
                                <thead>
                                    <tr>
                                        <th>Tên {{ $pageName }}</th>
                                        <th>Tên hiển thị</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($roles))
                                        @foreach($roles as $row)
                                            @if($row->name == config('permission.role_dev') 
                                            && !Auth::user()->hasRole(config('permission.role_dev')))
                                                @continue
                                            @endif
                                            <tr>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->display_name}}</td>
                                                <td>
                                                    <a class="btn btn-primary" href="{{url($routeName.'/edit/'.$row->id)}}" title="Chỉnh sửa"> <i class="feather icon-edit-1 "></i></a>
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