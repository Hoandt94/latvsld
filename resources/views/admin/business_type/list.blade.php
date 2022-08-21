
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã loại hình</th>
                                    <th>Tên loại hình</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($types as $type)
                                <tr>
                                    <th scope="row">{{$type->id}}</th>
                                    <td>{{$type->code}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete_business_type" data-id="{{$type->id}}">Delete</button>
                                        <button class="btn btn-success btn-sm edit_business_type" data-id="{{$type->id}}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12">
                            {{ $types->links() }}
</div>
                        </div>