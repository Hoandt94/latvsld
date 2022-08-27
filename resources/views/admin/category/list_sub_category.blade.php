<ul>
    @foreach($categories as $key => $category)
    <li class="wtree-item">
        <span class="wtree-item-text">
            {{!empty($parent_code) ? $parent_code . '.'. ($key+1) : ($key+1)}} - {{$category->name}}
        </span>
        <div class="folow-up" style=" position: absolute; right: 30px;top: 5px; cursor: pointer;">
            @if($category->status)
            <span class="m-badge m-badge--success m-badge--wide m-badge--rounded mr-3">Đang hoạt động</span></td>
            @else
            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded mr-3">Ngừng hoạt động</span></td>    
            @endif
            <button class="btn btn-sm btn-primary create_sub" data-id="{{$category->id}}">
                <i class="la la-plus"></i>
            </button>
            <button class="btn btn-sm btn-info edit_category" data-id="{{$category->id}}">
                <i class="la la-edit"></i>
            </button>
        </div>
        @if(!empty($category->getSubCategory))
        @include('admin.category.list_sub_category', ['categories' => $category->getSubCategory, 'parent_code' => !empty($parent_code) ? $parent_code . '.'. ($key+1) : ($key+1)])
        @endif
    </li>
    @endforeach
</ul>