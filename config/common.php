<?php

//use App\Models\Actor\User\Role;
//use App\Models\Actor\User\Permission;

return [

    /*
     |--------------------------------------------------------------------------
     | Users
     |--------------------------------------------------------------------------
     |
     | Users table used to store users
     |
     */


    // TEMP: Email Token
    'users_email_tokens_table' => 'user_email_tokens',




    'profile' => [

        'tables' => [
            // Users
            'users_table' => 'users',

            // Meta
            'user_metas_table' => 'user_metas',
        ],

        'settings' => [
        ],

    ],


    'auth' => [

        'tables' => [

            // Auth Related
            'user_logins_table' => 'user_logins',

            // OAuth Providers
            'user_oauth_providers_table' => 'user_oauth_providers',

            // Password Requests
            'user_password_resets_table' => 'user_password_resets',

        ],

        'settings' => [

            // Whether or not public registration is on
            'registration' => env('AUTH_ENABLE_REGISTRATION', 'true'),

            // The role the user is assigned to when they sign up from the frontend, not namespaced
            'default_role' => 'User',

            // Whether or not the user has to confirm their email when signing up
            'confirm_email' => false,

            // Wheather or not ot propmpt the user if authenticated but email address is not confirmed
            'confirm_email_alert' => true,

            // Whether or not the users email can be changed on the edit profile screen
            'change_email' => true,

            // Whether or not we should prompt the user to create a password if registered via social
            'change_password_if_null' => true,

            // Whether or not the user can de-activate their account
            'allow_deactivate' => true,

            // Application captcha specific settings
            'captcha' => env('AUTH_ENABLE_CAPCHA', false),

            /*
             * Socialite session variable name
             * Contains the name of the currently logged in provider in the users session
             * Makes it so social logins can not change passwords, etc.
             */
            'socialite_session_name' => 'socialite_provider',

        ],
    ],

    'notification' => [

        'tables' => [
            'user_notification_tokens_table' => 'user_notification_tokens',
        ],

        'settings' => [
        ],

    ],


    'wallet' => [

        'tables' => [
            'user_wallet_table' => 'user_wallets',
            'user_wallet_balance_table' => 'user_wallet_balances',
        ],

        'settings' => [
        ],

    ],

    /*
     |--------------------------------------------------------------------------
     | Teams / Projects / Companies
     |--------------------------------------------------------------------------
     */
    'team' => [

        // Whether or not the app uses teams
        'enable' => true,

        // Does the team have an identity? (e.g. Logo, Colors, etc. )
        // (If False, treat like a project vs organization)
        'has_identity' => false,

        // Table used to hold teams... or whatever we call them.
        'teams_table' => 'teams',

        // Teams Brand Identity Table
        'teams_identity_table' => 'teams_identity',

        // Teams Connection Tokens (e.g. Google Analytics/WebMasters)
        'teams_connections_table' => 'teams_connections',

        // Holds invite codes to join teams
        'teams_invites_table' => 'teams_invites',

        // Users assigned to Teams
        'users_teams_table' => 'users_teams',

        // Teams Brand Identity/Goals Table
        'teams_data_goals_table' => 'teams_data_goals',

        // Teams Data:Tech
        'teams_data_tech_table' => 'teams_data_tech',

    ],


    /*
     * Configuration for roles
     */
    'roles' => [
        /*
         * Whether a role must contain a permission or can be used standalone as a label
         */
        'role_must_contain_permission' => true
    ],

        /*
         * Role model used by Access to create correct relations. Update the role if it is in a different namespace.
         */
        'role' => Role::class,

        /*
         * Roles table used by Access to save roles to the database.
         */
        'roles_table' => 'data_users_roles',

        /*
         * Permission model used by Access to create correct relations.
         * Update the permission if it is in a different namespace.
         */
        'permission' => Permission::class,

        /*
         * Permissions table used by Access to save permissions to the database.
         */
        'permissions_table' => 'data_users_permissions',

        /*
         * permission_role table used by Access to save relationship between permissions and roles to the database.
         */
        'permission_role_table' => 'data_users_permission_role',

        /*
         * assigned_roles table used by Access to save assigned roles to the database.
         */
        'assigned_roles_table' => 'users_roles',


    /*
     * Meta
     */

        /*
         * Names of custom fields
         */
        'data_users_fields_table' => 'data_users_fields',

        /*
         * Values of Custom Fields by User
         */
        'users_metas_table' => 'users_metas',


    /*
     * SEO TOOLS
     */

    'seo' => [


        'meta'      => [
            /*
             * The default configurations to be used by the meta generator.
             */
            'defaults'       => [
                'title'        => config('app.name'),
                'description'  => config('app.description'),
                'separator'    => ' - ',
                'keywords'     => [],
                'canonical'    => null, // Set null for using Url::current()
            ],

            /*
             * Webmaster tags are always added.
             */
            'webmaster_tags' => [
                'google'    => null,
                'bing'      => null,
                'alexa'     => null,
                'pinterest' => null,
                'yandex'    => null,
            ],
        ],
        'opengraph' => [
            /*
             * The default configurations to be used by the opengraph generator.
             */
            'defaults' => [
                'title'        => config('app.name'),
                'description'  => config('app.description'),
                'url'         => null,
                'type'        => false,
                'site_name'   => false,
                'images'      => ['url' => null, 'size' => null],
                'locale'      => app()->getLocale()
            ],
        ],
        'twitter' => [
            /*
             * The default values to be used by the twitter cards generator.
             */
            'defaults' => [
                'card'        => 'summary',
                'site'        => '@diydifm',
            ],
        ],
    ],

];
