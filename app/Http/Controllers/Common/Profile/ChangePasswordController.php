<?php

namespace App\Http\Controllers\Actor\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Actor\User\Profile\ChangePasswordRequest;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return mixed
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $this->user->changePassword($request->all());
        return redirect()->route('dashboard')->withFlashSuccess(trans('auth.action.password_reset.message.success'));
    }
}
