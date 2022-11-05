
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Loại</th>
                                    <th>Nội dung câu hỏi</th>
                                    <th>Biểu mẫu, ví dụ tham khảo</th>
                                    <th>Nội dung yêu cầu</th>
                                    <th>Người chịu trách nhiệm</th>
                                    <th>Ngày hoàn thành dự kiến</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($answers as $key => $answer)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>
                                        {{$answer->answer == 'improve' ? "Cải thiện" : "Không"}}
                                    </td>
                                    <td>
                                        <a href="{{route('run_category_assessment', ['slug_assessment' => $answer->getAssessment->slug(), 'slug_category' => $answer->getQuestion->getCategory->slug()])}}">{{$answer->getQuestion->content}}</a>
                                    </td>
                                    <td>
                                        <a href="{{url('/') . $answer->getQuestion->sample_attachment}}">{{basename($answer->getQuestion->sample_attachment)}}</a>
                                    </td>
                                    @if($answer->answer == 'improve')
                                    <td>
                                        {{$answer->improve_note}}
                                    </td>
                                    @elseif($answer->answer == 'no')
                                    <td>
                                        {{$answer->no_note}}
                                    </td>
                                    @endif
                                    @if($answer->answer == 'improve')
                                    <td>
                                        {{$answer->getImproveEmployee->name}}
                                    </td>
                                    @elseif($answer->answer == 'no')
                                    <td>
                                        {{$answer->getNoEmployee->name}}
                                    </td>
                                    @endif
                                    @if($answer->answer == 'improve')
                                    <td>
                                        {{$answer->improve_finish_date}}
                                    </td>
                                    @elseif($answer->answer == 'no')
                                    <td>
                                        {{$answer->no_finish_date}}
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $answers->links() }}
                            </div>
                        </div>