@extends('admin.body')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/menu.css')}}">
@endsection
@php
    $pageName = 'Menu';
    $routeName = getCurrentSlug();
@endphp
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="panel-body">
            <div class="row mb-3">
                @can('add_menus')
                    <div class="col-sm-12">
                        <div class="text-right">
                            <a href="#" id="add-menu-item-custom" class="btn btn-primary"><i class="feather icon-plus-circle"></i> Thêm liên kết tùy chỉnh</a>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="sub-title">Thành phần {{ $pageName }}</h4>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label font-weight-bold">Danh mục bài viết</label>
                                <div class="col-sm-10">
                                    <select class="form-control populate select2">
                                        <option value="0">Chọn danh mục bài viết</option>
                                        @if($category_posts)
                                            @foreach($category_posts as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @can('add_menus')
                                <div class="col-sm-2 pl-0">
                                    <div class="btn btn-success mt-1 add-menu-item" data-type="post_category"><i class="feather icon-arrow-right"></i></div>
                                </div>
                                @endcan
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label font-weight-bold">Bài viết</label>
                                <div class="col-sm-10">
                                    <select class="form-control populate select2">
                                        <option value="0">Chọn bài viết</option>
                                        @if($posts)
                                            @foreach($posts as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @can('add_menus')
                                <div class="col-sm-2 pl-0">
                                    <div class="btn btn-success mt-1 add-menu-item" data-type="posts"><i class="feather icon-arrow-right"></i></div>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="sub-title">{{ $pageName }} ({{ $menu->name }})</h4>
                            <div class="dd">
                                {!! menu($menu->name, 'admin') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Page-body end -->

<div class="modal modal-info fade" tabindex="-1" id="menu-item-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="m_hd_add" class="modal-title hidden"><i class="feather icon-plus-circle"></i> Thêm liên kết tùy chỉnh</h5>
                <h5 id="m_hd_edit" class="modal-title hidden"><i class="feather icon-edit"></i> Sửa mục menu</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Đóng"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="m_form" method="POST"
                    data-action-add="{{ route('menus.item.addcustom') }}"
                    data-action-update="{{ route('menus.item.update', ['id' => $menu->id]) }}">

                {{ csrf_field() }}
                <div class="modal-body">
                    <div>
                        <label for="name">Tên hiển thị</label>
                        <input type="text" class="form-control" id="m_title" name="title" placeholder="Tên hiển thị" required><br>
                    </div>
                    <div>
                        <label for="name">Đường dẫn</label>
                        <input type="text" class="form-control" id="m_url" name="url" placeholder="Đường dẫn" required><br>
                    </div>
                    <div>
                        <label for="name">Class icon</label>
                        <input type="text" class="form-control" id="m_icon_class" name="icon_class" placeholder="Class icon"><br>
                    </div>
                    <div>
                        <label for="name">Class CSS</label>
                        <input type="text" class="form-control" id="m_css_class" name="css_class" placeholder="Class CSS"><br>
                    </div>
                    <label for="target">Mở bằng</label>
                    <select id="m_target" class="form-control" name="target">
                        <option value="_self" selected="selected">Chuyển hướng</option>
                        <option value="_blank">Mở tab mới</option>
                    </select>
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    <input type="hidden" name="id" id="m_id" value="">
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
        $('.dd').nestable({
            expandBtnHTML: '',
            collapseBtnHTML: ''
        });

        var $m_modal       = $('#menu-item-modal'),
            $m_hd_add      = $('#m_hd_add').hide().removeClass('hidden'),
            $m_hd_edit     = $('#m_hd_edit').hide().removeClass('hidden'),
            $m_form        = $('#m_form'),
            $m_title       = $('#m_title'),
            $m_url         = $('#m_url'),
            $m_icon_class  = $('#m_icon_class'),
            $m_css_class   = $('#m_css_class'),
            $m_color       = $('#m_color'),
            $m_target      = $('#m_target'),
            $m_id          = $('#m_id');

        /**
        * Delete menu item
        */
        $('.item_actions').on('click', '.delete', function (e) {
            if(confirm('Bạn có muốn xóa menu này?')){
                let self = $(this),
                    id = $(this).data('id');
                $.get(URL_MAIN + 'admin/menus/item/delete/' + id, function (data) {
                    if(data.status){
                        pushNotify('Xóa thành công!', text = '', type = 'success');
                        window.location.reload();
                    }
                });
            }
        });

        /**
        * Add Menu
        */
        $(document).on('click', '.add-menu-item', function(){
            let type = $(this).data('type'),
                selecbox = $(this).closest('.form-group').find('select'),
                selecbox_value = selecbox.val();
            if(selecbox_value == 0){
                pushNotify('Bạn chưa chọn giá trị!', text = '', type = 'danger');
                return;
            }
            
            $.post('{{ route('menus.item.add') }}', {
                menu_id: '{{ $menu->id }}',
                type: type,
                value_item: selecbox_value,
                _token: '{{ csrf_token() }}'
            }, function (data) {
                if(data.status){
                    pushNotify('Thêm menu thành công!', text = '', type = 'success');
                    window.location.reload();
                }
                else{
                    pushNotify('Thêm menu thất bại!', text = '', type = 'important');
                }
            });
        })

        $('#add-menu-item-custom').click(function() {
            $m_form.trigger('reset');
            $m_modal.modal('show', {data: null});
        });

        $('.item_actions').on('click', '.edit', function (e) {
            $m_modal.modal('show', {data: $(e.currentTarget)});
        });


        $m_modal.on('show.bs.modal', function(e, data) {
            let add_mode = e.relatedTarget.data ? false : true;

            if(add_mode){
                $m_form.attr('action', $m_form.data('action-add'));
                $m_hd_add.show();
                $m_hd_edit.hide();
                $m_target.val('_self').change();
                $m_url.val('');
                $m_icon_class.val('');
                $m_css_class.val('');
            }
            else{
                $('#m_form').attr('action', $('#m_form').data('action-update'));
                $m_hd_add.hide();
                $m_hd_edit.show();

                var _src = e.relatedTarget.data, // the source
                    id   = _src.data('id');

                $m_title.val(_src.data('title'));
                $m_url.val(_src.data('url'));
                $m_icon_class.val(_src.data('icon_class'));
                $m_css_class.val(_src.data('css_class'));
                $m_id.val(id);

                /**
                * Prevent edit url
                */
                //if(_src.data('type') != 'custom'){
                    //$m_url.addClass('prevent-event');
                //}

                if (_src.data('target') == '_self') {
                    $m_target.val('_self').change();
                }else if(_src.data('target') == '_blank') {
                    $m_target.find("option[value='_self']").removeAttr('selected');
                    $m_target.find("option[value='_blank']").attr('selected', 'selected');
                    $m_target.val('_blank');
                }
            }
        });

        /**
        * Reorder items
        */
        $('.dd').on('change', function (e) {
            $.post('{{ route('menus.item.order') }}', {
                order: JSON.stringify($('.dd').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            }, function (data) {
                data.status && pushNotify('Cập nhật thành công!', text = '', type = 'success');
            });
        });
    });
</script>
@endsection