@extends('admin.body')
@php
    $pageName = 'Người dùng';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    <section class="app-user-list">
        <!-- list section start -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="user-list-table table">
                    <thead class="thead-light">
                        <tr>
                            <th>Họ tên</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            <th>Trạng thái</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($users))
                            @foreach($users as $row)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-left align-items-center">
                                            <div class="avatar-wrapper">
                                                <div class="avatar mr-1"><img src="{{ $row->avatar ? asset($row->avatar) : asset('admin/images/default.png') }}" alt="Avatar" height="32" width="32" /></div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="#" class="user_name text-truncate"><span class="font-weight-bold">{{$row->name}}</span></a>
                                                <small class="emp_post text-muted">{{ '@'.$row->username }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->email}}</td>
                                    <td><span class="badge badge-pill badge-light-danger">{{ optional($row->roles->first())->display_name }}</span></td>
                                    <td>
                                        {!! $row->status ? '<span class="badge badge-pill badge-light-success">Hoạt động</span>' : '<span class="badge badge-pill badge-light-secondary">Ngừng hoạt động</span>' !!}
                                    </td>
                                    <td>
                                        @can('edit_users')
                                            <a class="" href="{{url($routeName.'/edit/'.$row->id)}}" title="Chỉnh sửa"> 
                                                <i data-feather="edit" class="font-medium-2 mr-1"></i>
                                            </a>
                                        @endcan

                                        @can('delete_users')
                                            <a class="notify-confirm" href="{{url($routeName.'/delete/'.$row->id)}}" title="Xóa"> 
                                                <i data-feather="delete" class="font-medium-2"></i>
                                            </a>
                                        @endcan
                                    </td>
                                    </form>
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
                    <form class="add-new-user modal-content pt-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo người dùng</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Họ tên</label>
                                <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nhập tên người dùng" name="user-fullname" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-uname">Username</label>
                                <input type="text" id="basic-icon-default-uname" class="form-control dt-uname" placeholder="acb" aria-label="jdoe1" aria-describedby="basic-icon-default-uname2" name="user-name" />
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" aria-describedby="basic-icon-default-email2" name="user-email" />
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-email">Mật khẩu</label>
                                <input type="password" id="basic-icon-default-email" value="" class="form-control dt-email" name="password" />
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="user-role">User Role</label>
                                <select id="user-role" class="form-control">
                                    @foreach($roles as $key => $value)
                                        <option value="{{ $value->name }}">{{ $value->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-1 data-submit">Lưu</button>
                            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Hủy bỏ</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal to add new user Ends-->
        </div>
        <!-- list section end -->
    </section>
@endsection

@section('javascript')
<script src="{{ asset('app-assets/js/scripts/pages/app-user-list.js') }}"></script>
<script type="text/javascript">
</script>
@endsection