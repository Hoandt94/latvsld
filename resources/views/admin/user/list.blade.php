<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Họ và tên</th>
                                    <th>Công ty</th>
                                    <th>Điện thoại</th>
                                    <th>Tình trạng</th>
                                    <th>Loại tài khoản</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->company}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if($user->status)
                                    <td><button class="btn btn-success btn-sm">Đang hoạt động</button></td>
                                    @else
                                    <td><button class="btn btn-danger btn-sm">Ngừng hoạt động</button></td>
                                    @endif
                                    @if($user->role == 'system_admin')
                                    <td>Tài khoản admin hệ thống</td>
                                    @elseif($user->role == 'admin')
                                    <td>Tài khoản admin công ty</td>
                                    @else
                                    <td>Tài khoản thường</td>
                                    @endif
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                    <button class="btn btn-success btn-sm edit_user"
                                            data-id="{{$user->id}}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12 pull-right">
                            {{ $users->links() }}
</div>
                        </div>