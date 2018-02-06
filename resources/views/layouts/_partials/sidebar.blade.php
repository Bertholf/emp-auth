<div class="site-menubar">
    <ul class="site-menu">

        <li class="site-menu-item {{ checkActiveRoute(route('common.dashboard', [], false), true, 'active open') }}">
            <a href="{{ route('common.dashboard') }}">
                <i class="site-menu-icon fas fa-tachometer-alt fa-fw" aria-hidden="true"></i>
                <span class="site-menu-title">{{ trans('apps.dashboard.title') }}</span>
            </a>
        </li>

    </ul>
</div>
