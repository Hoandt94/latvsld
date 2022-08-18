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
                        <span class="m-nav__link-text">Quản lý ngành nghề đặc thù</span>
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
                            Danh sách ngành nghề đặc thù
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_specific_profession">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group m-form__group row m--margin-bottom-30">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Mã loại hình:</label>
                                <input type="text" name="search_code" class="form-control m-input" placeholder="Mã loại hình">
                            </div>
                            <div class="col-lg-4">
                                <label>Tên loại hình:</label>
                                <input type="text" name="search_name" class="form-control m-input" placeholder="Tên loại hình">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="row m--margin-bottom-20">
                            <button class="btn btn-success m--margin-top-25" id="search_type">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.specific_profession.list', ['$jobs' => $jobs])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_specific_profession" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_user')}}" id="form_create_specific_profession">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm ngành nghề đặc thù</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Mã nghề đặc thù</label>
                                    <input type="text" name="code" class="form-control m-input" placeholder="Mã nghề đặc thù">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Tên nghề đặc thù</label>
                                    <input type="text" name="name" class="form-control m-input" placeholder="Tên nghề đặc thù">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="save_specific_profession">Lưu</button>
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
        $('#form_create_specific_profession').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_specific_profession", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_specific_profession")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_specific_profession').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa ngành nghề đặc thù thành công" : "Thêm ngành nghề đặc thù thành công", 'success');
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                    edit_id = '';
                    $('input[name="name"]').val('');
                    $('input[name="code"]').val('');
                },
            })
        })

        $('.m-section__content').on('click', '.delete_specific_profession', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_specific_profession", ":id") }}';
            url = url.replace(':id', id);
            swal({
                title: "Xác nhận?",
                text: "Xóa ngành nghề đặc thù này",
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
                                $('#modal_specific_profession').modal('hide');
                                showNotification("Thành công", "Xóa ngành nghề đặc thù thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_specific_profession', function () {
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_specific_profession", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        type = result.data;
                        $('input[name="code"]').val(type.code);
                        $('input[name="name"]').val(type.name);
                        $('#modal_specific_profession').modal('show');
                    }
                }
            })
        })

        $('#add_specific_profession').on('click', function () {
            $('input[name="code"]').val('');
            $('input[name="name"]').val('');
            $('#modal_specific_profession').modal('show');
        })

        $('#search_type').on('click', function(){
            updateView();
        })

        function updateView() {
            data_filter = {
                code: $('input[name="search_code"]').val(),
                name: $('input[name="search_name"]').val(),
            };
            $.ajax({
                url: '{{route("reload_specific_profession")}}',
                method: "GET",
                data: data_filter,
                success: function (html) {
                    $('.m-section__content').html(html)
                }
            })
        }
    })
</script>
@endsection