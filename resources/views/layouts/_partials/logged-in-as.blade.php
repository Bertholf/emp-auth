{{--
@if ($logged_in_user && session()->has("admin_user_id") && session()->has("temp_user_id"))
	<div class="alert alert-warning logged-in-as">
		You are currently logged in as {{ $logged_in_user->getDisplayName() }}. <a href="{{ route("actor.user.auth.logout-as") }}">Re-Login as {{ session()->get("admin_user_name") }}</a>.
	</div><!--alert alert-warning logged-in-as-->
@endif
--}}
