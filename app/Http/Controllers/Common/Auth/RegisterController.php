<?php

namespace App\Http\Controllers\Common\Auth;

use App\Models\Common\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Empire\Libraries\Breadcrumbs;
use App\Empire\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        // Where to redirect users after registering
        if (config('common.users.confirm_email')) {
            // Redirect to login page if email confirmation required
            $this->redirectTo = route('common.auth.login');
        } else {
            $this->redirectTo = route('dashboard');
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // Get Social Links
        $socialite_links = Socialite::getSocialLinks();

        // Specify Title
        $title = trans('actor.user.auth.register_box_title');

        // Set Breadcrumbs
        Breadcrumbs::push('<i class="fa fa-home"></i>', route('marketing.index'));
        Breadcrumbs::push($title, '#');

        $role = Role::where('slug', 'user')->first();

        // Return View
        return view('common.auth.register', compact('title', 'token', 'socialite_links', 'role'));
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {

        // Do we require an email confirmation?
        if (config('actor.users.confirm_email')) {
            // Yes, create the user.
            $user = $this->user->create($request->all());
        } else {
            // No Email Confirmation Required, Log them in!
            auth()->login($this->user->create($request->all()));

            // Now Get User
            $user = auth()->user();
        }

        // Can we detect their language?
        if ($_SERVER['HTTP_ACCEPT_LANGUAGE']) {
            $user->language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }

        // Can we detect their timezone?
            // @TODO: Get Timezone
            // $user->language = UTC;

        // Add Default Settings
        $settings = UserSetting::create([
            'user_id' => $user->id,
            'privacy_follow' => 'everyone',
            'privacy_follow_confirm' => 'no',
            'privacy_comment' => 'all',
            'privacy_post' => 'all',
            'privacy_timeline_post' => 'all',
            'privacy_message' => 'all',
            'email_follow' => false,
            'email_post_like' => false,
            'email_post_share' => false,
            'email_comment_post' => false,
            'email_comment_like' => false,
            'email_comment_reply' => false,
        ]);

        // Add Timeline
        $timeline = $user->createTimeline();

        // @TODO: Add User Types / Custom Groups
        if (isset($data['types'])) {
            $user->updateTypes($data['types']);
        }

        // Check if a Team Inviation was claimed
        if (config('actor.team.enable') && session('invite_team_token')) {
            if ($invite = Teams::getInviteFromAcceptToken(session('invite_team_token'))) {
                // Accept Invite
                Teams::acceptInvite($invite);

                // New User to Platform, Give Credit to Referring User
                $user->referring_user_id = $invite->user_id;
                $user->save();

                // Notify Inviter
                $inviter = User::find($invite->user_id);
                $inviter->notify(new TeamInvitationAccepted($invite));
            }
            // Destroy the token... no longer needed
            session()->forget('invite_team_token');
        }

        // Check if affiliate code was used
        if (!empty($request->affiliate_code)) {
            // Lookup Affiliate Code
            $referring_user = User::where('name_slug', $request->affiliate_code)->first();

            // New User to Platform, Give Credit to Referring User
            $user->referring_user_id = $referring_user->id;
            $user->save();

            // Notify Inviter of Affiliate
            $referring_user->notify(new UserRegisteredWithAffiliateCode($user));

            session()->forget('invite_team_token');
        }

        // Return Redirect
        if (config('actor.users.confirm_email')) {
            return redirect($this->redirectPath())->withFlashSuccess(trans('actor.user.auth.exception.confirmation.created_confirm'));
        } else {
            return redirect($this->redirectPath());
        }
    }
}
