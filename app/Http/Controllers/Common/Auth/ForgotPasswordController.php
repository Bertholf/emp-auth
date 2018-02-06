<?php

namespace App\Http\Controllers\Common\Auth;

use App\Http\Controllers\Controller;
use App\Common\Libraries\Breadcrumbs;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
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


        return view('common.auth.passwords.email');
    }
}
