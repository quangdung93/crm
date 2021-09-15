@extends('admin.body')
@php
    $pageName = 'Chuyển hướng trang';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            @can('add_redirects')
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
                                        <th>Đường dẫn gốc</th>
                                        <th>Đường dẫn đích</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($redirects)
                                        @foreach($redirects as $row)
                                            <tr>
                                                <td style="width:40%; text-align:left"><a href="{{ url($row->from_url) }}" target="_blank">{{ $row->from_url }}</a></td>
                                                <td style="width:40%; text-align:left"><a href="{{ url($row->to_url) }}" target="_blank">{{ $row->to_url }}</a></td>
                                                <td>
                                                    @can('edit_redirects')
                                                    <a class="btn btn-primary" href="{{url($routeName.'/edit/'.$row->id)}}" title="Chỉnh sửa"> <i class="feather icon-edit-1 "></i></a>
                                                    @endcan

                                                    @can('delete_redirects')
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