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
                        <span class="m-nav__link-text">Quản lý loại hình cơ sở</span>
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
                            Danh sách loại hình cơ sở
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_business_type">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã ngành</th>
                                    <th>Tên ngành</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($types as $type)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->code}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete_business_type" data-id="{{$type->id}}">Delete</button>
                                        <button class="btn btn-success btn-sm edit_business_type" data-id="{{$type->id}}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_business_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_user')}}" id="form_create_business_type">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm loại hình cơ sở</h5>
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
                        <button type="submit" class="btn btn-primary" id="save_business_type">Lưu</button>
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
        $('#form_create_business_type').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_user", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_user")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_business_type').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa tài khoản thành công" : "Thêm tài khoản thành công", 'success');
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                    edit_id = '';
                    $('input[name="parent_name"]').val('');
                    $('input[name="parent_id"]').val('');
                    $('input[name="name"]').val('');
                    $('input[name="code"]').val('');
                    $('input[name="order"]').val('');
                },
            })
        })

        $('.m-section__content').on('click', '.delete_business_type', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_business_type", ":id") }}';
            url = url.replace(':id', id);
            swal({
                title: "Xác nhận?",
                text: "Xóa tài khoản này",
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
                                $('#modal_business_type').modal('hide');
                                showNotification("Thành công", "Xóa tài khoản thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_business_type', function () {
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_user", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        user = result.data;
                        $('input[name="username"]').val(user.username);
                        $('input[name="name"]').val(user.name);
                        $('input[name="password"]').val('');
                        $('#row_password').hide();
                        $('input[name="phone"]').val(user.phone);
                        $('input[name="email"]').val(user.email);
                        $('input[name="specific_profession"]').val(user.specific_profession);
                        $('input[name="position"]').val(user.position);
                        $('input[name="company"]').val(user.company);
                        $('input[name="status"]').prop('checked', user.status ? true : false);
                        $('#modal_business_type').modal('show');
                    }
                }
            })
        })

        $('#add_business_type').on('click', function () {
            $('input[name="username"]').val('');
            $('input[name="name"]').val('');
            $('input[name="password"]').val('');
            $('input[name="phone"]').val('');
            $('input[name="email"]').val('');
            $('input[name="specific_profession"]').val('');
            $('input[name="position"]').val('');
            $('input[name="company"]').val('');
            $('input[name="status"]').prop('checked', true);
            $('#modal_business_type').modal('show');
        })

        function updateView() {
            $.ajax({
                url: '{{route("reload_user")}}',
                method: "GET",
                success: function (html) {
                    $('.m-section__content').html(html)
                }
            })
        }
    })
</script>
@endsection