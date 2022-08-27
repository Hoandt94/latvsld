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
                        <span class="m-nav__link-text">Quản lý công ty</span>
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
                            Danh sách công ty
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_company">
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
                                <label>Mã công ty:</label>
                                <input type="text" name="search_code" class="form-control m-input" placeholder="Mã công ty">
                            </div>
                            <div class="col-lg-4">
                                <label>Tên công ty:</label>
                                <input type="text" name="search_name" class="form-control m-input" placeholder="Tên công ty">
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
                        @include('admin.company.list', ['companies' => $companies])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_company" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_user')}}" id="form_create_company">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-type-title">Thêm công ty</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Mã công ty <span class="m--font-danger">*</span></label>
                                    <input type="text" name="code" class="form-control m-input" placeholder="Mã công ty">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Tên công ty <span class="m--font-danger">*</span></label>
                                    <input type="text" name="name" class="form-control m-input" placeholder="Tên công ty">
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
                        <button type="submit" class="btn btn-primary" id="save_company">Lưu</button>
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
        $('#form_create_company').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_company", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_company")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_company').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa công ty thành công" : "Thêm công ty thành công", 'success');
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                    edit_id = '';
                    $('input[name="name"]').val('');
                    $('input[name="code"]').val('');
                },
            })
        })

        $('.m-section__content').on('click', '.delete_company', function () {
            id = $(this).attr('data-id');
            url = '{{ route("delete_company", ":id") }}';
            url = url.replace(':id', id);
            swal({
                title: "Xác nhận?",
                text: "Xóa công ty này",
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
                                $('#modal_company').modal('hide');
                                showNotification("Thành công", "Xóa công ty thành công", 'success');
                            }
                            else showNotification("Lỗi", result.msg, 'danger');
                        }
                    })
                }
            })
        })

        $('.m-section__content').on('click', '.edit_company', function () {
            $('#modal-type-title').text('Sửa công ty');
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_company", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        type = result.data;
                        $('input[name="code"]').val(type.code);
                        $('input[name="name"]').val(type.name);
                        $('#modal_company').modal('show');
                    }
                }
            })
        })

        $('#add_company').on('click', function () {
            $('#modal-type-title').text('Thêm công ty')
            $('input[name="code"]').val('');
            $('input[name="name"]').val('');
            $('#modal_company').modal('show');
        })

        $('#search_type').on('click', function(){
            updateView();
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
                code: $('input[name="search_code"]').val(),
                name: $('input[name="search_name"]').val(),
                page: page
            };
            $.ajax({
                url: '{{route("reload_company")}}',
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