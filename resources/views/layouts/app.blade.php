<!doctype html>
<html class="no-js js-menubar" lang="{{ app()->getLocale() }}">
<head>
    @yield('meta')

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="shortcut icon" href="/favicon.ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}" />

    @yield('before-styles-end')
    <link rel="stylesheet" href="{{ mix('css/public.css') }}">
    <link rel="stylesheet" href="{{ mix('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ mix('css/fonts/fonts.css') }}">
    <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah">
    @yield('after-styles-end')

    @include('layouts._partials.ga')

    <!--[if lt IE 9]>
    <script src="{{ mix('js/ie9.js') }}"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="{{ mix('js/ie10.js') }}"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ mix('js/header.js') }}"></script>
</head>
<body class="public site-navbar-small site-menubar-hide {!! (!empty($body_class) ? $body_class : '') !!}">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="app" style="height: 100%">
    @include('layouts._partials.header')

    @if(!empty($splash) && $splash)
    <div class="page">
        <div class="page-content p-0">
            @yield('content')
        </div>
    </div>
    @else
        <!-- Page -->
        <div class="page">

            @if (!Request::path('/blog')) <!-- Hide Breadcrumb on Blog pages -->
            <div class="page-header">
                {!! Breadcrumbs::show() !!}
                @if(!empty($title))
                <h1 class="page-title">{{ $title }}</h1>
                @endif
                <div class="page-header-actions">
                    @yield('page-actions')
                </div>
            </div>
            @endif

            <div class="page-content">
                @include('layouts._partials.alerts')
                @yield('content')
            </div>
        </div>
        <!-- End Page -->
    @endif

    @include('layouts._partials.footer')
</div>

@yield('before-scripts-end')
<script src="{{ mix('js/core.js') }}"></script>
@yield('after-core-end')
<script src="{{ mix('js/plugins.js') }}"></script>
@yield('after-plugins-end')
<script src="{{ mix('js/scripts.js') }}"></script>
@yield('after-scripts-end')
<script src="{{ mix('js/config.js') }}"></script>
@yield('after-config-end')
<script src="{{ mix('js/page.js') }}"></script>
@yield('after-page-end')
<script src="{{ mix('js/app.js') }}"></script>
@yield('after-app-end')
<script>
    SITE_CONFIG = { url: '{!! url('/') !!}', csrf_token: '{!! csrf_token(); !!}' };
    @if(Auth::id())
    // Get Current User (If Logged)
    var currentUserId = {{ Auth::id() }};
    @endif
    // Ready Vue
    (function(document, window, $) {
        'use strict';
        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
</script>
@yield('after-inline-end')
</body>
</html>
