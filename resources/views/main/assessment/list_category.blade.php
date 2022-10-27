@foreach($subCategories as $key => $category)
<?php 
    $questions = $category->getQuestionInSet($listQuestions);
    $subCategories = $category->getCategoryInSet($listCategories);
    $answers = $assessment->getQuestionAnswered($category->id);
?>
<tr>
    <td class="pl-5">
        @if(count($questions) !=0)
        <a href="{{route('run_category_assessment', ['slug_assessment' => $assessment->slug(), 'slug_category' => $category->slug()])}}">{{$parent_key}}.{{$key+1}}. {{$category->name}}</a>
        @else
        {{$parent_key}}.{{$key+1}}. {{$category->name}}
        @endif
    </td>
    <td>{{count($questions)}}</td>
    <td>{{count($answers)}}</td>
    @if(count($questions) !=0)
    <td>{{round((count($answers) / count($questions)) * 100)}}%</td>
    @else
    <td>0%</td>
    @endif
    <td>
        @if(count($questions) !=0)
        <a href="{{route('run_category_assessment', ['slug_assessment' => $assessment->slug(), 'slug_category' => $category->slug()])}}" class="btn btn-primary btn-sm">Đánh giá</a>
        <a href="{{route('result_category_assessment', ['slug_assessment' => $assessment->slug(), 'slug_category' => $category->slug()])}}" class="btn btn-primary btn-sm">Xem kết quả</a>
        @else
        <button class="btn btn-primary btn-sm">Đánh giá</button>
        <button class="btn btn-primary btn-sm">Xem kết quả</button>
        @endif
    </td>
    <tr>
    @if(!empty($subCategories))
        @include('main.assessment.list_category', ['subCategories' => $subCategories, 'listQuestions' => $listQuestions, 'listCategories' => $listCategories, 'assessment' => $assessment, 'parent_key' => $parent_key . '.' . ($key+1)])
    @endif
@endforeach