<ul>
    @foreach($categories as $key => $category)
    <li class="wtree-item">
        <span class="wtree-item-text">
            {{!empty($parent_code) ? $parent_code . '.'. ($key+1) : ($key+1)}} - {{$category->name}}
        </span>
        <div class="folow-up" style=" position: absolute; right: 30px;top: 5px; cursor: pointer;">
            <button class="btn btn-sm btn-success create_sub" data-id="{{$category->id}}">
                <i class="la la-plus"></i>
            </button>
            <button class="btn btn-sm btn-success edit_category" data-id="{{$category->id}}">
                <i class="la la-edit"></i>
            </button>
        </div>
        @if(!empty($category->getSubCategory))
        @include('admin.category.list_sub_category', ['categories' => $category->getSubCategory, 'parent_code' => !empty($parent_code) ? $parent_code . '.'. ($key+1) : ($key+1)])
        @endif
    </li>
    @endforeach
</ul>