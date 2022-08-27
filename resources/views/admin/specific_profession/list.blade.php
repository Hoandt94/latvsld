
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã nghề đặc thù</th>
                                    <th>Tên nghề đặc thù</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <th scope="row">{{$job->id}}</th>
                                    <td>{{$job->code}}</td>
                                    <td>{{$job->name}}</td>
                                    <td>
                                    @if($type->status)
                                    <span class="m-badge m-badge--success m-badge--wide m-badge--rounded mr-3">Đang hoạt động</span></td>
                                    @else
                                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded mr-3">Ngừng hoạt động</span></td>    
                                    @endif
                                    </td>
                                    <td>
                                    <button class="btn btn-success btn-sm edit_specific_profession" data-id="{{$job->id}}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>