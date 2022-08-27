
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã nghề đặc thù</th>
                                    <th>Tên nghề đặc thù</th>
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
                                    <button class="btn btn-success btn-sm edit_specific_profession" data-id="{{$job->id}}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete_specific_profession" data-id="{{$job->id}}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>