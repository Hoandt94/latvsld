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
                        <span class="m-nav__link-text">Cài đặt bộ câu hỏi</span>
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
                            Cài đặt bộ câu hỏi
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#"
                                class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" id="save_config">
                                <i class="la la-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        @include('admin.set_question.list_category', ['categories' => $categories])
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
    $(document).ready(function () {
        setQuestion = JSON.parse('{!!json_encode($setQuestion)!!}');
        
        if(!setQuestion.categories){
            $("input:checkbox[name=categories]").prop('checked', true);
        }
        else{
            categories = JSON.parse(setQuestion.categories);
            $.each(categories, function(key, value){
                $("input:checkbox[name=categories][value="+value+"]").prop('checked', true);
            })
        }
        if(!setQuestion.questions){
            $("input:checkbox[name=questions]").prop('checked', true);
        }
        else{
            questions = JSON.parse(setQuestion.questions);
            $.each(questions, function(key, value){
                $("input:checkbox[name=questions][value="+value+"]").prop('checked', true);
            })
        }

        $("input:checkbox[name=categories]").on('change', function() {
            var ischecked= $(this).is(':checked');
            parent_el = $(this).closest('.wtree-item');
            if(!ischecked) {
                parent_el.find("input:checkbox[name=categories]").prop('checked', false);
                parent_el.find("input:checkbox[name=questions]").prop('checked', false);
            }
            else{
                parent_el.find("input:checkbox[name=categories]").prop('checked', true);
                parent_el.find("input:checkbox[name=questions]").prop('checked', true);
            }
        });

        $('#save_config').on('click', function(){
            categories = []
            questions = []
            $("input:checkbox[name=categories]:checked").each(function(){
                categories.push($(this).val());
            });
            $("input:checkbox[name=questions]:checked").each(function(){
                questions.push($(this).val());
            });

            id = setQuestion.id;
            url = '{{ route("config_set_question", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    categories: categories,
                    questions: questions,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success: function (result) {
                    // if (result.data) {
                    //     category = result.data;
                    //     $('input[name="parent_name"]').val(category.name);
                    //     $('input[name="parent_id"]').val(category.id);
                    //     $('input[name="name"]').val('');
                    //     $('input[name="code"]').val('');
                    //     $('input[name="order"]').val('');
                    //     $('#modal_category').modal('show');
                    // }
                }
            })
        })
    })
</script>
@endsection