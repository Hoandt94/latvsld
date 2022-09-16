@extends('main.template.index')
@section('meta_section')
<title>ATVSLD | Đánh giá an toàn lao động</title>
<meta name="description" content="Đánh giá an toàn lao động">
@endsection
@section('subheader')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Trang chủ</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Đánh giá an toàn lao động</span>
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
                            Danh mục đánh giá
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        @include('main.assessment.list_category')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_asset')
<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
<script>
    edit_id = '';
    $(document).ready(function () {

        $('#form_create_form').on('submit', function (event) {
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
                        showNotification("Thành công", edit_id ? "Sửa kỳ đánh giá thành công" : "Thêm kỳ đánh giá thành công", 'success');
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
                text: "Xóa kỳ đánh giá này",
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
                                showNotification("Thành công", "Xóa kỳ đánh giá thành công", 'success');
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
                        $('#titleModalUser').text('Sửa kỳ đánh giá');
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
            $('#titleModalUser').text('Thêm kỳ đánh giá');
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
                        showNotification("Thành công", "Thay đổi mật khẩu kỳ đánh giá thành công");
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