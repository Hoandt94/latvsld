@foreach($subCategories as $key => $category)
<?php 
    $subCategories = $category->getCategoryInSet($listCategories);
    $count = $assessment->countQuestionAnswered($category->id);
    $countYes = $assessment->countAnswerYes($category->id);
    $countNo = $assessment->countAnswerNo($category->id);
    $countImprove = $assessment->countAnswerImprove($category->id);
?>
<tr>
    <td class="pl-5">
        {{$parent_key}}.{{$key+1}}. {{$category->name}}
    </td>
    <td>
        <a>{{$count}}</a>
    </td>
    <td>
        <a>{{$countYes}}</a>
    </td>
    <td>
        <a>{{$countNo}}</a>
    </td>
    <td>
        <a>{{$countImprove}}</a>
    </td>
<tr>
@if(!empty($subCategories))
    @include('main.assessment.list_category_result', ['subCategories' => $subCategories, 'listCategories' => $listCategories, 'assessment' => $assessment, 'parent_key' => $parent_key . '.' . ($key+1)])
@endif
@endforeach