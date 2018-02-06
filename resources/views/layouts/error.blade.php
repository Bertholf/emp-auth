<!doctype html>
<html class="no-js css-menubar" lang="{{ app()->getLocale() }}">
<head>
	{{--{!! SEO::generate() !!}--}}
	@yield('meta')

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<link rel="shortcut icon" href="/favicon.ico" />
	<meta name="_token" content="{{ csrf_token() }}" />
	@yield('before-styles-end')

	<link rel="stylesheet" href="{{ mix('css/core.css') }}">
	<link rel="stylesheet" href="{{ mix('css/plugins.css') }}">
	<link rel="stylesheet" href="{{ mix('css/fonts/fonts.css') }}">
	<link rel="stylesheet" href="{{ mix('css/error.css') }}">

	<!--[if lt IE 9]>
	<script src="{{ mix('js/ie9.js') }}"></script>
	<![endif]-->

	<!--[if lt IE 10]>
	<script src="{{ mix('js/ie10.js') }}"></script>
	<![endif]-->

	<!-- Scripts -->
	<script src="{{ mix('js/header.js') }}"></script>
	<script>
		Breakpoints();
	</script>
	@yield('after-styles-end')
	@include('layouts._partials.ga')
</head>
<body class="animsition page-error page-error-503 layout-full">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Page -->

<div class="page vertical-align text-xs-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
	<div class="page-content vertical-align-middle">
		@include('layouts._partials.alerts')
		@yield('content')
		<a class="btn btn-primary btn-round" href="{{ route('marketing.index') }}">{{ trans('common.tabs.home_return') }}</a>

		<footer class="page-copyright">
			<p>
				@include('layouts._partials.footer_credit')
			</p>
			<div class="social">
				@include('layouts._partials.footer_social')
			</div>
		</footer>
	</div>
</div>
<!-- End Page -->
@yield('before-scripts-end')
<script src="{{ mix('js/core.js') }}"></script>
<script src="{{ mix('js/plugins.js') }}"></script>
<script src="{{ mix('js/scripts.js') }}"></script>
<script src="{{ mix('js/config.js') }}"></script>
<script src="{{ mix('js/page.js') }}"></script>
<script>
	(function(document, window, $) {
		'use strict';
		var Site = window.Site;
		$(document).ready(function() {
			Site.run();
		});
	})(document, window, jQuery);
</script>
@yield('after-scripts-end')
</body>
</html>
