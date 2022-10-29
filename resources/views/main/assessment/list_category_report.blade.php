@foreach($subCategories as $key => $category)
<?php 
    $subCategories = $category->getCategoryInSet($listCategories);
    $count = $assessment->countQuestionAnswered($category->id);
    $countYes = $assessment->countAnswerYes($category->id);
    $countNo = $assessment->countAnswerNo($category->id);
    $countImprove = $assessment->countAnswerImprove($category->id);

    // $dataChartDetail[$category->id] = $count;
    // $dataChartDetailYes[$category->id] = $countYes;
    // $dataChartDetailNo[$category->id] = $countNo;
    // $dataChartDetailImprove[$category->id] = $countImprove;
    // $dataChartDetailLabel[$category->id] = $category->name;
?>
@if($count!=0)
<tr>
    <td class="pl-5">
        {{$category->name}}
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
<tr>
@if(!empty($subCategories))
    @include('main.assessment.list_category', ['subCategories' => $subCategories, 'listCategories' => $listCategories, 'assessment' => $assessment, 'parent_key' => $parent_key . '.' . ($key+1)])
@endif
@endif
@endforeach