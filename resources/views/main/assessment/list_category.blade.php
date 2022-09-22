@foreach($subCategories as $category)
<?php 
    $questions = $category->getQuestionInSet($listQuestions);
    $subCategories = $category->getCategoryInSet($listCategories);
?>
<tr>
    <td class="pl-5">{{$category->name}}</td>
    <td>{{count($questions)}}</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <tr>
    @if(!empty($subCategories))
        @include('main.assessment.list_category', ['subCategories' => $subCategories, 'listQuestions' => $listQuestions, 'listCategories' => $listCategories])
    @endif
@endforeach