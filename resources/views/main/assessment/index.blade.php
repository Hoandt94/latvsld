@extends('main.template.index')
@section('meta_section')
<title>ATVSLD | Quản lý kỳ đánh giá</title>
<meta name="description" content="Quản lý kỳ đánh giá">
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
                        <span class="m-nav__link-text">Quản lý kỳ đánh giá</span>
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
                            Danh sách kỳ đánh giá
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                                id="add_assessment">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        @include('main.assessment.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_assessment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_assessment')}}" id="form_create_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModalUser">Thêm kỳ đánh giá</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Tên kỳ đánh giá <span class="m--font-danger">*</span></label>
                                    <input type="text" name="name" class="form-control m-input"
                                        placeholder="Tên ký đánh giá">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Bộ câu hỏi<span class="m--font-danger">*</span></label>
                                    <select class="form-control m-select2" id="set_question" style="width: 100%" name="set_question">
                                        <option value="" disabled>Chọn bộ câu hỏi</option>
                                        @foreach( $set_questions as $set_question)
                                        <option value="{{$set_question->id}}">{{$set_question->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="save_assessment">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-update-personel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" action="{{route('update_personel')}}" id="form_update_personel">
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
        $('#set_question').select2({
			placeholder: "Chọn bộ câu hỏi"
		});
        $('#form_create_form').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_assessment", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_assessment")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_assessment').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa kỳ đánh giá thành công" : "Thêm kỳ đánh giá thành công", 'success');
                        edit_id = '';
                        $('input[name="name"]').val('');
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                },
            })
        })

        $('.m-section__content').on('click', '.delete_assessment', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_assessment", ":id") }}';
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
                                $('#modal_assessment').modal('hide');
                                showNotification("Thành công", "Xóa kỳ đánh giá thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_assessment', function () {
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_assessment", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        assessment = result.data;
                        $('#titleModalUser').text('Sửa kỳ đánh giá');
                        $('input[name="name"]').val(assessment.name);
                        $('#set_question').val(assessment.set_question_id);
                        $('#set_question').trigger('change');
                        $('#modal_assessment').modal('show');
                    }
                }
            })
        })

        $('#add_assessment').on('click', function () {
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
            $('#modal_assessment').modal('show');
        })

        $('#search_assessment').on('click', function () {
            updateView();
        })

        function updateView() {
            data_filter = {
                role: $('select[name="search_role"]').val(),
                name: $('input[name="search_name"]').val(),
                username: $('input[name="search_assessmentname"]').val(),
                phone: $('input[name="search_phone"]').val(),
                company: $('select[name="search_company"]').val(),
                status: $('select[name="search_status"]').val(),
            };
            $.ajax({
                url: '{{route("reload_assessment")}}',
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