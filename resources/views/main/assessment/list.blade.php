<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên kỳ đánh giá</th>
            <th>Bộ câu hỏi</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Ngày đánh giá cuối</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assessments as $key => $assessment)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>
                <a href="{{route('run_assessment', $assessment->slug())}}">{{$assessment->name}}</a>
            </td>
            <td>{{$assessment->setQuestion->name}}</td>
            <td>{{$assessment->created_at}}</td>
            <td>{{$assessment->updated_at}}</td>
            <td>{{$assessment->last_time_update}}</td>
            <td>
                <button class="btn btn-success btn-sm edit_assessment" data-id="{{$assessment->id}}">Edit</button>
                <a href="{{route('run_assessment', $assessment->id . '-' . $assessment->slug())}}" class="btn btn-primary btn-sm" data-id="1">Đánh giá</a>
                <a href="" class="btn btn-primary btn-sm" data-id="2">Xem kết quả</a>
                <button class="btn btn-primary btn-sm" id="update_personnel">Nhân sự</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>