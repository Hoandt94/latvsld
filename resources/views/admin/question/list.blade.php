<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Mã danh mục</th>
            <th>Danh mục</th>
            <th>Mã câu hỏi</th>
            <th>Nội dung câu hỏi</th>
            <th>Ngày sửa</th>
            <th>File đính kèm</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questions as $key => $question)
        <tr>
            <td>{{$question->getCategory->getCode()}}</td>
            <td>{{$question->getCategory->name}}</td>
            <td>{{$question->getCategory->getCode()}}.{{$question->order}}</td>
            <td>{{$question->content}}</td>
            <td>{{$question->updated_at}}</td>
            <td><a href="{{url('/') . $question->sample_attachment}}">{{basename($question->sample_attachment)}}</a></td>
            <td>
            @if($question->status)
            <span class="m-badge m-badge--success m-badge--wide m-badge--rounded mr-3">Đang hoạt động</span></td>
            @else
            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded mr-3">Ngừng hoạt động</span></td>    
            @endif
            </td>
            <td>
                <a class="btn btn-success btn-sm" href="{{route('update_question', [$question->id])}}">Edit</a>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="row">
    <div class="col-lg-12 pull-right">
        {{ $questions->links() }}
    </div>
</div>