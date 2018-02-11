<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
            <span class="sr-only">{{ trans('common.general.toggle_navigation') }}</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <a href="/">
                EmpAUTHable
                {{--<img class="navbar-brand-logo unfold" src="/images/logo.png" title="{{ config('app.name') }}">
                <img class="navbar-brand-logo fold" src="/images/logo-box.png" title="{{ config('app.name') }}">--}}
            </a>
        </div>
        <!-- Search -->
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search" data-toggle="collapse">
            <span class="sr-only">{{ trans('common.general.toggle_search') }}</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
        <!-- /Search -->
    </div>
    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">{{ trans('common.general.toggle_menubar') }}</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>

                <!-- Navbar Header Links -->

                @if(Auth::guest())
                    @include('layouts._partials.nav_links')
                @else
                    {{-- Authorized --}}
                @endif

            </ul>
            <!-- /Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            @if(Auth::guest())
                <li class="nav-item"><a href="{!! route('common.auth.login') !!}" class="nav-link">{{ trans('auth.action.login.label') }}</a></li>
                @if (config('auth.registration'))
                <li class="nav-item"><a href="{!! route('auth.register') !!}" class="nav-link" target="_blank">{{ trans('auth.register_button') }}</a></li>
                @endif
            @else
                <!-- Language Menu -->
                @include('layouts._partials.nav_lang')
                <!-- /Language Menu -->

                <!-- User Menu -->
                @include('layouts._partials.nav_user')
                <!-- /User Menu -->

            @endif
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
    </div>
</nav>
