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
                        <span class="m-nav__link-text">Quản lý nhóm người dùng</span>
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
                            Thêm nhóm người dùng
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form class="m-form">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Tên nhóm:</label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control m-input" placeholder="Tên nhóm">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">Mã nhóm:</label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control m-input" placeholder="Mã nhóm">
                            </div>
                        </div>
                        <div class="m-form__group form-group row">
                            <label class="col-3 col-form-label">Loại tài khoản</label>
                            <div class="col-9">
                                <div class="m-radio-list">
                                    <label class="m-radio">
                                        <input type="radio" name="example_6" value="1"> Tài khoản thường
                                        <span></span>
                                    </label>
                                    <label class="m-radio">
                                        <input type="radio" name="example_6" value="2"> Tài khoản admin công ty
                                        <span></span>
                                    </label>
                                    <label class="m-radio">
                                        <input type="radio" name="example_6" value="3"> Tài khoản admin hệ thống
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-success">Submit</button>
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