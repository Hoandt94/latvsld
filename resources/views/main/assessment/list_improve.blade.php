
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã yêu cầu</th>
                                    <th>Nội dung yêu cầu</th>
                                    <th>Biểu mẫu, ví dụ tham khảo</th>
                                    <th>Ghi chú</th>
                                    <th>Người chịu trách nhiệm</th>
                                    <th>Ngày hoàn thành dự kiến</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($answers as $key => $answer)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$answer->getQuestion->code}}</td>
                                    <td>{{$answer->getQuestion->content}}</td>
                                    <td>
                                        <a href="{{url('/') . $answer->getQuestion->sample_attachment}}">{{basename($answer->getQuestion->sample_attachment)}}</a>
                                    </td>
                                    <td>
                                        {{$answer->improve_note}}
                                    </td>
                                    <td>
                                        {{$answer->getImproveEmployee->name}}
                                    </td>
                                    <td>
                                        {{$answer->improve_finish_date}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $answers->links() }}
                            </div>
                        </div>