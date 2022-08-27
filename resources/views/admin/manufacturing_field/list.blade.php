
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã ngành kinh tế</th>
                                    <th>Tên ngành kinh tế</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fields as $field)
                                <tr>
                                    <th scope="row">{{$field->id}}</th>
                                    <td>{{$field->code}}</td>
                                    <td>{{$field->name}}</td>
                                    <td>
                                    @if($field->status)
                                    <span class="m-badge m-badge--success m-badge--wide m-badge--rounded mr-3">Đang hoạt động</span></td>
                                    @else
                                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded mr-3">Ngừng hoạt động</span></td>    
                                    @endif
                                    </td>
                                    <td>
                                    <button class="btn btn-success btn-sm edit_manufacturing_field" data-id="{{$field->id}}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>