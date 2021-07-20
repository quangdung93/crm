@extends('admin.body')
@php
    $pageName = 'Danh mục bài viết';
    $routeName = getCurrentSlug();
@endphp
@section('content')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            @can('add_posts')
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
                                        <th>STT</th>
                                        <th>Tên {{ $pageName }}</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($category_posts)
                                        @foreach($category_posts as $row)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$row->name}}</td>
                                                <td>
                                                    {!! $row->status ? '<label class="label label-success">Hiển thị</label>' : '<label class="label label-danger">Ẩn</label>' !!}
                                                </td>
                                                <td>
                                                    @can('edit_posts')
                                                    <a class="btn btn-primary" href="{{url($routeName.'/edit/'.$row->id)}}" title="Chỉnh sửa"> <i class="feather icon-edit-1 "></i></a>
                                                    @endcan

                                                    @can('delete_posts')
                                                    <a class="btn btn-danger" href="{{url($routeName.'/delete/'.$row->id)}}" onclick="return confirm('Bạn có muốn xóa dòng này?')" title="Xóa"> <i class="feather icon-trash-2"></i></a>
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