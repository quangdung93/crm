@extends('auth.index')
@section('content')
<div class="bg-black"></div>
<section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        <form action="{{route('login')}}" method="post" id="login-form" class="md-float-material form-material">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="text-center">
                                <img class="logo-login" width="50" src="{{asset('admin\images\logo.png')}}" alt="">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    @if (Session::has('login_failed'))
                                        <div class="alert alert-danger">
                                            {{session('login_failed')}}
                                        </div>
                                    @endif
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Đăng nhập</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="username" class="form-control" value="{{ old('username') }}"  placeholder="Tên đăng nhập" autofocus>
                                        <span class="form-bar"></span>
                                        @if ($errors->has('username'))
                                            <div class="text-danger mt-2">{{ $errors->first('username') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control"  placeholder="Mật khẩu">
                                        <span class="form-bar"></span>
                                        @if ($errors->has('password'))
                                            <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary w-100 text-center">
                                                <label class="remember-save">
                                                    <input type="checkbox" name="remember" checked="" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Lưu đăng nhập</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" id="btnSubmit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center">Đăng nhập</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>
@endsection
