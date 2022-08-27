
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service_packs as $service_pack)
                                <tr>
                                    <th scope="row">{{$service_pack->id}}</th>
                                    <td>{{$service_pack->name}}</td>
                                    <td>{{$service_pack->description}}</td>
                                    <td>{{number_format($service_pack->price, 0)}}</td>
                                    <td>
                                    @if($service_pack->status)
                                    <span class="m-badge m-badge--success m-badge--wide m-badge--rounded mr-3">Đang hoạt động</span></td>
                                    @else
                                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded mr-3">Ngừng hoạt động</span></td>    
                                    @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm edit_service_pack" data-id="{{$service_pack->id}}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $service_packs->links() }}
                            </div>
                        </div>