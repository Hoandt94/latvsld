@extends('admin.template.index')
@section('meta_section')
<title>ATVSLD | Thêm câu hỏi</title>
<meta name="description" content="Thêm câu hỏi">
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
                        <span class="m-nav__link-text">Quản lý câu hỏi</span>
                    </a>
                </li>
                <!-- <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Danh sách</span>
                    </a>
                </li> -->
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
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Thêm câu hỏi pháp luật
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form class="m-form" action="{{route('create_question')}}" method="post">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        @if(!empty($errors->any()))
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        @endif
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Mã danh mục:</label>
                            <div class="col-lg-6">
                                <select class="form-control m-select2" id="category_id" name="category_id">
                                    <option value="" disabled>Chọn danh mục</option>
                                    @foreach( $categories as $category)
                                    <option value="{{$category->id}}">{{$category->code}} - {{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Mã câu hỏi:</label>
                            <div class="col-lg-6">
                                <input type="text" name="code" class="form-control m-input" placeholder="Mã câu hỏi">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Nội dung:</label>
                            <div class="col-lg-6">
                                <textarea type="text" name="content" class="form-control m-input"
                                    placeholder="Nội dung"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Bằng chứng tuân thủ:</label>
                            <div class="col-lg-6">
                                <textarea type="text" name="approve_help" class="form-control m-input"
                                    placeholder="Bằng chứng tuân thủ"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Điều khoản căn cứ:</label>
                            <div class="col-lg-6">
                                <textarea type="text" name="term" class="form-control m-input"
                                    placeholder="Điều khoản căn cứ"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Hình thức xử phạt:</label>
                            <div class="col-lg-6">
                                <textarea type="text" name="penalty" class="form-control m-input"
                                    placeholder="Hình thức xử phạt"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Yêu cầu/Hướng dẫn thực hiện:</label>
                            <div class="col-lg-6">
                                <textarea type="text" name="guide" class="form-control m-input"
                                    placeholder="Yêu cầu/Hướng dẫn thực hiện"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Công thức:</label>
                            <div class="col-lg-6">
                                <textarea type="text" name="answer_expression" class="form-control m-input"
                                    placeholder="Công thức"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Tài liệu hướng dẫn kèm theo:</label>
                            <div class="col-lg-6">
                                <div class="input-group">
									<input type="text" class="form-control" name="guide_attachment" id="guide_attachment" placeholder="Tài liệu hướng dẫn kèm theo">
									<div class="input-group-append">
										<button class="btn btn-primary" id="choose_guide_attachments" data-input="guide_attachment" type="button">Chọn</button>
									</div>
								</div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Tài liệu biểu mẫu tham khảo:</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                <input type="text" name="sample_attachment" id="sample_attachment" class="form-control m-input" placeholder="Tài liệu biểu mẫu tham khảo">
									<div class="input-group-append">
										<button class="btn btn-primary" id="choose_sample_attachment" data-input="sample_attachment" type="button">Chọn</button>
									</div>
								</div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Tag:</label>
                            <div class="col-lg-6">
                                <select class="form-control m-select2" id="tag" multiple name="tag">
                                </select>
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <button type="reset" class="btn btn-secondary">Hủy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>
    </div>
</div>
@endsection
@section('footer_asset')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    $(document).ready(function () {
        $('#category_id').select2({
			placeholder: "Chọn danh mục"
		});
        $("#tag").select2({
			placeholder: "Thêm tag câu hỏi",
			tags: !0
		})
        $('#choose_guide_attachments').filemanager('file');
        $('#choose_sample_attachment').filemanager('file');
    })
</script>
@endsection