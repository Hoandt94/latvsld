@extends('admin.template.index')
@section('meta_section')
<title>ATVSLD | Quản lý gói tài khoản</title>
<meta name="description" content="Quản lý gói tài khoản">
@endsection
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
                        <span class="m-nav__link-text">Quản lý gói tài khoản</span>
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
                            Danh sách gói tài khoản
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-primary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="add_service_pack">
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
                                <label>Tên gói tài khoản:</label>
                                <input type="text" name="search_name" class="form-control m-input" placeholder="Tên gói tài khoản">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="row m--margin-bottom-20">
                            <button class="btn btn-success m--margin-top-25" id="search_service_pack">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.service_pack.list', ['service_packs' => $service_packs])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_service_pack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('create_user')}}" id="form_create_service_pack">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-pack-title">Thêm gói tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Tên gói tài khoản <span class="m--font-danger">*</span></label>
                                    <input type="text" name="name" class="form-control m-input" placeholder="Tên gói tài khoản">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Mô tả</label>
                                    <input type="text" name="description" class="form-control m-input" placeholder="Mô tả gói tài khoản">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Giá</label>
                                    <input type="number" name="price" class="form-control m-input" placeholder="Giá gói tài khoản">
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
                        <button type="submit" class="btn btn-primary" id="save_service_pack">Lưu</button>
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
        $('#form_create_service_pack').on('submit', function (event) {
            event.preventDefault();
            dataSending = $(this).serializeArray();
            if (edit_id) {
                url = '{{ route("update_service_pack", ":id") }}';
                url = url.replace(':id', edit_id);
            }
            else url = '{{route("create_service_pack")}}'
            $.ajax({
                url: url,
                method: "POST",
                data: dataSending,
                success: function (result) {
                    if (result.status) {
                        $('#modal_service_pack').modal('hide');
                        updateView();
                        showNotification("Thành công", edit_id ? "Sửa gói tài khoản thành công" : "Thêm gói tài khoản thành công", 'success');
                        edit_id = '';
                        $('input[name="name"]').val('');
                        $('input[name="description"]').val('');
                        $('input[name="price"]').val(0);
                    }
                    else showNotification("Lỗi", result.msg, 'danger');
                },
            })
        })

        $('.m-section__content').on('click', '.edit_service_pack', function () {
            $('#modal-pack-title').text('Sửa gói tài khoản');
            id = $(this).attr('data-id');
            edit_id = id;
            url = '{{ route("get_service_pack", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "GET",
                success: function (result) {
                    if (result.data) {
                        type = result.data;
                        $('input[name="description"]').val(type.description);
                        $('input[name="name"]').val(type.name);
                        $('input[name="price"]').val(type.price);
                        $('#modal_service_pack').modal('show');
                    }
                }
            })
        })

        $('#add_service_pack').on('click', function () {
            $('#modal-pack-title').text('Thêm gói tài khoản')
            $('input[name="description"]').val('');
            $('input[name="name"]').val('');
            $('input[name="price"]').val(0);
            $('#modal_service_pack').modal('show');
        })

        $('#search_service_pack').on('click', function(){
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
                description: $('input[name="search_description"]').val(),
                name: $('input[name="search_name"]').val(),
                page: page
            };
            $.ajax({
                url: '{{route("reload_service_pack")}}',
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