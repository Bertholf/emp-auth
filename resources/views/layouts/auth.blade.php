<!doctype html>
<html class="no-js css-menubar" lang="{{ app()->getLocale() }}">
<head>
	{!! SEO::generate() !!}
	@yield('meta')

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<link rel="shortcut icon" href="/favicon.ico" />
	<meta name="_token" content="{{ csrf_token() }}" />
	@yield('before-styles-end')

	<link rel="stylesheet" href="{{ mix('css/core.css') }}">
	<link rel="stylesheet" href="{{ mix('css/plugins.css') }}">
	<link rel="stylesheet" href="{{ mix('css/fonts/fonts.css') }}">
	<link rel="stylesheet" href="{{ mix('css/auth.css') }}">

	<!--[if lt IE 9]>
	<script src="{{ mix('js/ie9.js') }}"></script>
	<![endif]-->

	<!--[if lt IE 10]>
	<script src="{{ mix('js/ie10.js') }}"></script>
	<![endif]-->

	<script src="{{ mix('js/header.js') }}"></script>
	<script>
		Breakpoints();
	</script>

	@yield('after-styles-end')
	@include('layouts._partials.ga')
</head>
<body class="page-login-v2 layout-full page-dark">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Page -->
<div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
	<div class="page-content">
		<div class="page-brand-info">
			<div class="brand">
				<h2 class="font-size-40">{{ trans('marketing.splash.title') }}</h2>
			</div>
			<p class="font-size-20">{{ trans('marketing.splash.description') }}</p>
		</div>
		<div class="page-login-main">
			<div class="brand hidden-md-up">
				<h3 class="font-size-40">{{ trans('marketing.splash.text') }}</h3>
			</div>
			@include('layouts._partials.alerts')
			@yield('content')
			<footer class="page-copyright">
				<p>
					@include('layouts._partials.footer_credit')
				</p>				
			</footer>
		</div>
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
