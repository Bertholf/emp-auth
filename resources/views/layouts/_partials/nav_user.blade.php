	<li class="nav-item dropdown">
		<a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
			<span class="avatar avatar-online">
				<img src="{!! $logged_in_user->getPicture() !!}" alt="{{ $logged_in_user->getDisplayName() }}" />
				<i></i>
			</span>
		</a>
		<div class="dropdown-menu" role="menu">
			<a class="dropdown-item" href="{!! route('common.dashboard') !!}" role="menuitem"><i class="fas fa-tachometer-alt fa-fw" aria-hidden="true"></i> {{ trans('common.tabs.dashboard') }}</a>
			@if(config('social-network.enable_following'))
			<a class="dropdown-item" href="{!! route('actor.user.profile.show', access()->user()->name_slug) !!}" role="menuitem"><i class="fas fa-eye fa-fw" aria-hidden="true"></i> {{ trans('actor.user.selfmanage.profile_view') }}</a>
			@endif
			<a class="dropdown-item" href="{!! route('actor.user.profile') !!}" role="menuitem"><i class="fas fa-cogs fa-fw" aria-hidden="true"></i> {{ trans('actor.user.selfmanage.account') }}</a>
			<a class="dropdown-item" href="{!! route('actor.team.index') !!}" role="menuitem"><i class="fas fa-briefcase fa-fw" aria-hidden="true"></i> {{ trans('common.tabs.teams') }}</a>
			{{--}}@permission('view-admin')
        @endauth--}}
			<div class="dropdown-divider" role="presentation"></div>
			<a class="dropdown-item" href="{!! route('admin.dashboard') !!}" role="menuitem"><i class="fas fa-user-secret fa-fw" aria-hidden="true"></i> {{ trans('common.tabs.admin') }}</a>

			<div class="dropdown-divider" role="presentation"></div>
			<a class="dropdown-item" href="{!! route('actor.user.auth.logout') !!}" role="menuitem"><i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i> {{ trans('actor.user.auth.logout') }}</a>
		</div>
	</li>
