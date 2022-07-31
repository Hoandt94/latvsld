@extends('admin.template.index')
@section('subheader')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Quản lý chung</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Quản lý người dùng</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <div class="pull-right">
                <a href="#"
                    class="m-portlet__nav-link btn btn-lg btn-danger m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill">
                    <i class="la la-trash"></i>
                </a>
                <a href="#"
                    class="m-portlet__nav-link btn btn-lg btn-primary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill">
                    <i class="la la-plus"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh sách người dùng
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Họ và tên</th>
                                    <th>Công ty</th>
                                    <th>Điện thoại</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Gói đang dùng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Jhon</td>
                                    <td>Stone</td>
                                    <td>@jhon</td>
                                    <td>@jhon</td>
                                    <td>@jhon</td>
                                    <td>@jhon</td>
                                    <td>@jhon</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                        <button class="btn btn-success btn-sm">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection