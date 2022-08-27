
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã công ty</th>
                                    <th>Tên công ty</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                <tr>
                                    <th scope="row">{{$company->id}}</th>
                                    <td>{{$company->code}}</td>
                                    <td>{{$company->name}}</td>
                                    <td>
                                    @if($company->status)
                                    <span class="m-badge m-badge--success m-badge--wide m-badge--rounded mr-3">Đang hoạt động</span></td>
                                    @else
                                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded mr-3">Ngừng hoạt động</span></td>    
                                    @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm edit_company" data-id="{{$company->id}}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $companies->links() }}
                            </div>
                        </div>