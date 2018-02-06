<?php

Route::middleware('web')->group(function () {

    /*
     |--------------------------------------------------------------------------
     | Marketing
     |--------------------------------------------------------------------------
     */

	// Homepage
	Route::name('marketing.index')->get('/', 'MarketingController@index');
    /*
	// Company
	Route::name('marketing.about')->get('about', 'MarketingController@about');
	Route::name('marketing.team')->get('about/team', 'MarketingController@team');
	Route::name('marketing.branding')->get('about/branding', 'MarketingController@branding');

	// Offering
	Route::name('marketing.features')->get('features', 'MarketingController@features');
	Route::name('marketing.pricing')->get('pricing', 'MarketingController@pricing');
	Route::name('marketing.contact')->get('contact', 'MarketingController@contact');
	Route::name('marketing.faq')->get('faq', 'MarketingController@faq');

	// Common
	Route::name('marketing.legal')->get('legal', 'MarketingController@legal');
	Route::name('marketing.sitemap')->get('sitemap', 'MarketingController@sitemap');

	// Blog
	Route::prefix('blog')->group(function () {
		Route::name('marketing.blog')->get('/', 'BlogController@index');
		Route::name('marketing.blog.post')->get('{slug}', 'BlogController@post');
	});

	// Catch All @TODO: This must be the last thing called
	Route::name('marketing.page')->get('{slug}', ['uses' => 'MarketingController@getPageFromSlug'])->where('slug', '([A-Za-z0-9\-\/]+)');
    */

    /*
     |--------------------------------------------------------------------------
     | Marketing
     |--------------------------------------------------------------------------
     */


    /*
     |--------------------------------------------------------------------------
     | Discovery
     |--------------------------------------------------------------------------
     */

    // Search

    // Directory

    // Web Sitemap

    /*
     |--------------------------------------------------------------------------
     | Machine Readability
     |--------------------------------------------------------------------------
     */

    // Sitemap
    // Robotstxt


});
