<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Empire Global
 */

    Route::namespace('Common')->group(function () {
        require base_path('routes/Web/Common/auth.php');
    });

    // Development Routes
    if (App::environment('local')) {
        require base_path('routes/Web/Common/development.php');
    }


/**
 * App Specific
 */

    require base_path('routes/Web/dashboard.php');

    // Keep Marketing controller last to handle catch-all
    require base_path('routes/Web/marketing.php');
