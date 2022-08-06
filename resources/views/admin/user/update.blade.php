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
                <!-- <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Danh sách</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</div>
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-xl-12">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Update thông tin người dùng
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form class="m-form" action="{{route('update_user', [$user->id])}}" method="post">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Tên đăng nhập:</label>
                            <div class="col-lg-6">
                                <input type="text" name="username" class="form-control m-input" placeholder="Tên đăng nhập" value="{{$user->username}}">
                            </div>
                        </div>
                        <!-- <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Mật khẩu:</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" class="form-control m-input" placeholder="Mật khẩu" value="{{$user->username}}>
                            </div>
                        </div> -->
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Họ và tên:</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control m-input" placeholder="Họ và tên" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Điện thoại:</label>
                            <div class="col-lg-6">
                                <input type="text" name="phone" class="form-control m-input" placeholder="Điện thoại" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-6">
                                <input type="text" name="email" class="form-control m-input" placeholder="Email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Ngành nghề đặc thù:</label>
                            <div class="col-lg-6">
                                <input type="text" name="specific_profession" class="form-control m-input" placeholder="Ngành nghề đặc thù" value="{{$user->specific_professions}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Bộ phận chức vụ:</label>
                            <div class="col-lg-6">
                                <input type="text" name="position" class="form-control m-input" placeholder="Bộ phận chức vụ" value="{{$user->position}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Công ty:</label>
                            <div class="col-lg-6">
                                <input type="text" name="company" class="form-control m-input" placeholder="Công ty" value="{{$user->company}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Tình trạng:</label>
                            <div class="col-lg-6">
                                <div class="m-checkbox-list">
                                    <label class="m-checkbox">
                                        @if(!empty($user->status))
                                        <input type="checkbox" name ="status" checked="1" value="1"> Đang hoạt động
                                        @else
                                        <input type="checkbox" name ="status" checked="0" value="1"> Đang hoạt động
                                        @endif
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__group form-group row">
                            <label class="col-3 col-form-label">Loại tài khoản</label>
                            <div class="col-9">
                                <div class="m-radio-list">
                                    <label class="m-radio">
                                        @if($user->role == 'user')
                                        <input type="radio" name="role" value="user" checked="1"> Tài khoản thường
                                        @else
                                        <input type="radio" name="role" value="user"> Tài khoản thường
                                        @endif
                                        <span></span>
                                    </label>
                                    <label class="m-radio">
                                        @if($user->role == 'admin')
                                        <input type="radio" name="role" value="user" checked="1"> Tài khoản admin công ty
                                        @else
                                        <input type="radio" name="role" value="user"> Tài khoản admin công ty
                                        @endif
                                        <span></span>
                                    </label>
                                    <label class="m-radio">
                                        @if($user->role == 'system_admin')
                                        <input type="radio" name="role" value="user" checked="1"> Tài khoản admin hệ thống
                                        @else
                                        <input type="radio" name="role" value="user"> Tài khoản admin hệ thống
                                        @endif
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>
    </div>
</div>
@endsection