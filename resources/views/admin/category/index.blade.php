@extends('admin.template.index')
@section('meta_section')
<title>ATVSLD | Quản lý danh mục</title>
<meta name="description" content="Quản lý danh mục">
@endsection
@section('subheader')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Quản lý chung</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Quản lý danh mục</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh sách nhóm danh mục
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_category">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.category.list_category', ['categories' => $categories])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_category')}}" id="form_create_category">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title_modal_category">Thêm nhóm danh mục</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Tên nhóm danh mục
                                        cha:</label>
                                    <input type="text" name="parent_name" class="form-control" disabled
                                        value="Không có">
                                    <input type="hidden" value="" name="parent_id">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Tên nhóm danh mục <span class="m--font-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Tên danh mục">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Mã danh mục</label>
                                    <input type="text" class="form-control" name="code" placeholder="Mã danh mục">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Thứ tự hiển thị <span class="m--font-danger">*</span></label>
                                    <input type="text" class="form-control" name="order" placeholder="Thứ tự hiển thị">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="message-text" class="col-3 col-form-label">Trạng thái</label>
                                    <div class="col-9">
                                        <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                            <label>
                                                <input type="checkbox" checked="checked" name="status">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="save_category">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer_asset')
<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
<script>
    edit_id = '';
    $(document).ready(function () {
        listCategory = JSON.parse('{!!json_encode($categories)!!}');
        $('#form_create_category').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_category", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_category")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_category').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa danh mục thành công" : "Thêm danh mục thành công", 'success');
                        edit_id = '';
                        $('input[name="parent_name"]').val('');
                        $('input[name="parent_id"]').val('');
                        $('input[name="name"]').val('');
                        $('input[name="code"]').val('');
                        $('input[name="order"]').val('');
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                },
            })
        })
        $('.m-section__content').on('click', '.create_sub', function () {
            $('#title_modal_category').text('Thêm nhóm danh mục');
            id = $(this).attr('data-id');
            url = '{{ route("get_category", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        category = result.data;
                        $('input[name="parent_name"]').val(category.name);
                        $('input[name="parent_id"]').val(category.id);
                        $('input[name="name"]').val('');
                        $('input[name="code"]').val('');
                        $('input[name="order"]').val('');
                        $('#modal_category').modal('show');
                    }
                }
            })
        })

        $('.m-section__content').on('click', '.delete_category', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_category", ":id") }}';
            url = url.replace(':id', id);
            swal({
                title: "Xác nhận?",
                text: "Xóa danh mục này",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value) {
                    $.ajax({
                        url: url,
                        method: "GET",
                        success: function (result) {
                            if (result.status) {
                                $('#modal_category').modal('hide');
                                showNotification("Thành công", "Xóa danh mục thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_category', function () {
            $('#title_modal_category').text('Sửa nhóm danh mục');
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_category", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        category = result.data;
                        $('input[name="name"]').val(category.name);
                        $('input[name="code"]').val(category.code);
                        $('input[name="order"]').val(category.order);
                        $('input[name="status"]').prop('checked', category.status ? true : false);
                        $('#modal_category').modal('show');
                    }
                }
            })
        })

        $('#add_category').on('click', function () {
            $('#title_modal_category').text('Thêm nhóm danh mục');
            $('input[name="name"]').val('');
            $('input[name="parent_name"]').val('Không có');
            $('input[name="code"]').val('');
            $('input[name="order"]').val();
            $('input[name="status"]').prop('checked', true);
            $('#modal_category').modal('show');
        })

        function updateView() {
            $.ajax({
                url: '{{route("reload_category")}}',
                method: "GET",
                success: function (html) {
                    $('.m-section__content').html(html)
                }
            })
        }
    })
</script>
@endsection