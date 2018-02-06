<?php

Route::namespace('Auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Routes apply to unauthenticated users
    |--------------------------------------------------------------------------
    */

    Route::middleware('guest')->group(function () {

        // Authenticate via Form
        Route::name('common.auth.login')->get('login', 'LoginController@showLoginForm');
        Route::name('common.auth.login.action')->post('login', 'LoginController@login');

        // Authenticate via SSO
        Route::name('auth.login.social')->get('login/{provider}', 'SocialLoginController@login');

        // Registration Routes
        if (config('empauthable.users.registration')) {
        Route::name('common.auth.register')->get('register', 'RegisterController@showRegistrationForm');
        Route::name('common.auth.register.action')->post('register', 'RegisterController@register');
        }

        // Confirm Account Routes
        Route::name('common.auth.confirm')->get('account/confirm/{token}', 'ConfirmAccountController@confirm');
        Route::name('common.auth.confirm.resend')->get('account/confirm/resend/{user}', 'ConfirmAccountController@sendConfirmationEmail');

        // Password Forgot
        Route::name('common.auth.password.request')->get('password/request', 'ForgotPasswordController@showLinkRequestForm');
        Route::name('common.auth.password.request.action')->post('password/request', 'ForgotPasswordController@sendResetLinkEmail');

        // Password Reset
        Route::name('common.auth.password.reset')->get('password/reset/{token}', 'ResetPasswordController@showResetForm');
        Route::name('common.auth.password.reset.action')->post('password/reset', 'ResetPasswordController@reset');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes apply to authenticated users
    |--------------------------------------------------------------------------
    */

    // Logout
    //Route::name('common.auth.logout')->get('logout', 'LoginController@logout');
    Route::name('common.auth.logout')->post('logout', 'LoginController@logout');


    /*
    |--------------------------------------------------------------------------
    | Logged In Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {


    });

    /*
    |--------------------------------------------------------------------------
    | Authorize with EmpAUTHable
    |--------------------------------------------------------------------------
    */

    /*
    // @TODO: Move to Controller  & CLeanup

    Route::get('/forget-token', function() {
        session()->forget('api-token');
        return redirect('/');
    });


    */
    // First route that user visits on consumer app
    Route::name('common.auth.authable')->get('/authable', function () {
        // Ensure values are set
        if (!config('auth.empauthable.url') || !config('auth.empauthable.client_id') || !config('auth.empauthable.client_secret') || !config('auth.empauthable.client_url')) {
            return "Please fill API fields in env file";
        }

        // Build the query parameter string to pass auth information to our request
        $query = http_build_query([
            'client_id'     => config('auth.empauthable.client_id'),
            'redirect_uri'  => config('auth.empauthable.client_url'),
            'response_type' => 'code',
            'scope'         => '',
        ]);

        // Redirect the user to the OAuth authorization page
        return redirect(config('auth.empauthable.url') .'/oauth/authorize?' . $query);
    });

    // Route that user is forwarded back to after approving on server
    Route::name('common.auth.authable.callback')->get('/oauth/callback', function () {
        $http = new GuzzleHttp\Client();

        if (request('code')) {
            $response = $http->post(config('auth.empauthable.url') .'/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'authorization_code',
                    'client_id'     => config('auth.empauthable.client_id'),
                    'client_secret' => config('auth.empauthable.client_secret'),
                    'redirect_uri'  => config('auth.empauthable.client_url'),
                    'code'          => request('code'),
                ],
            ]);
            // echo the access token; normally we would save this in the DB
            //return json_decode((string) $response->getBody(), true)['access_token'];

            $apiResponse = json_decode((string) $response->getBody(), true);
            session(['api'=> $apiResponse]);
            session(['api-token'=> $apiResponse['access_token']]);

            // Return as Authenticated TODO: Set Intended
            return redirect()->route('dashboard');
        } else {
            // Return Error
            return response()->json(['error' => request('error')]);
        }
    });

});
