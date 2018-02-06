<?php

return [

    'fields' => [
        /* Fields */
        'user' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Enter your name',
            ],
            'name_first' => [
                'label' => 'First Name',
                'placeholder' => 'Enter your first name',
            ],
            'name_last' => [
                'label' => 'Last Name',
                'placeholder' => 'Enter your last name',
            ],
            'name_slug' => [
                'label' => 'Username',
                'placeholder' => 'Enter your user name',
            ],
            'email' => [
                'label' => 'E-mail Address',
                'placeholder' => 'Enter your email address',
            ],
            'password' => [
                'label' => 'Password',
                'label_confirm' => 'Confirm Password',
                'placeholder' => 'Enter your password',
                'placeholder_confirm' => 'Enter the same password again',
            ],
        ],
    ],

    'action' => [
        /* Actions */
        'register' => [
            'title' => 'Register',
            'label' => 'Register',
            'button' => 'Click to Register',
        ],
        'login' => [
            'title' => 'Log in',
            'label' => 'Login',
            'button' => 'Click to Login',
            'remember' => 'Remember Me',
            'link' => 'Have an account?',
            'message' => [
                'success' => 'You have authenticated correctly.',
                'failure' => 'Login attempt failed.  Please verify your credentials and try again.',
            ],
        ],
        'logout' => [
            'label' => 'Logout',
        ],
        'password_request' => [
            'title' => 'Reset Password',
            'button' => 'Send Password Reset Link',
            'link' => 'Forgot Your Password?',
        ],
        'password_reset' => [
            'title' => 'Reset Password',
            'button' => 'Reset Password',
            'validation' => [
                'password' => 'Passwords must be at least six characters and match the confirmation.',
                'token' => 'This password reset token is invalid.',
                'user' => 'We can\'t find a user with that e-mail address.',
                'sent' => 'We have e-mailed your password reset link!',
                'reset' => 'Your password has been reset!',
            ],
            'message' => [
                'success' => 'Your password has been reset!',
                'failure' => 'Unable to reset your password please try again',
            ],
        ],

    ],
];
