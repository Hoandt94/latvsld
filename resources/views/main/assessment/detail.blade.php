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
                            Danh mục đánh giá: {{$assessment->name}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="45%">Danh mục</th>
                                <th>Số câu hỏi</th>
                                <th>Số câu đã trả lời</th>
                                <th>Tỉ lệ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $categories = $assessment->setQuestion->getCategories();
                                $listQuestions = json_decode($assessment->setQuestion->questions, true);
                                $listCategories = json_decode($assessment->setQuestion->categories, true);
                            ?>
                            @foreach($categories as $key => $category)
                            <?php 
                                $subCategories = $category->getCategoryInSet($listCategories);
                            ?>
                            <tr>
                                <td colspan="5">
                                    <a>{{$key + 1}}. {{$category->name}}</a>
                                </td>
                            </tr>
                            @if(!empty($subCategories))
                            @include('main.assessment.list_category', ['subCategories' => $subCategories, 'listQuestions' => $listQuestions, 'listCategories' => $listCategories, 'assessment' => $assessment, 'parent_key' => $key + 1])
                            @endif
                            @endforeach
                        </tbody>
                    </table>
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
    
</script>
@endsection