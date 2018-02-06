<?php

use Illuminate\Support\Facades\Request;

/**
 * Global helpers file with misc functions
 */

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('history')) {
    /**
         * Access the history facade anywhere
         */
    function history()
    {
        return app('history');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('getFallbackLocale')) {
    /**
     * Get the fallback locale
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function getFallbackLocale()
    {
        return config('app.fallback_locale');
    }
}

/**
 * Check duplicate values in array
 *
 * @param $array
 * @return bool
 */
function contain_duplicates($array)
{
    return (count(array_unique($array)) < count($array));
}

/**
 * Get the language block with a fallback
 *
 * @param $view
 * @param array $data
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
if (! function_exists('getLanguageBlock')) {
    function getLanguageBlock($view, $data = [])
    {
        $components = explode("lang", $view);
        $current  = $components[0]."lang.".app()->getLocale().".".$components[1];
        $fallback  = $components[0]."lang.".getFallbackLocale().".".$components[1];

        if (view()->exists($current)) {
            return view($current, $data);
        } else {
            return view($fallback, $data);
        }
    }
}

/**
 * Get language list
 *
 * @return array
 */
function get_language_list()
{
    $languages = config('locale.languages');

    $result = [];

    foreach ($languages as $key => $value) {
        $result[$key] = trans('common.languages.langs.'.$value[0]);
    }

    return $result;
}
if (! function_exists('get_currecy_symbol')) {
    function get_currecy_symbol($cc = 'USD')
    {
        $cc = strtoupper($cc);
        $currency =  [
                'USD' => ['name'=>'USD - U.S. Dollars', 'symbol'=>'$', 'symbol_html'=>'$'],
                'GBP' => ['name'=>'GBP - British Pounds', 'symbol'=>'£', 'symbol_html'=>'&pound;'],
                'EUR' => ['name'=>'EUR - Euros', 'symbol'=>'€', 'symbol_html'=>'&euro;'],
                'AUD' => ['name'=>'AUD - Australian Dollars', 'symbol'=>'$', 'symbol_html'=>'$'],
                'BRL' => ['name'=>'BRL - Brazilian Real', 'symbol'=>'R$', 'symbol_html'=>'R$'],
                'CAD' => ['name'=>'CAD - Canadian Dollars', 'symbol'=>'$', 'symbol_html'=>'$'],
                'CZK' => ['name'=>'CZK - Czech koruny', 'symbol'=>'Kč', 'symbol_html'=>''],
                'DKK' => ['name'=>'DKK - Danish Kroner', 'symbol'=>'kr', 'symbol_html'=>'kr'],
                'HKD' => ['name'=>'HKD - Hong Kong Dollars', 'symbol'=>'$', 'symbol_html'=>'$'],
                'HUF' => ['name'=>'HUF - Hungarian Forints', 'symbol'=>'Ft', 'symbol_html'=>'Ft'],
                'ILS' => ['name'=>'ILS - Israeli Shekels', 'symbol'=>'₪', 'symbol_html'=>'&#8362;'],
                'JPY' => ['name'=>'JPY - Japanese Yen', 'symbol'=>'¥', 'symbol_html'=>'&#165;'],
                'MYR' => ['name'=>'MYR - Malaysian Ringgits', 'symbol'=>'RM', 'symbol_html'=>'RM'],
                'MXN' => ['name'=>'MXN - Mexican Pesos', 'symbol'=>'$', 'symbol_html'=>'$'],
                'NZD' => ['name'=>'NZD - New Zealand Dollars', 'symbol'=>'$', 'symbol_html'=>'$'],
                'NOK' => ['name'=>'NOK - Norwegian Kroner', 'symbol'=>'kr', 'symbol_html'=>'kr'],
                'PHP' => ['name'=>'PHP - Philippine Pesos', 'symbol'=>'Php', 'symbol_html'=>'Php'],
                'PLN' => ['name'=>'PLN - Polish zloty', 'symbol'=>'zł', 'symbol_html'=>''],
                'SGD' => ['name'=>'SGD - Singapore Dollars', 'symbol'=>'$', 'symbol_html'=>'$'],
                'SEK' => ['name'=>'SEK - Swedish Kronor', 'symbol'=>'kr', 'symbol_html'=>'kr'],
                'CHF' => ['name'=>'CHF - Swiss Francs', 'symbol'=>'CHF', 'symbol_html'=>'CHF'],
                'TWD' => ['name'=>'TWD - Taiwan New Dollars', 'symbol'=>'$', 'symbol_html'=>'$'],
                'THB' => ['name'=>'THB - Thai Baht', 'symbol'=>'฿', 'symbol_html'=>' &#3647;'],
                'TRY' => ['name'=>'TRY - Turkish Liras', 'symbol'=>'TL', 'symbol_html'=>' &#3647;'],
        ];

        if (array_key_exists($cc, $currency)) {
            return $currency[$cc];
        }
    }
}

/**
 * Get timezone list
 * @return array
 */
function get_timezone_list()
{
    static $regions = [
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    ];

    $timezones = [];

    foreach ($regions as $region) {
        $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
    }

    $timezone_offsets = [];

    foreach ($timezones as $timezone) {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    asort($timezone_offsets);

    $timezone_list = [];

    foreach ($timezone_offsets as $timezone => $offset) {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate('H:i', abs($offset));

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
    }

    return $timezone_list;
}

if (!function_exists('checkActiveRoute')) {
    function checkActiveRoute($path, $parent_check = false, $active = 'active', $else = '')
    {
        // Clean up path to check against... and refactor later
        $path = ltrim($path, '/');

        if ($parent_check && Request::is($path ."/*")) {
            return $active;
        } elseif (Request::is($path)) {
            return $active;
        } else {
            return $else;
        }
    }
}

if (!function_exists('rating_stars')) {
    function rating_stars($rating)
    {
        $starcount = 0;
        if ($rating > 0) {
            for ($i = 0; $i < $rating; $i++) {
                $starcount++;
                echo "<i class=\"fas fa-star\"></i>";
            }
            $half = round($rating) - round($rating / 0.5) * 0.5;
            if ($half == 0.5) {
                echo "<i class=\"fas fa-star-half\"></i>";
                $starcount++;
            }
            $blank = 5 - $starcount;
            for ($i = 0; $i < $blank; $i++) {
                echo "<i class=\"far fa-star\"></i>";
                $starcount++;
            }
        }
    }
}

if (!function_exists('scrub_url')) {
    function scrub_url($url)
    {
        $url = strtolower($url); // lowercase
        $url = trim($url, '/'); // Remove slashes
        $url = preg_replace('#^https?://#', '', $url); // Remove Scheme
        $url = preg_replace('/^www\./', '', $url); // Remove www

        return $url;
    }
}

if (!function_exists('checkIconType')) {
    function checkIconType($handle)
    {
        $icon_class = "";
        $branding_icons = ['pied-piper', 'chrome'];

        if (in_array($handle, $branding_icons)) {
            $icon_class = "fab";
        } else {
            $icon_class = "fas";
        }

        return $icon_class;
    }
}


/**
 * Generates social login links based on what is enabled
 *
 * @return string
 */
if (!function_exists('checkSsoProvider')) {
    function checkSsoProvider()
    {
        $socialite_enable = [];
        $socialite_links  = '';

        if (strlen(getenv('BITBUCKET_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.login.social', trans('auth.login_with', ['social_media' => 'Bit Bucket']), 'bitbucket');
        }

        if (strlen(getenv('FACEBOOK_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.login.social', trans('auth.login_with', ['social_media' => 'Facebook']), 'facebook');
        }

        if (strlen(getenv('GOOGLE_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.login.social', trans('auth.login_with', ['social_media' => 'Google']), 'google');
        }

        if (strlen(getenv('GITHUB_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.login.social', trans('auth.login_with', ['social_media' => 'Github']), 'github');
        }

        if (strlen(getenv('LINKEDIN_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.login.social', trans('auth.login_with', ['social_media' => 'Linked In']), 'linkedin');
        }

        if (strlen(getenv('TWITTER_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.login.social', trans('auth.login_with', ['social_media' => 'Twitter']), 'twitter');
        }

        for ($i = 0; $i < count($socialite_enable); $i++) {
            $socialite_links .= ($socialite_links != '' ? '&nbsp;|&nbsp;' : '') . $socialite_enable[$i];
        }

        return $socialite_links;
    }
}
