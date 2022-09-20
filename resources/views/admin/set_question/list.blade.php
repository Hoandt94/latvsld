
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã bộ câu hỏi</th>
                                    <th>Tên bộ câu hỏi</th>
                                    <th>Số mục</th>
                                    <th>Số câu hỏi</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($setQuestions as $setQuestion)
                                <tr>
                                    <th scope="row">{{$setQuestion->id}}</th>
                                    <td>{{$setQuestion->code}}</td>
                                    <td>{{$setQuestion->name}}</td>
                                    <td>{{count(json_decode($setQuestion->categories))}}</td>
                                    <td>{{count(json_decode($setQuestion->questions))}}</td>
                                    <td>
                                    @if($setQuestion->status)
                                    <span class="m-badge m-badge--success m-badge--wide m-badge--rounded mr-3">Đang hoạt động</span></td>
                                    @else
                                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded mr-3">Ngừng hoạt động</span></td>    
                                    @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm edit_set_question" data-id="{{$setQuestion->id}}">Edit</button>
                                        <a href="{{route('config_set_question', [$setQuestion->id])}}" class="btn btn-info btn-sm">Config</a>
                                        <button class="btn btn-danger btn-sm delete_set_question" data-id="{{$setQuestion->id}}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>