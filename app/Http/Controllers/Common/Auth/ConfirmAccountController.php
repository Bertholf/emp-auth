<?php

namespace App\Http\Controllers\Common\Auth;

use App\Http\Controllers\Controller;
use App\Models\Common\User\User;
//use App\Notifications\Actor\User\UserNeedsConfirmation;

class ConfirmAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $token
     * @return mixed
     */
    public function confirm($token)
    {
        $this->user->confirmAccount($token);

        if (auth()->user()) {
            // If logged in already just send to profile
            return redirect()->route('actor.user.profile')->withFlashSuccess(trans('actor.user.auth.exception.confirmation.success'));
        } else {
            // If not logged in, send to login screen
            return redirect()->route('actor.user.auth.login')->withFlashSuccess(trans('actor.user.auth.exception.confirmation.success'));
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    public function sendConfirmationEmail(User $user)
    {
        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        if (auth()->user()) {
            // If logged in already just send to profile
            return redirect()->route('actor.user.profile')->withFlashSuccess(trans('actor.user.auth.exception.confirmation.resent'));
        } else {
            // If not logged in, send to login screen
            return redirect()->route('actor.user.auth.login')->withFlashSuccess(trans('actor.user.auth.exception.confirmation.resent'));
        }
    }
}
