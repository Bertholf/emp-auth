@if (config('locale.status') && count(config('locale.languages')) > 1)
<li class="nav-item dropdown">
	<a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up" aria-expanded="false" role="button">
		@if(auth()->user())
			@if(!empty(auth()->user()->language))
			<span class="flag flag-icon flag-icon-{{ auth()->user()->language }}"></span>
			@else
			<span class="flag flag-icon flag-icon-us"></span>
			@endif
		@elseif(session()->has('locale'))
			<span class="flag flag-icon flag-icon-{{ session()->has('locale') }}"></span>
		@else
			<span class="flag flag-icon flag-icon-us"></span>
		@endif
	</a>
	<div class="dropdown-menu" role="menu">
		@foreach (array_keys(config('locale.languages')) as $lang)
			@if ($lang != App::getLocale())
			<a class="dropdown-item" href="{{ route('actor.user.language.switcher', $lang) }}" role="menuitem">
				<span class="flag-icon flag-icon-{{ $lang }}"></span> {{ trans('common.languages.langs.'.$lang) }}</a>
			@endif
		@endforeach
	</div>
</li>
@endif
