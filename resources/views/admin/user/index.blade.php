@extends('admin.template.index')
@section('meta_section')
<title>ATVSLD | Quản lý người dùng</title>
<meta name="description" content="Quản lý người dùng">
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
                        <span class="m-nav__link-text">Quản lý người dùng</span>
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
                            Danh sách người dùng
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                                id="add_user">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group m-form__group row m--margin-bottom-30">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Họ tên:</label>
                                <input type="text" name="search_name" class="form-control m-input" placeholder="Họ tên">
                            </div>
                            <div class="col-lg-4">
                                <label>Tên đăng nhập:</label>
                                <input type="text" name="search_username" class="form-control m-input"
                                    placeholder="Tên đăng nhập">
                            </div>
                            <div class="col-lg-4">
                                <label>Điện thoại:</label>
                                <input type="text" name="search_phone" class="form-control m-input"
                                    placeholder="Điện thoại">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-4">
                                <label>Công ty:</label>
                                <select class="form-control m-select2" id="search_company_id" name="search_company" style="width: 100%">
                                    <option value="">Chọn công ty</option>
                                    @foreach( $companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="">Loại tài khoản:</label>
                                <select class="form-control" name="search_role">
                                    <option value="">Chọn loại tài khoản</option>
                                    <option value="system_admin">Tài khoản admin hệ thống</option>
                                    <option value="admin">Tài khoản admin công ty</option>
                                    <option value="user">Tài khoản thường</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="">Tình trạng:</label>
                                <select class="form-control" name="search_status">
                                    <option value="">Chọn trạng thái tài khoản</option>
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button class="btn btn-success m--margin-top-25 pull-right" id="search_user">Tìm
                                    kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.user.list', ['users' => $users])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" action="{{route('create_user')}}" id="form_create_user">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModalUser">Thêm tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Tên đăng nhập <span class="m--font-danger">*</span></label>
                                    <input type="text" name="username" class="form-control m-input"
                                        placeholder="Tên đăng nhập">
                                    <input type="hidden" value="" name="parent_id">
                                </div>
                            </div>
                            <div class="col-md-6" id="row_password">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Mật khẩu <span class="m--font-danger">*</span></label>
                                    <input type="password" name="password" class="form-control m-input"
                                        placeholder="Mật khẩu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Họ và tên <span class="m--font-danger">*</span></label>
                                    <input type="text" name="name" class="form-control m-input" placeholder="Họ và tên">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Điện thoại</label>
                                    <input type="text" name="phone" class="form-control m-input"
                                        placeholder="Điện thoại">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Email <span class="m--font-danger">*</span></label>
                                    <input type="text" name="email" class="form-control m-input" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Ngành nghề đặc thù</label>
                                    <input type="text" name="specific_profession" class="form-control m-input"
                                        placeholder="Ngành nghề đặc thù">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Bộ phận chức vụ</label>
                                    <input type="text" name="position" class="form-control m-input"
                                        placeholder="Bộ phận chức vụ">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Công ty</label>
                                    <select class="form-control m-select2" id="company_id" name="company_id" style="width: 100%">
                                        <option value="">Chọn công ty</option>
                                        @foreach( $companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-form__group form-group">
                                    <label for="">Tình trạng:</label>
                                    <div class="m-checkbox-list">
                                        <span class="m-switch m-switch--outline m-switch--success">
                                            <label>
                                                <input type="checkbox" name="status" checked="1" value="1">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Loại tài khoản</label>
                                    <div class="col-9">
                                        <div class="m-radio-list">
                                            <label class="m-radio">
                                                <input type="radio" name="role" value="user" checked="1"> Tài khoản
                                                thường
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" name="role" value="admin"> Tài khoản admin công ty
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" name="role" value="system_admin"> Tài khoản admin hệ
                                                thống
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="save_user">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="form_change_pass">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModalUser">Đổi mật khẩu tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Mật khẩu mới <span class="m--font-danger">*</span></label>
                                    <input type="password" name="password" class="form-control m-input"
                                        placeholder="Mật khẩu mới">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Xác nhận mật khẩu <span class="m--font-danger">*</span></label>
                                    <input type="password" name="re_password" class="form-control m-input"
                                        placeholder="Xác nhận mật khẩu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="save_password">Lưu</button>
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
        $('#company_id').select2({
			placeholder: "Chọn công ty",
            allowClear: true,
            dropdownParent: $('#modal_user')
		});

        $('#search_company_id').select2({
			placeholder: "Chọn công ty",
            allowClear: true
		});

        $('#form_create_user').on('submit', function (event) {
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
                        $('#modal_user').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa tài khoản thành công" : "Thêm tài khoản thành công", 'success');
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

        $('.m-section__content').on('click', '.delete_user', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_user", ":id") }}';
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
                                $('#modal_user').modal('hide');
                                showNotification("Thành công", "Xóa tài khoản thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_user', function () {
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
                        $('#titleModalUser').text('Sửa tài khoản');
                        $('input[name="username"]').val(user.username);
                        $('input[name="name"]').val(user.name);
                        $('input[name="password"]').val('');
                        $('#row_password').hide();
                        $('input[name="phone"]').val(user.phone);
                        $('input[name="email"]').val(user.email);
                        $('input[name="specific_profession"]').val(user.specific_profession);
                        $('input[name="position"]').val(user.position);
                        $('input[name="company"]').val(user.company);
                        $('input[name="status"]').prop('checked', parseInt(user.status) ? true : false);
                        $('input[name="role"][value="' + user.role + '"]').prop('checked', true);
                        $('#modal_user').modal('show');
                    }
                }
            })
        })

        $('#add_user').on('click', function () {
            $('#titleModalUser').text('Thêm tài khoản');
            $('input[name="username"]').val('');
            $('input[name="name"]').val('');
            $('input[name="password"]').val('');
            $('#row_password').show();
            $('input[name="phone"]').val('');
            $('input[name="email"]').val('');
            $('input[name="specific_profession"]').val('');
            $('input[name="position"]').val('');
            $('input[name="company"]').val('');
            $('input[name="status"]').prop('checked', true);
            $('#modal_user').modal('show');
        })

        $('#search_user').on('click', function () {
            updateView();
        })

        $('.m-section__content').on('click', '.reset_password', function () {
            id = $(this).attr('data-id');
            edit_id = id;
            $('#change_password').modal('show');
        })

        $('#form_change_pass').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            url = '{{ route("change_password_user", ":id") }}';
            url = url.replace(':id', edit_id);
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#change_password').modal('hide');
                        showNotification("Thành công", "Thay đổi mật khẩu tài khoản thành công");
                        edit_id = '';
                        $('input[name="password"]').val('');
                        $('input[name="re_password"]').val('');
                    }
                    else {
                        showNotification("Lỗi", result.msg, 'danger');
                    }
                },
            })
        })

        function updateView() {
            data_filter = {
                role: $('select[name="search_role"]').val(),
                name: $('input[name="search_name"]').val(),
                username: $('input[name="search_username"]').val(),
                phone: $('input[name="search_phone"]').val(),
                company: $('select[name="search_company"]').val(),
                status: $('select[name="search_status"]').val(),
            };
            $.ajax({
                url: '{{route("reload_user")}}',
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