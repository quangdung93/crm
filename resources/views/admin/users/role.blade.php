@extends('admin.body')
@php
    $pageName = 'quyền';
    $routeName = 'roles';
    dd(Request::path())
@endphp
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/admin')}}"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/'.$routeName)}}">Danh sách {{ $pageName }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row ">
                        <div class="col-sm-12">
                            <div class="text-right mb-20">
                                <a href="{{url('hita_enterprise/'.$routeName.'/create')}}" class="btn btn-primary"><i
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
                                                    <th>STT</th>
                                                    <th>Tên {{ $pageName }}</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($roles))
                                                    @foreach($roles as $row)
                                                        <tr>
                                                            <td>{{$loop->index + 1}}</td>
                                                            <td>{{$row->name}}</td>
                                                            <td>
                                                                <a class="btn btn-primary" href="{{url('admin/'.$routeName.'/edit/'.$row->id)}}" title="Chỉnh sửa"> <i class="feather icon-edit-1 "></i></a>
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
            </div>
        </div>
        <!-- Main-body end -->
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
</script>
@endsection