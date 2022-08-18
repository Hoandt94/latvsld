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
                        <span class="m-nav__link-text">Quản lý câu hỏi</span>
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
                            Danh sách câu hỏi pháp luật
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('create_question')}}"
                                class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill">
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
                                <label>Danh mục:</label>
                                <select class="form-control m-select2" id="category_id" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    @foreach( $categories as $category)
                                    <option value="{{$category->id}}">{{$category->code}} - {{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label>Mã câu hỏi:</label>
                                <input type="text" name="search_code" class="form-control m-input" placeholder="Mã câu hỏi">
                            </div>
                            <div class="col-lg-4">
                                <label>Nội dung:</label>
                                <input type="text" name="search_content" class="form-control m-input" placeholder="Nội dung">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="row m--margin-bottom-20">
                            <button class="btn btn-success m--margin-top-25" id="search_user">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.question.list', ['questions' => $questions])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_asset')
<script>
    edit_id = '';
    $(document).ready(function () {
        $('#category_id').select2({
			placeholder: "Chọn danh mục"
		});

        $('#search_user').on('click', function(){
            updateView();
        })

        function updateView() {
            data_filter = {
                category_id: $('#category_id').val(),
                code: $('input[name="search_code"]').val(),
                content: $('input[name="search_content"]').val(),
            };
            console.log(data_filter);
            $.ajax({
                url: '{{route("reload_question")}}',
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