@extends('admin.template.index')
@section('subheader')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Quản lý dữ liệu</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Quản lý lĩnh vực sản xuất</span>
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
                            Danh sách lĩnh vực sản xuất
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_manufacturing_field">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.manufacturing_field.list', ['fields' => $fields])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_manufacturing_field" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_user')}}" id="form_create_manufacturing_field">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm lĩnh vực sản xuất</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Mã loại hình</label>
                                    <input type="text" name="code" class="form-control m-input" placeholder="Mã loại hình">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Tên loại hình</label>
                                    <input type="text" name="name" class="form-control m-input" placeholder="Tên loại hình">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="save_manufacturing_field">Lưu</button>
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
        $('#form_create_manufacturing_field').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_manufacturing_field", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_manufacturing_field")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_manufacturing_field').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa lĩnh vực sản xuất thành công" : "Thêm lĩnh vực sản xuất thành công", 'success');
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                    edit_id = '';
                    $('input[name="name"]').val('');
                    $('input[name="code"]').val('');
                },
            })
        })

        $('.m-section__content').on('click', '.delete_manufacturing_field', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_manufacturing_field", ":id") }}';
            url = url.replace(':id', id);
            swal({
                title: "Xác nhận?",
                text: "Xóa lĩnh vực sản xuất này",
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
                                $('#modal_manufacturing_field').modal('hide');
                                showNotification("Thành công", "Xóa lĩnh vực sản xuất thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_manufacturing_field', function () {
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_manufacturing_field", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        type = result.data;
                        $('input[name="code"]').val(type.code);
                        $('input[name="name"]').val(type.name);
                        $('#modal_manufacturing_field').modal('show');
                    }
                }
            })
        })

        $('#add_manufacturing_field').on('click', function () {
            $('input[name="code"]').val('');
            $('input[name="name"]').val('');
            $('#modal_manufacturing_field').modal('show');
        })

        function updateView() {
            $.ajax({
                url: '{{route("reload_manufacturing_field")}}',
                method: "GET",
                success: function (html) {
                    $('.m-section__content').html(html)
                }
            })
        }
    })
</script>
@endsection