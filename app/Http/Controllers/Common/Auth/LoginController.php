<?php

namespace App\Http\Controllers\Common\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Breadcrumbs;
use SEO;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login
     * @return string
     */
    public function redirectTo()
    {
        /* @TODO: Add Admin Access
        if (access()->allow('view-backend')) {
            return route('admin.dashboard');
        }
        */
        return route('dashboard');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // Intended redirect after login
        if (session()->has('_previous')) {
            session()->put('url.intended', url()->previous());
        }

        // Get Social Links
        $socialite_links = check_sso_provider();

        // Configure Meta
        $meta = [
            'title' => trans('auth.action.login.title'),
            'breadcrumb' => trans('auth.action.login.title'),
        ];

        // Set Page Meta
        //SEO::setTitle($title);
        //SEO::opengraph()->addProperty('locale', app()->getLocale());

        // Set Breadcrumbs
        Breadcrumbs::push('<i class="fa fa-home"></i>', route('marketing.index'));
        Breadcrumbs::push($meta['breadcrumb'], '#');

        return view('common.auth.login', compact('meta', 'token', 'socialite_links'));
    }


    /**
     * @param Request $request
     * @param \App\Models\Actor\User\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    protected function authenticated(Request $request, $user)
    {
        /**
         * Check to see if the users account is confirmed and active
         */

        // check config for user confirmation
        if (config('common.auth.settings.confirm_email')) {
            if (! $user->isConfirmed()) {
                access()->logout();
                throw new GeneralException(trans('auth.exception.confirmation.resend', ['user_id' => $user->id]));
            } elseif (! $user->isActive()) {
                access()->logout();
                throw new GeneralException(trans('auth.exception.deactivated'));
            }
        } elseif (! $user->isActive()) {
            access()->logout();
            throw new GeneralException(trans('auth.exception.deactivated'));
        }

        // Trigger Event
        //event(new UserLoggedIn($user));

        // Return Redirect
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        /*
        // Remove the socialite session variable if exists
        if (app('session')->has(config('actor.socialite_session_name'))) {
            app('session')->forget(config('actor.socialite_session_name'));
        }

        // Remove any session data from backend
        app()->make(Auth::class)->flushTempSession();

        // Trigger Event
        //event(new UserLoggedOut($this->guard()->user()));
        */

        // Laravel specific logic
        Auth::logout();

        // Redirect back as unauthenticated
        return redirect('/');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        //If for some reason route is getting hit without someone already logged in
        if (! access()->user()) {
            return redirect()->route('common.auth.login');
        }

        //If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Save admin id
            $admin_id = session()->get('admin_user_id');

            app()->make(Auth::class)->flushTempSession();

            // Re-login admin
            access()->loginUsingId((int)$admin_id);

            // Redirect to backend user page
            return redirect('/'); // @TODO: ->route('admin.common.user.manage.index');
        } else {
            app()->make(Auth::class)->flushTempSession();

            //Otherwise logout and redirect to login
            access()->logout();
            return redirect()->route('common.auth.login');
        }
    }
}
