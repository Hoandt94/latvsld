<ul>
    @foreach($categories as $category)
    <li class="wtree-item">
        <span class="wtree-item-text">
            <label class="m-checkbox">
                <input type="checkbox" name="categories" value="{{$category->id}}"> {{$category->code}} - {{$category->name}}
                <span></span>
            </label>
        </span>
        @if(!empty($category->getSubCategory))
        @include('admin.set_question.list_sub_category', ['categories' => $category->getSubCategory])
        @endif
        @if(!empty($category->getQuestion))
        @include('admin.set_question.list_question', ['questions' => $category->getQuestion])
        @endif
    </li>
    @endforeach
</ul>