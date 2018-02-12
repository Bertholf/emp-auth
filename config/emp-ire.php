<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Agencies
    |--------------------------------------------------------------------------
    */

    // Table Names  e.g.   config('emp-ire.agencies_table')
    'agencies_table' => 'agencies',

    'url' => env('AGENCY_URL', 'https://agency.diydifm.com'),


    /*
    |--------------------------------------------------------------------------
    | Services List & Prices
    |--------------------------------------------------------------------------
    */

    // Table Names  e.g.   config('emp-ire.services_table')
    'services_pricetiers_table' => 'services_pricetiers',
    'services_pricetiers_translations_table' => 'services_pricetiers_translations',
    'services_table' => 'services',
    'services_translations_table' => 'services_translations',
    'services_prices_table' => 'services_prices',


    /*
    |--------------------------------------------------------------------------
    | Protocol App
    |--------------------------------------------------------------------------
    */

    // Table Names  e.g.   config('emp-ire.protocols_table')
    'protocols_table' => 'protocols',
    'protocols_translations_table' => 'protocols_translations',
];
