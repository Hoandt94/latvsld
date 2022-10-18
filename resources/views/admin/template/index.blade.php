<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		@yield('meta_section')
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Arial:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script> -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
		<style>
			* {
				font-family: 'Open Sans' !important;
			}
		</style>
        @include('admin.template.header_asset')
        @yield('header_asset')
	</head>
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<div class="m-grid m-grid--hor m-grid--root m-page">
            @include('admin.template.header_menu')
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                @include('admin.template.menu')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
                    @yield('subheader')
					<div class="m-content">
                        @yield('content')
					</div>
				</div>
			</div>
			@include('admin.template.footer')
		</div>
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		
		@include('admin.template.footer_asset')
        @yield('footer_asset')
	</body>

	<!-- end::Body -->
</html>