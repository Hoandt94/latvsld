@extends('main.template.index')
@section('meta_section')
<title>ATVSLD | Khảo sát thực hiện pháp luật</title>
<meta name="description" content="Khảo sát thực hiện pháp luật">
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
        <div class="row mb-3">
            <div class="col-md-6">
                <h5>{{$category->name}}</h5>
            </div>
        </div>
        <?php 
            $categories = $assessment->setQuestion->getCategories();
            $listQuestions = json_decode($assessment->setQuestion->questions, true);
            $listCategories = json_decode($assessment->setQuestion->categories, true);
            $questions = $category->getQuestionInSet($listQuestions);
        ?>
        @foreach($questions as $index => $question)
        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h5 class="m-portlet__head-text">
                            {{$question->content}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="m-section">
                    <div class="m-section__content">
                        <div class="m-portlet m-portlet--bordered m-portlet--rounded  m-portlet--last mb-2">
                            <div class="m-portlet__head" style="background-color: initial; border-color: #ebedf2">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text" style="color: #575962;">
                                            Điều khoản căn cứ
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                @foreach(json_decode($question->term, true) as $term)
                                    <p>{{$term}}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="m-portlet m-portlet--bordered m-portlet--rounded  m-portlet--last mb-2">
                            <div class="m-portlet__head" style="background-color: initial; border-color: #ebedf2">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text" style="color: #575962;">
                                            Yêu cầu thực hiện
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                {!!$question->required!!}
                            </div>
                        </div>
                        <div class="m-accordion m-accordion--bordered" id="m_accordion_2" role="tablist">

                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_2_item_3_head"
                                    data-toggle="collapse" href="#m_accordion_2_item_3_body" aria-expanded="false">
                                    <!-- <span class="m-accordion__item-icon">
                                    <i class="fa flaticon-alert-2"></i>
                                </span> -->
                                    <span class="m-accordion__item-title">Hướng dẫn thực hiện</span>
                                    <span class="m-accordion__item-mode"></span>
                                </div>
                                <div class="m-accordion__item-body collapse" id="m_accordion_2_item_3_body"
                                    role="tabpanel" aria-labelledby="m_accordion_2_item_3_head"
                                    data-parent="#m_accordion_2">
                                    <div class="m-accordion__item-content">
                                        {!!$question->guide!!}
                                    </div>
                                </div>
                            </div>

                            <!--end::Item-->
                        </div>
                        <div class="widget-main padding-medium">
                            <!-- <strong>Điều Khoản Căn Cứ: </strong>
                            <ul class="area_explain questionGuid">
                                @foreach(json_decode($question->term, true) as $term)
                                <li>{{$term}}</li>
                                @endforeach
                            </ul>
                            <strong>Yêu cầu/Hướng dẫn thực hiện: </strong>
                            <p class="ml-4 mb-1"><strong>1. Yêu cầu thực hiện</strong></p>
                            <p class="ml-4 mb-1">{!!$question->required!!}</p>
                            <p class="ml-4 mb-1"><strong>2. Hướng dẫn thực hiện</strong></p>
                            <p class="ml-4 mb-1">{!!$question->guide!!}</p> -->
                            <hr>
                            <div class="row response-answer" data-id="{{$question->id}}"
                                category-id="{{$category->id}}">
                                <div class="col-3 padding-left-medium">
                                    <div class="checkAnswer ">
                                        <div class="m-radio-list">
                                            <label class="m-radio m-radio--primary">
                                                <input type="radio" class="checkbox-answer"
                                                    name="responseAnswer[{{$question->id}}]" value="yes"
                                                    indexquestion="{{$question->id}}" questionid="{{$question->id}}" disabled="true"> Đạt
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--primary">
                                                <input type="radio" class="checkbox-answer"
                                                    name="responseAnswer[{{$question->id}}]" value="no"
                                                    indexquestion="{{$question->id}}" questionid="{{$question->id}}" disabled="true">
                                                Không
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--primary">
                                                <input type="radio" class="checkbox-answer"
                                                    name="responseAnswer[{{$question->id}}]" value="improve"
                                                    indexquestion="{{$question->id}}" questionid="{{$question->id}}" disabled="true">
                                                Cải thiện
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div indexquestion="{{$question->id}}" id="input-yes-{{$question->id}}"
                                        class="answerInput" style="display: none">
                                        <div class="form-group">
                                            <label class="label-control">Nội dung tuân thủ: </label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea id="comment" name="yes-note" class="form-control yes-note"
                                                        rows="5" disabled="true"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control">Bằng chứng tuân thủ: </label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control attachment-name yes-attachment-name"
                                                            name="yes-attachment-name"
                                                            placeholder="Bằng chứng tuân thủ" disabled="true">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="button" style="cursor: not-allowedd">
                                                                <input type="file" name="yes-attachment"
                                                                    class="custom-file-input yes-attachment" disabled="true"> Chọn
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="help-block">
                                                        <strong>Tài Liệu, Biểu Mẫu Tham Khảo:</strong>
                                                        <a
                                                            href="{{url('/') . $question->sample_attachment}}">{{basename($question->sample_attachment)}}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row area_explain approveHelpQuestion">
                                                <div class="col-sm-12">
                                                    <p class="help-block"><strong>Bằng Chứng Tuân Thủ</strong>:
                                                        {{$question->approve_help}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div indexquestion="{{$question->id}}" id="input-no-{{$question->id}}"
                                        class="answerInput answer-no" style="display: none">
                                        <div class="form-group">
                                            <label class="label-control">Mức Phạt Hành Chính: </label>
                                            <?php 
                                                $penalty = $question->getPenalty();
                                            ?>
                                            <div class="row area_explain penaltyQuestion">
                                                <div class="col-sm-12">
                                                    <p>{{number_format($penalty['min'], 2)}} - {{number_format($penalty['max'], 2)}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="help-block"><strong>Tài Liệu, Biểu Mẫu Tham Khảo:
                                                        </strong><a
                                                            href="{{url('/') . $question->sample_attachment}}">{{basename($question->sample_attachment)}}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="label-control">Nhân Viên Thực Hiện</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control select-employee select-no-employee"
                                                        name="no-employee" style="width: 100%" disabled="true">
                                                        <option value="" disabled>Nhân viên thực hiện</option>
                                                        @foreach( $users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}} -
                                                            {{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control">Thời gian hoàn thành</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control date-selected date-no"
                                                        name="no-date" readonly placeholder="Select date" disabled="true"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div indexquestion="{{$question->id}}" id="input-improve-{{$question->id}}"
                                        class="answerInput answer-improve" style="display: none">
                                        <div class="form-group">
                                            <label class="label-control">Ghi Lại Những Nội Dung Cần Cải Thiện: </label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea id="comment" name="improve-note"
                                                        class="form-control improve-note" rows="5" disabled="true"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control">Đính Kèm Tập Tin Nội Dung Cần Cải Thiện:
                                            </label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control attachment-name improve-attachment-name"
                                                            name="improve-attachment-name"
                                                            placeholder="Bằng chứng tuân thủ" disabled="true">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="button">
                                                                <input type="file" name="improve-attachment"
                                                                    class="custom-file-input improve-attachment" disabled="true"> Chọn
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- <div></div>
                                                    <div class="custom-file">
                                                        <input type="file" name="improve-attachment"
                                                            class="custom-file-input improve-attachment"
                                                            id="customFile_improve">
                                                        <label class="custom-file-label label-primary"
                                                            for="customFile">Choose file</label>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="help-block"><strong>Tài Liệu, Biểu Mẫu Tham Khảo:
                                                        </strong><a
                                                            href="{{url('/') . $question->sample_attachment}}">{{basename($question->sample_attachment)}}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control">Nhân Viên Thực Hiện</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control select-employee select-improve-employee"
                                                        name="improve-employee" style="width: 100%" disabled="true">
                                                        <option value="" disabled>Nhân viên thực hiện</option>
                                                        @foreach( $users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control">Thời gian hoàn thành</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control date-selected date-improve"
                                                        name="improve-date" id="improve-{{$index}}-date" readonly
                                                        placeholder="Select date" disabled="true"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('footer_asset')
<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
<script>
    assessment_id = '{!!$assessment->id!!}';
    answers = JSON.parse('{!!$answers!!}');
    console.log(answers);
    $(document).ready(function () {

        var arrows;
        if (mUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

        $('.date-selected').datepicker({
            rtl: mUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            format: 'dd/mm/yyyy',
            autoclose: true
        });

        $('.select-employee').select2();

        $.each(answers, function (key, value) {
            question_id = value.question_id;
            answer = value.answer;
            element = $('.m-content').find('.response-answer[data-id="' + question_id + '"]');
            element.find('.checkbox-answer[value="' + answer + '"]').prop('checked', true);

            $('.answerInput[indexquestion="' + question_id + '"]').hide();
            elementID = '#input-' + answer + '-' + question_id;
            $(elementID).fadeIn();
            switch (answer) {
                case 'yes':
                    element.find('.yes-note').val(value.yes_note);
                    fileName = value.yes_attachment.split('/')
                    element.find('.attachment-name').val(fileName[fileName.length - 1]);

                    break;
                case 'no':
                    date = new Date(value.no_finish_date);
                    console.log(element.find('.select-no-employee'));
                    element.find('.select-no-employee').val(value.no_employee_id).trigger('change');
                    element.find('.date-no').datepicker("setDate", date);

                    break;
                case 'improve':
                    date = new Date(value.improve_finish_date);
                    element.find('.improve-note').val(value.improve_note);
                    element.find('.select-improve-employee').val(value.improve_employee_id).trigger('change');
                    element.find('.date-improve').datepicker("setDate", date);

                    fileName = value.improve_attachment.split('/')
                    element.find('.attachment-name').val(fileName[fileName.length - 1]);

                    break;
                default:
                    break;
            }
        })

        $('.checkbox-answer').on('click', function () {
            indexQuestion = $(this).attr('indexquestion');
            $('.answerInput[indexquestion="' + indexQuestion + '"]').hide();
            elementID = '#input-' + $(this).val() + '-' + indexQuestion;
            $(elementID).fadeIn();
        })

        $('#submitAnswer').on('click', function (e) {
            e.preventDefault();
            elQuestions = $('.m-content').find('.response-answer');
            token = $("input[name='_token']").val();
            $.each(elQuestions, function (key, element) {
                element = $(element)
                question_id = element.attr('data-id');
                category_id = element.attr('category-id');
                answer = element.find('.checkbox-answer:checked').val();

                var formData = new FormData();
                formData.append("_token", token);
                formData.append("assessment_id", assessment_id);
                formData.append("answer", answer);
                formData.append("question_id", question_id);
                formData.append("category_id", category_id);
                formData.append("answer", answer);

                checkValidate = true;
                switch (answer) {
                    case 'yes':
                        note = element.find('.yes-note').val();
                        fileName = element.find('.yes-attachment-name').val();
                        files = element.find('.yes-attachment')[0].files;
                        if(files.length){
                            attachment = files[0];
                            formData.append("yes_attachment", attachment, attachment.name);
                        }
                        formData.append("yes_note", note);
                        formData.append("yes_attachment_name", fileName);
                        break;
                    case 'no':
                        employee = element.find('.select-no-employee').val();
                        date = element.find('.date-no').val();
                        formData.append("no_employee", employee);
                        formData.append("no_date", date);
                        break;
                    case 'improve':
                        note = element.find('.improve-note').val();
                        fileName = element.find('.improve-attachment-name').val();
                        files = element.find('.improve-attachment')[0].files;
                        if(files.length){
                            attachment = files[0];
                            formData.append("improve_attachment", attachment, attachment.name);
                        }
                        employee = element.find('.select-improve-employee').val();
                        date = element.find('.date-improve').val();
                        formData.append("improve_note", note);
                        formData.append("improve_employee", employee);
                        formData.append("improve_date", date);
                        formData.append("improve_attachment_name", fileName);
                        break;
                    default:
                        break;
                }
                if (checkValidate && typeof answer != 'undefined') {
                    $.ajax({
                        type: "POST",
                        url: '{{route("save_log_assessment")}}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            // your callback here
                        },
                        error: function (error) {
                            // handle error
                        },
                    });
                }
            })
        })

        $('.custom-file-input').on('change', function () {
            element = $(this).parent().parent().parent();
            value = $(this).val();
            elementName = element.find('.attachment-name').val(value.replace("C:\\fakepath\\", ""));
        })
    })
</script>
<style>
    .m-portlet.m-portlet--primary.m-portlet--head-solid-bg .m-portlet__head {
        background-color: #0086c4;
        border-color: #0086c4;
    }
</style>
@endsection