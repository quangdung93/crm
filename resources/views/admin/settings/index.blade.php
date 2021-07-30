@extends('admin.body')
@php
    $pageName = 'Cấu hình';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        @role(config('permission.role_dev'))
            <div class="col-sm-12 mb-3">
                <a href="#" id="add-setting" class="btn btn-primary"><i class="feather icon-plus-circle"></i> Thêm cấu hình</a>
            </div>
        @endrole
        <div class="panel-body">
            <form class="form-horizontal" action="{{url($routeName)}}" method="POST" role="form"
                enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @php
                    $groupSetting = $settings->groupBy('group');
                @endphp

                <ul class="nav nav-tabs md-tabs" role="tablist">
                    @foreach($groupSetting as $group => $settings)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->iteration == 1 ? 'active' : ''}}" data-toggle="tab" href="#{{ $group }}{{ $loop->iteration }}" role="tab" aria-expanded="true">
                                <i class="feather icon-globe"></i> {{ $group }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content card-block p-0">
                @foreach($groupSetting as $group => $settings)
                    <div class="tab-pane {{ $loop->iteration == 1 ? 'active' : ''}}" id="{{ $group }}{{ $loop->iteration }}" role="tabpanel" aria-expanded="true">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">{{ $pageName }} {{ $group }}</h4>
                                        <div class="sortable">
                                            @foreach($settings->sortBy('order') as $setting)
                                                <div class="item bg-white" data-id="{{ $setting->id }}">
                                                    @if($setting->type == 'text')
                                                        <x-input 
                                                        type="text" 
                                                        :title="$setting->display_name" 
                                                        :name="$setting->key" 
                                                        value="{{ $setting->value ?? '' }}" />
                                                    @elseif($setting->type == 'image')
                                                        <x-upload-file
                                                        type="long"
                                                        :title="$setting->display_name" 
                                                        :name="$setting->key"
                                                        image="{{ $setting->value ?? '' }}"
                                                        width="100px" />
                                                    @endif
                                                    @role(config('permission.role_dev'))
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 text-right">
                                                                <label class="label label-info pointer-move"><i class="feather icon-move"></i></label>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <a href="{{ route('settings.delete',['id' => $setting->id]) }}" class="text-danger notify-confirm remove-setting">
                                                                    <i class="feather icon-trash-2"></i> Xóa
                                                                </a>
                                                                <label class="code mb-0">{{ $setting->key }}</label>
                                                            </div>
                                                        </div>
                                                    @endrole
                                                    <hr>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary btn-label-left">
                            <span><i class="feather icon-save"></i></span>
                            Lưu cấu hình
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Page-body end -->

<div class="modal modal-info fade" tabindex="-1" id="setting-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="m_hd_add" class="modal-title"><i class="feather icon-plus-circle"></i> Thêm cấu hình</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Đóng"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('settings.add') }}" id="m_form" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên hiển thị</label>
                        <input type="text" value="{{ old('display_name') }}" class="form-control" id="m_title" name="display_name" placeholder="Nhập tên hiển thị" required>
                        @if ($errors->has('display_name'))
                            <div class="text-danger mt-2">{{ $errors->first('display_name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Key</label>
                        <input type="text" value="{{ old('key') }}" class="form-control" id="m_title" name="key" placeholder="Nhập key" required>
                        @if ($errors->has('key'))
                            <div class="text-danger mt-2">{{ $errors->first('key') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="type">Loại cấu hình</label>
                        <select id="m_type" class="form-control" name="type">
                            <option value="text" selected="selected">Text</option>
                            <option value="image">Image</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="selectbox">Selectbox</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung</label>
                        <textarea class="form-control" name="details"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="group">Nhóm cấu hình</label>
                        <select id="m_group" class="form-control" name="group">
                            <option value="site" selected="selected">Website</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success pull-right" value="Lưu">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('javascript')
<script>
    $(document).ready(function(){

        //Show popup when validate errors
        @if($errors->any())
            $('#setting-modal').modal('show');
        @endif

        $('#add-setting').click(function() {
            $('#m_form').trigger('reset');
            $('#setting-modal').modal('show');
        });

        $('.sortable').each(function(){
            Sortable.create($(this)[0], {
                handle: ".feather.icon-move",
                animation: 0,
                onEnd: function (evt) {
                    var data_sort = evt.from;
                    let order = [];

                    $(data_sort).find('.item').each(function(){
                        order.push({id: $(this).data('id'), order: $(this).index() + 1});
                    });

                    $.post('{{ route('settings.order') }}', {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    }, function (data) {
                        data.status && pushNotify('Cập nhật thành công!', text = '', type = 'success');
                    });
                }
            })
        });

        $('.sortable .item').each(function(index, value) {
            $(this).find('.sequence').val(index + 1);
        });
        
    });
</script>
@endsection