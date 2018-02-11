<div class="collapse navbar-search-overlap" id="site-navbar-search">
	{!! Form::open(['route' => 'search']) !!}
		<div class="form-group">
			<div class="input-search">
				<i class="input-search-icon wb-search" aria-hidden="true"></i>
				<input type="text" class="form-control" name="query" placeholder="{{ trans('common.search.placeholder') }}">
				<button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="{{ trans('common.general.close') }}"></button>
			</div>
		</div>
	{!! Form::close() !!}
</div>
