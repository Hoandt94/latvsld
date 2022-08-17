
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã bộ câu hỏi</th>
                                    <th>Tên bộ câu hỏi</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($setQuestions as $setQuestion)
                                <tr>
                                    <th scope="row">{{$setQuestion->id}}</th>
                                    <td>{{$setQuestion->code}}</td>
                                    <td>{{$setQuestion->name}}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete_set_question" data-id="{{$setQuestion->id}}">Delete</button>
                                        <button class="btn btn-success btn-sm edit_set_question" data-id="{{$setQuestion->id}}">Edit</button>
                                        <a href="{{route('config_set_question', [$setQuestion->id])}}" class="btn btn-success btn-sm">Config</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>