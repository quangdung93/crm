@extends('admin.body')
@php
    $pageName = 'Khách hàng';
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
                <form class="form-validate" action="{{url($routeName)}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- Account Tab starts -->
                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                    <!-- users edit media object start -->
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-1">
                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                    <span class="align-middle">Thông tin khách hàng</span>
                                </h4>
                            </div>
                            <div class="col-sm-4">
                                <x-selectbox 
                                    title="Loại KH" 
                                    name="customer_group" 
                                    :lists="[
                                        [
                                            'id' => '1',
                                            'name' => 'Khách lẻ',
                                        ],
                                        [
                                            'id' => '2',
                                            'name' => 'Khách sỉ',
                                        ]
                                    ]" 
                                    value="id" 
                                    display="name" 
                                    selected="{{ $customer->customer_group ?? '' }}"
                                />
                            </div>
                            <div class="col-sm-4">
                                <x-input type="text" :title="'Tên '.$pageName" name="name" value="{{ $customer->name ?? ''  }}"/>
                            </div>
                            <div class="col-sm-4">
                                <x-input type="text" title="Mã khách hàng" name="customer_code" value="{{ $customer->customer_code ?? ''  }}"/>
                            </div>
                            <div class="col-sm-4">
                                <x-input type="text" title="Điện thoại" name="phone" value="{{ $customer->phone ?? ''  }}"/>
                            </div>
                            <div class="col-sm-4">
                                <x-input type="text" title="Email" name="email" value="{{ $customer->email ?? ''  }}"/>
                            </div>
                            <div class="col-sm-4">
                                <x-input type="text" title="Ngày sinh" name="birthday" value="{{ $customer->birthday ?? ''  }}"/>
                            </div>
                            {{-- @dd($provinces) --}}
                            <div class="col-sm-4">
                                <x-selectbox 
                                    title="Tỉnh/thành phố" 
                                    name="province_id" 
                                    :lists="$provinces" 
                                    value="id" 
                                    display="name"
                                    selected="{{ $customer->province_id ?? '' }}"
                                    id="provinces"
                                />
                            </div>
                            <div class="col-sm-4">
                                <label for="name">Quận/huyện</label>
                                <div class="form-group">
                                    <div class="checkout-select">
                                        <select id="districts" name="district_id" class="form-control select2">
                                            <option value="">Chọn quận/huyện</option>
                                        </select>
                                        <div class="error text-danger mt-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="name">Phường/xã</label>
                                <div class="form-group">
                                    <div class="checkout-select">
                                        <select id="wards" name="ward_id" class="form-control select2">
                                            <option value="">Chọn phường/xã</option>
                                        </select>
                                        <div class="error text-danger mt-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <x-textarea type="" title="Địa chỉ" name="address" value="{{ $customer->address ?? ''  }}" />
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="d-block mb-1">Giới tính</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" value="1" name="gender" class="custom-control-input" {{ !@$customer->gender ? 'checked' : '' }}/>
                                        <label class="custom-control-label" for="male">Name</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" value="0" name="gender" class="custom-control-input" {{ @$customer->gender ? 'checked' : '' }}/>
                                        <label class="custom-control-label" for="female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <x-textarea type="" title="Tình trạng da" name="note_skin" value="{{ $customer->note_skin ?? ''  }}" />
                            </div>
                            <div class="col-sm-6">
                                <x-textarea type="" title="Tính cách" name="note_genitive" value="{{ $customer->note_genitive ?? ''  }}" />
                            </div>
                            <div class="col-12 d-flex flex-sm-row justify-content-end flex-column mt-2">
                                <button type="reset" class="btn btn-outline-secondary mr-sm-1">Hủy bỏ</button>
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0">Lưu</button>
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
{{-- <script src="{{ asset('app-assets/js/scripts/pages/app-user-edit.js') }}"></script> --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#provinces').on('change', function () {
            let province_id = this.value;
            console.log(province_id);
            if (!province_id) {
                return false;
            }

            loadDistrict(province_id);
        });

        $('#districts').on('change', function () {
            let district_id = this.value;
            if (!district_id) {
                return false;
            }

            loadWards(district_id);
        });

        function loadDistrict(province_id){
            $.get('/province/' + province_id, function (result) {
                if (result.error == 0) {
                    $('#districts').empty();
                    $('#districts').append(result.data);
                    $("#districts").trigger("chosen:updated");
                } else {
                    alert(result.message.title);
                }
            });
        }

        function loadWards(district_id){
            $.get('/district/' + district_id, function (result) {
                if (result.error == 0) {
                    $('#wards').empty();
                    $('#wards').append(result.data);
                    $("#wards").trigger("chosen:updated");
                } else {
                    alert(result.message.title);
                }
            });
        }
    });
</script>
@endsection