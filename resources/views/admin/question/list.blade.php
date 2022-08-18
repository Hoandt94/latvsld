<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Mã danh mục</th>
            <th>Danh mục</th>
            <th>Mã câu hỏi</th>
            <th>Nội dung câu hỏi</th>
            <th>Ngày sửa</th>
            <th>File đính kèm</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questions as $question)
        <tr>
            <td>{{$question->getCategory->code}}</td>
            <td>{{$question->getCategory->name}}</td>
            <td>{{$question->code}}</td>
            <td>{{$question->content}}</td>
            <td>{{$question->updated_at}}</td>
            <td>{{$question->sample_attachment}}</td>
            <td>
                <button class="btn btn-danger btn-sm">Delete</button>
                <a class="btn btn-success btn-sm" href="{{route('update_question', [$question->id])}}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-lg-12 pull-right">
        {{ $questions->links() }}
    </div>
</div>