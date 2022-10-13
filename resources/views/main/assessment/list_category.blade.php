@foreach($subCategories as $category)
<?php 
    $questions = $category->getQuestionInSet($listQuestions);
    $subCategories = $category->getCategoryInSet($listCategories);
    $answers = $assessment->getQuestionAnswered($category->id);
?>
<tr>
    <td class="pl-5"><a href="{{route('run_category_assessment', ['slug_assessment' => $assessment->slug(), 'slug_category' => $category->slug()])}}">{{$category->name}}</a></td>
    <td>{{count($questions)}}</td>
    <td>{{count($answers)}}</td>
    @if(count($questions) !=0)
    <td>{{(count($answers) / count($questions)) * 100}}%</td>
    @else
    <td>0%</td>
    @endif
    <td>1</td>
    <tr>
    @if(!empty($subCategories))
        @include('main.assessment.list_category', ['subCategories' => $subCategories, 'listQuestions' => $listQuestions, 'listCategories' => $listCategories, 'assessment' => $assessment])
    @endif
@endforeach