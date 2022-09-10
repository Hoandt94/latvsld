<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>An toàn vệ sinh lao động™ - Đăng nhập</title>
		<meta name="description" content="An toàn vệ sinh lao động™ - Đăng nhập">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>
		<link href="{{asset('css/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="../../../assets/demo/default/media/img/logo/favicon.ico" />
	</head>
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" >
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{{asset('images/logos/hse_logo.png')}}" width="100">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">Đăng nhập hệ thống</h3>
							</div>
							@if(!empty($errors->any()))
							<div class="alert alert-danger" role="alert">
								@foreach ($errors->all() as $error)
								<strong>Lỗi!</strong> {{ $error }}
								@endforeach
							</div>
							@endif
							<form class="m-login__form m-form" action="{{route('post_login')}}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Username" name="username" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-right m-login__form-right">
										<a href="javascript:;" id="m_login_forget_password" class="m-link">Quên mật khẩu</a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">Đăng nhập</button>
								</div>
							</form>
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">Forgotten Password ?</h3>
								<div class="m-login__desc">Enter your email to reset your password:</div>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Request</button>&nbsp;&nbsp;
									<button id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="{{asset('js/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/scripts.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/login.js')}}" type="text/javascript"></script>
	</body>
</html>