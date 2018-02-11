        <li class="nav-item {{ check_active_route(route('marketing.index', [], false), true, 'active') }}">
            <a class="nav-link" href="{!! route('marketing.index') !!}">{{ trans('marketing.home.title') }}</a>
        </li>
