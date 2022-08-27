
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã ngành kinh tế</th>
                                    <th>Tên ngành kinh tế</th>
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
                                    <button class="btn btn-success btn-sm edit_manufacturing_field" data-id="{{$field->id}}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete_manufacturing_field" data-id="{{$field->id}}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>