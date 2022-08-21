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
                        <span class="m-nav__link-text">Quản lý bộ câu hỏi</span>
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
                            Danh sách bộ câu hỏi
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_set_question">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.set_question.list', ['setQuestions' => $setQuestions])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_set_question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_set_question')}}" id="form_create_set_question">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm bộ câu hỏi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Mã bộ câu hỏi</label>
                                    <input type="text" name="code" class="form-control m-input" placeholder="Mã bộ câu hỏi">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Tên bộ câu hỏi</label>
                                    <input type="text" name="name" class="form-control m-input" placeholder="Tên bộ câu hỏi">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="message-text" class="col-3 col-form-label">Trạng thái:</label>
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
                        <button type="submit" class="btn btn-primary" id="save_set_question">Lưu</button>
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
        $('#form_create_set_question').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_set_question", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_set_question")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_set_question').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa bộ câu hỏi thành công" : "Thêm bộ câu hỏi thành công", 'success');
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                    edit_id = '';
                    $('input[name="name"]').val('');
                    $('input[name="code"]').val('');
                },
            })
        })

        $('.m-section__content').on('click', '.delete_set_question', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_set_question", ":id") }}';
            url = url.replace(':id', id);
            swal({
                title: "Xác nhận?",
                text: "Xóa bộ câu hỏi này",
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
                                $('#modal_set_question').modal('hide');
                                showNotification("Thành công", "Xóa bộ câu hỏi thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_set_question', function () {
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_set_question", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        type = result.data;
                        $('input[name="code"]').val(type.code);
                        $('input[name="name"]').val(type.name);
                        $('#modal_set_question').modal('show');
                    }
                }
            })
        })

        $('#add_set_question').on('click', function () {
            $('input[name="code"]').val('');
            $('input[name="name"]').val('');
            $('#modal_set_question').modal('show');
        })

        $('.m-section__content').on('click', 'a.page-link', function(e){
            e.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            myurl = $(this).attr('href');
            page = $(this).attr('href').split('page=')[1];
            updateView(page);
        })

        function updateView(page = 1) {
            data_filter = {
                page: page
            }
            $.ajax({
                url: '{{route("reload_set_question")}}',
                method: "GET",
                data: data_filter
                success: function (html) {
                    $('.m-section__content').html(html)
                }
            })
        }
    })
</script>
@endsection