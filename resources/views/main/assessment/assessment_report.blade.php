@extends('main.template.index')
@section('meta_section')
<title>ATVSLD | Kết quả đánh giá an toàn lao động</title>
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
                        <span class="m-nav__link-text">Kết quả đánh giá an toàn lao động</span>
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
        <div class="m-portlet m-portlet--tabs">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab"
                                href="#m_portlet_base_demo_1_1_tab_content" role="tab">
                                Báo cáo chung
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                href="#m_portlet_base_demo_1_2_tab_content" role="tab">
                                Báo cáo chi tiết
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                href="#m_portlet_base_demo_1_3_tab_content" role="tab">
                                Kế hoạch thực hiện
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="m_portlet_base_demo_1_1_tab_content" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="45%">Danh mục</th>
                                            <th>Có</th>
                                            <th>Không</th>
                                            <th>Cải thiện</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $categories = $assessment->setQuestion->getCategories();
                                            $dataChartTotal = [];
                                            $dataChartTotalYes = [];
                                            $dataChartTotalNo = [];
                                            $dataChartTotalImprove = [];
                                            $dataChartTotalLabel = [];
                                        ?>
                                        @foreach($categories as $key => $category)
                                        <?php 
                                           $count = $assessment->countQuestionAnswered($category->id);
                                           $countYes = $assessment->countAnswerYes($category->id);
                                           $countNo = $assessment->countAnswerNo($category->id);
                                           $countImprove = $assessment->countAnswerImprove($category->id);

                                           $dataChartTotal[] = $count;
                                           $dataChartTotalYes[] = $countYes;
                                           $dataChartTotalNo[] = $countNo;
                                           $dataChartTotalImprove[] = $countImprove;
                                           $dataChartTotalLabel[] = $category->name;
                                        ?>
                                        @if($count)
                                        <tr>
                                            <td>
                                                <a>{{$category->name}}</a>
                                            </td>
                                            <td>
                                                <a>{{$countYes ? round(($countYes / $count) * 100 , 2) . '%' : 0}}</a>
                                            </td>
                                            <td>
                                                <a>{{$countNo ? round(($countNo / $count) * 100, 2) . '%' : 0}}</a>
                                            </td>
                                            <td>
                                                <a>{{$countImprove ? round(($countImprove / $count) * 100, 2) . '%' : 0}}</a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div id="chart-total"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="m_portlet_base_demo_1_2_tab_content" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="45%">Danh mục</th>
                                            <th>Có</th>
                                            <th>Không</th>
                                            <th>Cải thiện</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $categories = $assessment->setQuestion->getCategories();
                                            $listCategories = json_decode($assessment->setQuestion->categories, true);
                                        ?>
                                        @foreach($categories as $key => $category)
                                        <?php 
                                            $subCategories = $category->getCategoryInSet($listCategories);
                                            $count = $assessment->countQuestionAnswered($category->id);
                                            $countYes = $assessment->countAnswerYes($category->id);
                                            $countNo = $assessment->countAnswerNo($category->id);
                                            $countImprove = $assessment->countAnswerImprove($category->id);

                                            $dataChartDetail[$category->id] = $count;
                                            $dataChartDetailYes[$category->id] = $countYes;
                                            $dataChartDetailNo[$category->id] = $countNo;
                                            $dataChartDetailImprove[$category->id] = $countImprove;
                                            $dataChartDetailLabel[$category->id] = $category->name;
                                        ?>
                                        @if($count)
                                        <tr>
                                            <td>
                                                <a>{{$category->name}}</a>
                                            </td>
                                            <td>
                                                <a>{{$countYes ? round(($countYes / $count) * 100 , 2) . '%' : 0}}</a>
                                            </td>
                                            <td>
                                                <a>{{$countNo ? round(($countNo / $count) * 100, 2) . '%' : 0}}</a>
                                            </td>
                                            <td>
                                                <a>{{$countImprove ? round(($countImprove / $count) * 100, 2) . '%' : 0}}</a>
                                            </td>
                                        </tr>
                                        @if(!empty($subCategories))
                                        @include('main.assessment.list_category_report', [
                                            'subCategories' => $subCategories, 
                                            'listCategories' => $listCategories, 
                                            'assessment' => $assessment, 
                                            'parent_key' => $key + 1,
                                            ])
                                        @endif
                                        @endif
                                        @dump($dataChartDetailLabel)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div id="chart-detail"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="m_portlet_base_demo_1_3_tab_content" role="tabpanel">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_asset')
<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $(document).ready(function(){
        dataChartTotal = JSON.parse('{!!json_encode($dataChartTotal)!!}');
        dataChartYes = JSON.parse('{!!json_encode($dataChartTotalYes)!!}');
        dataChartNo = JSON.parse('{!!json_encode($dataChartTotalNo)!!}');
        dataChartImprove = JSON.parse('{!!json_encode($dataChartTotalImprove)!!}');
        dataChartLabel = JSON.parse('{!!json_encode($dataChartTotalLabel)!!}');

        dataYes = []
        dataNo = []
        dataImprove = [];
        dataLabel = [];

        $.each(dataChartLabel, function(index, label){
            if(!dataChartTotal[index]) return;
            percentYes = (dataChartYes[index] / dataChartTotal[index]) * 100;
            percentNo = (dataChartNo[index] / dataChartTotal[index]) * 100;
            percentImprove = (dataChartImprove[index] / dataChartTotal[index]) * 100;
            
            dataYes.push(percentYes ? Number(percentYes.toFixed(2)) : 0);
            dataNo.push(percentNo ? Number(percentNo.toFixed(2)) : 0)
            dataImprove.push(percentImprove ? Number(percentImprove.toFixed(2)) : 0);
            dataLabel.push(label);

        })

        dataChart = [
            {
                name: "Có",
                data: dataYes
            },
            {
                name: "Không",
                data: dataNo
            },
            {
                name: "Cải thiện",
                data: dataImprove
            }
        ];

        Highcharts.chart('chart-total', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Biểu đồ chung'
            },
            xAxis: {
                categories: dataChartLabel
            },
            yAxis: {
                min: 0,
                max: 100,
                title: {
                    text: '%'
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: dataChart,
            credits: {
                enabled: false
            },
        });

        dataChartTotal = JSON.parse('{!!json_encode($dataChartDetail)!!}');
        dataChartYes = JSON.parse('{!!json_encode($dataChartDetailYes)!!}');
        dataChartNo = JSON.parse('{!!json_encode($dataChartDetailNo)!!}');
        dataChartImprove = JSON.parse('{!!json_encode($dataChartDetailImprove)!!}');
        dataChartLabel = JSON.parse('{!!json_encode($dataChartDetailLabel)!!}');

        dataYes = []
        dataNo = []
        dataImprove = [];
        dataLabel = [];

        $.each(dataChartLabel, function(index, label){
            console.log(label);
            if(!dataChartTotal[index]) return;
            // console.log(label)
            percentYes = (dataChartYes[index] / dataChartTotal[index]) * 100;
            percentNo = (dataChartNo[index] / dataChartTotal[index]) * 100;
            percentImprove = (dataChartImprove[index] / dataChartTotal[index]) * 100;
            
            dataYes.push(percentYes ? Number(percentYes.toFixed(2)) : 0);
            dataNo.push(percentNo ? Number(percentNo.toFixed(2)) : 0)
            dataImprove.push(percentImprove ? Number(percentImprove.toFixed(2)) : 0);
            dataLabel.push(label);

        })

        dataChart = [
            {
                name: "Có",
                data: dataYes
            },
            {
                name: "Không",
                data: dataNo
            },
            {
                name: "Cải thiện",
                data: dataImprove
            }
        ];
        
        Highcharts.chart('chart-detail', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Biểu đồ chi tiết'
            },
            xAxis: {
                categories: dataChartLabel
            },
            yAxis: {
                min: 0,
                max: 100,
                title: {
                    text: '%'
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: dataChart,
            credits: {
                enabled: false
            },
        });
    });
</script>
@endsection