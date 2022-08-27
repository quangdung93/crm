@extends('admin.body')
@php
    $pageName = 'Người dùng';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                        <i data-feather="user"></i><span class="d-none d-sm-block">Tài khoản</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <form class="form-validate" action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    <!-- users edit media object start -->
                    <div class="media mb-2">
                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('admin/images/default.png') }}" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />
                        <div class="media-body mt-50">
                            <h4>{{ $user->name }}</h4>
                            <div class="col-12 d-flex mt-1 px-0">
                                <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                    <span class="d-none d-sm-block">Thay đổi</span>
                                    <input class="form-control" type="file" id="change-picture" name="input_file" value="" hidden accept="image/png, image/jpeg, image/jpg" />
                                    <span class="d-block d-sm-none">
                                        <i class="mr-0" data-feather="edit"></i>
                                    </span>
                                </label>
                                <button class="btn btn-outline-secondary d-none d-sm-block">Xóa</button>
                                <button class="btn btn-outline-secondary d-block d-sm-none">
                                    <i class="mr-0" data-feather="trash-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-1">
                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Thông tin tài khoản</span>
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" value="{{ $user->username }}" name="username" id="username" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Họ tên</label>
                                    <input type="text" class="form-control" placeholder="Họ tên" value="{{ $user->name }}" name="name" id="name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{ $user->email }}" name="email" id="email" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control select2" id="status">
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Ngừng hoạt động</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Quyền</label>
                                    <select class="form-control select2" name="role">
                                        <option value="0">Chọn quyền</option>
                                        @foreach($roles as $key => $value)
                                            <option value="{{ $value->name }}" {{ $value->name == optional($user->roles->first())->name ? 'selected' : "" }}>{{ $value->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company">Người quản lý</label>
                                    <select class="form-control select2" name="managers[]" multiple>
                                        <option value="0">Chọn người quản lý</option>
                                        @foreach($users as $key => $person)
                                            @continue($person->id == $user->id)
                                            <option value="{{ $person->id }}" {{ $user->managers && in_array($person->id, explode(',', $user->managers)) ? 'selected' : '' }}>
                                                {{ $person->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <h4 class="mb-1">
                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Thông tin cá nhân</span>
                                </h4>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="birth">Ngày sinh</label>
                                    <input id="birth" type="text" class="form-control birthdate-picker" value="{{ format_date($user->birthday) }}" name="dob" placeholder="Nhập ngày sinh (20-02-2000)" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Điện thoại</label> 
                                    <input id="mobile" type="text" class="form-control" value="{{ $user->phone }}" placeholder="Nhập số điện thoại" name="phone" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label class="d-block mb-1">Giới tính</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" value="1" name="gender" class="custom-control-input" {{ $user->gender ? 'checked' : '' }}/>
                                        <label class="custom-control-label" for="male">Name</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" value="0" name="gender" class="custom-control-input" {{ !$user->gender ? 'checked' : '' }}/>
                                        <label class="custom-control-label" for="female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4 class="mb-1 mt-2">
                                    <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Địa chỉ</span>
                                </h4>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="address" >{{ $user->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Lưu</button>
                                <button type="reset" class="btn btn-outline-secondary">Hủy bỏ</button>
                            </div>
                        </div>
                    <!-- users edit account form ends -->
                </div>
                <!-- Account Tab ends -->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script src="{{ asset('app-assets/js/scripts/pages/app-user-edit.js') }}"></script>
<script type="text/javascript">
</script>
@endsection