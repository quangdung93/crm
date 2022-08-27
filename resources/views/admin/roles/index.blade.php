@extends('admin.body')
@php
    $pageName = 'Phân quyền';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    <section class="app-user-list">
        <!-- list section start -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatable-custom table">
                    <thead class="thead-light">
                        <tr>
                            <th>Tên quyền</th>
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
                                        @can('edit_users')
                                            <a class="" href="{{url(route('roles.update', ['id' => $row->id]))}}" title="Chỉnh sửa"> 
                                                <i data-feather="edit" class="font-medium-2 mr-1"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Modal to add new user starts-->
            <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                <div class="modal-dialog">
                    <form class="modal-content pt-0" action="{{ route('roles.create') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo nhóm quyền</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Tên nhóm quyền</label>
                                <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nhập tên nhóm quyền" name="name" aria-describedby="basic-icon-default-fullname2" />
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-uname">Tên hiển thị</label>
                                <input type="text" id="basic-icon-default-uname" class="form-control dt-uname" placeholder="admin"  aria-describedby="basic-icon-default-uname2" name="display_name" />
                            </div>
                            <button type="submit" class="btn btn-primary mr-1">Lưu</button>
                            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
<script type="text/javascript">
</script>
@endsection