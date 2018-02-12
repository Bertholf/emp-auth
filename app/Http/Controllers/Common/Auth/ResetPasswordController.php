<?php

namespace App\Http\Controllers\Common\Auth;

use App\Common\Models\User\User;
use App\Common\Models\User\UserPasswordReset;
use App\Http\Controllers\Controller;
use App\Common\Libraries\Breadcrumbs;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('guest');
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    public function redirectPath()
    {
        return route('dashboard');
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\Response
     */
    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())->withFlashSuccess(trans('auth.action.password_reset.message.success'));
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm($token = null)
    {

        // Configure Meta
        $meta = [
            'title' => trans('auth.action.password_reset.title'),
            'breadcrumb' => trans('auth.action.password_reset.title'),
            'breadcrumb_parent' => trans('auth.action.login.title'),
        ];

        // Set Breadcrumbs
        Breadcrumbs::push('<i class="fa fa-home"></i>', route('marketing.index'));
        Breadcrumbs::push($meta['breadcrumb_parent'], route('common.auth.login'));
        Breadcrumbs::push($meta['breadcrumb'], '#');

        // Return View
        return view('common.auth.passwords.reset', compact('meta', 'token'));
    }

}
