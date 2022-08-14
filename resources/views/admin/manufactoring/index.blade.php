@extends('admin.template.index')
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
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_user">
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
                                    <th>Tên đăng nhập</th>
                                    <th>Họ và tên</th>
                                    <th>Công ty</th>
                                    <th>Điện thoại</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Loại tài khoản</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->company}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if($user->status)
                                    <td><button class="btn btn-success btn-sm">Đang hoạt động</button></td>
                                    @else
                                    <td><button class="btn btn-danger btn-sm">Ngừng hoạt động</button></td>
                                    @endif
                                    @if($user->role == 'system_admin')
                                    <td>Tài khoản admin hệ thống</td>
                                    @elseif($user->role == 'admin')
                                    <td>Tài khoản admin công ty</td>
                                    @else
                                    <td>Tài khoản thường</td>
                                    @endif
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete_user" data-id="{{$user->id}}">Delete</button>
                                        <button class="btn btn-success btn-sm edit_user" data-id="{{$user->id}}">Edit</button>
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
    <div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_user')}}" id="form_create_user">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Tên đăng nhập:</label>
                                    <input type="text" name="username" class="form-control m-input" placeholder="Tên đăng nhập">
                                    <input type="hidden" value="" name="parent_id">
                                </div>
                            </div>
                            <div class="col-md-12" id="row_password">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Mật khẩu:</label>
                                    <input type="password" name="password" class="form-control m-input" placeholder="Mật khẩu">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Họ và tên</label>
                                    <input type="text" name="name" class="form-control m-input" placeholder="Họ và tên">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Điện thoại</label>
                                    <input type="text" name="phone" class="form-control m-input" placeholder="Điện thoại">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Email</label>
                                    <input type="text" name="email" class="form-control m-input" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Ngành nghề đặc thù</label>
                                    <input type="text" name="specific_profession" class="form-control m-input" placeholder="Ngành nghề đặc thù">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Bộ phận chức vụ</label>
                                    <input type="text" name="position" class="form-control m-input" placeholder="Bộ phận chức vụ">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Công ty</label>
                                    <input type="text" name="company" class="form-control m-input" placeholder="Công ty">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Tình trạng:</label>
                                    <div class="col-lg-6">
                                        <div class="m-checkbox-list">
                                            <label class="m-checkbox">
                                                <input type="checkbox" name ="status" checked="1" value="1"> Đang hoạt động
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Loại tài khoản</label>
                                    <div class="col-9">
                                        <div class="m-radio-list">
                                            <label class="m-radio">
                                                <input type="radio" name="role" value="user" checked="1"> Tài khoản thường
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" name="role" value="admin"> Tài khoản admin công ty
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" name="role" value="system_admin"> Tài khoản admin hệ thống
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
</div>
@endsection
@section('footer_asset')
<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
<script>
    edit_id = '';
    $(document).ready(function () {
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
                        $('#modal_user').modal('show');
                    }
                }
            })
        })

        $('#add_user').on('click', function () {
            $('input[name="username"]').val('');
            $('input[name="name"]').val('');
            $('input[name="password"]').val('');
            $('input[name="phone"]').val('');
            $('input[name="email"]').val('');
            $('input[name="specific_profession"]').val('');
            $('input[name="position"]').val('');
            $('input[name="company"]').val('');
            $('input[name="status"]').prop('checked', true);
            $('#modal_user').modal('show');
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