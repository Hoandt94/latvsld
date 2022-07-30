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
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Danh sách</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <div class="pull-right">
                <a href="#" class="m-portlet__nav-link btn btn-lg btn-primary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill">
                    <i class="la la-plus"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<h1>This is content</h1>
@endsection