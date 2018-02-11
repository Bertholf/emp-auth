@if(auth()->user())
<li class="nav-item dropdown dropdown-fw dropdown-mega">
	@if(count(auth()->user()->teams) && auth()->user()->currentTeam)
		<a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false" data-animation="fade" role="button">
			@if(config('actor.team.has_identity'))
				Add Image
			@endif
			{{ auth()->user()->currentTeam->name }}
			<i class="fas fa-chevron-down m-l-5" aria-hidden="true"></i>
		</a>
		<div class="dropdown-menu" role="menu">
			<div class="mega-content">
				<div class="row">

					<div class="col-sm-12 col-md-8">
						<div class="nav-tabs-vertical">
							<ul class="nav nav-tabs nav-tabs-solid" style="height: 184px;">
							@if(count(auth()->user()->teams) > 1)
								@foreach (auth()->user()->teams as $team)
									@if(is_null(auth()->user()->currentTeam) || auth()->user()->currentTeam->id !== $team->id)
									<li>
										<a href="{{ route('actor.team.switch', $team) }}" class="dropdown-item">
											<i class="fas fa-sign-in fa-fw"></i>
											{{ $team->name }}
										</a>
										<!--span class="pull-sm-right tag tag-pill tag-raised tag-danger tag-xs">{{ trans('actor.team.team_switch') }}</span-->
									</li>
									@else
									<li class="active">
										<a href="#" class="dropdown-item active">
											<i class="fas fa-star fa-fw"></i>
											{{ $team->name }}
										</a>
									</li>
									@endif
								@endforeach
								<li>
									<a href="{{ route('actor.team.create') }}" class="dropdown-item">
										<i class="fas fa-plus fa-fw"></i>
										<span class="title"><em>{{ trans('actor.team.team_create') }}</em></span>
									</a>
								</li>
							@endif
							</ul>
							<div class="tab-content" style="height: 184px;">
								<div class="tab-pane active">

									@if(auth()->user()->currentTeam->owner_id == auth()->user()->id)
									<div class="ribbon ribbon-badge ribbon-primary ribbon-bottom ribbon-reverse">
										<span class="ribbon-inner">{{ trans('actor.team.team_owner') }}</span>
									</div>
									@else
									<div class="ribbon ribbon-badge ribbon-info ribbon-bottom ribbon-reverse">
										<span class="ribbon-inner">{{ trans('actor.team.team_member') }}</span>
									</div>
									@endif

									<h5>{{ auth()->user()->currentTeam->name }}</h5>
									<ul class="blocks-2">
										<li class="mega-menu m-0">
											<ul class="list-icons">
												<li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
													<a href="{{ route('actor.team.index') }}">{{ trans('actor.team.team_manage') }}</a>
												</li>
												<li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
													<a href="{{ route('actor.team.members', auth()->user()->currentTeam) }}">{{ trans('actor.team.team_members') }}</a>
												</li>
											</ul>
										</li>
									</ul>

								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
		</div>
	@else
		@if(count(auth()->user()->teams))
		<a href="{{ route('actor.team.index') }}" class="nav-link">
			{{ trans('actor.team.team_select') }}
			<i class="fas fa-chevron-down m-l-5"></i>
		</a>
		@else
		<a href="{{ route('actor.team.create') }}" class="nav-link">
			<i class="fas fa-plus m-r-5"></i>
			{{ trans('actor.team.team_create_first') }}
		</a>
		@endif
	@endif
</li>
@endif
