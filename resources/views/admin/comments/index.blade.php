@extends('admin.body')
@php
    $pageName = 'Bình luận';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">{{ $pageName }}</h4>
                        <div class="dt-responsive table-responsive">
                            <table id="datatable" class="table stableweb-table center w100">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Điện thoại</th>
                                        <th>Nội dung</th>
                                        <th>Loại bình luận</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($comments)
                                        @foreach($comments as $row)
                                            <tr data-id="{{ $row->id }}">
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->phone }}</td>
                                                <td style="width:40%">{{ $row->message }}</td>
                                                <td>{{ $row->commentable_type }}</td>
                                                <td @cannot('edit_comments') class="prevent-event" @endcannot><input 
                                                        type="checkbox" 
                                                        class="js-single comment-status" 
                                                        {{ $row->status ? 'checked' : '' }} 
                                                    />
                                                </td>
                                                <td>
                                                    <a class="btn btn-success" href="{{ url(optional($row->commentable)->link()) }}" target="_blank"><i class="feather icon-eye" title="Xem"></i></a>
                                                    @can('delete_comments')
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
    $(document).ready(function(){

        $(document).on('change','.comment-status',function(){
            let active = 0;
            let id = $(this).closest('tr').data('id');

            if ($(this).is(':checked')) {
                active = 1;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '{{ route('comments.edit') }}',
                data: {id: id, active: active},
                success: function (response) {
                    if (response.status) {
                        if(active){
                            pushNotify('Đã xét duyệt bình luận!', text = '', type = 'success');
                        }
                        else{
                            pushNotify('Đã tắt bình luận!', text = '', type = 'success');
                        }
                    }
                }
            });
        });
    });
</script>
@endsection