<ul class="wtree">
    @foreach($categories as $category)
    <li class="wtree-item">
        <span>
            {{$category->code}} - {{$category->name}}
        </span>
        <div class="folow-up" style=" position: absolute; right: 30px;top: 5px; cursor: pointer;">
            <button class="btn btn-sm btn-success create_sub" data-id="{{$category->id}}">
                <i class="la la-plus"></i>
            </button>
            <button class="btn btn-sm btn-success edit_category" data-id="{{$category->id}}">
                <i class="la la-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger">
                <i class="la la-trash delete_category" data-id="{{$category->id}}"></i>
            </button>
        </div>
        @if(!empty($category->getSubCategory))
        @include('admin.category.list_sub_category', ['categories' => $category->getSubCategory])
        @endif
    </li>
    @endforeach
</ul>

<div id="m_tree_3" class="list-category">
</div>