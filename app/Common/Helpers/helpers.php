<?php

use Illuminate\Support\Facades\Request;

/**
 * Global helpers file with misc functions
 */

if (!function_exists('str_bytes')) {
    /**
     * returns size of any text in bytes
     * TODO: need to move in a helper
     * @param $str
     * @return int
     */
    function str_bytes($str)
    {
        // STRINGS ARE EXPECTED TO BE IN ASCII OR UTF-8 FORMAT

        // Number of characters in string
        $strlen_var = strlen($str);

        // string bytes counter
        $d = 0;

        /*
         * Iterate over every character in the string,
         * escaping with a slash or encoding to UTF-8 where necessary
         */
        for ($c = 0; $c < $strlen_var; ++$c) {
            $ord_var_c = ord($str{$c});
            switch (true) {
            case (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)):
                // characters U-00000000 - U-0000007F (same as ASCII)
                $d++;
                break;
            case (($ord_var_c & 0xE0) == 0xC0):
                // characters U-00000080 - U-000007FF, mask 110XXXXX
                $d += 2;
                break;
            case (($ord_var_c & 0xF0) == 0xE0):
                // characters U-00000800 - U-0000FFFF, mask 1110XXXX
                $d += 3;
                break;
            case (($ord_var_c & 0xF8) == 0xF0):
                // characters U-00010000 - U-001FFFFF, mask 11110XXX
                $d += 4;
                break;
            case (($ord_var_c & 0xFC) == 0xF8):
                // characters U-00200000 - U-03FFFFFF, mask 111110XX
                $d += 5;
                break;
            case (($ord_var_c & 0xFE) == 0xFC):
                // characters U-04000000 - U-7FFFFFFF, mask 1111110X
                $d += 6;
                break;
            default:
                $d++;
            };
        }
        ;
        return $d;
    }
}

if (!function_exists('get_status_code')) {
    /**
     * Get only status code for a URL
     *
     * @param string $url Full URL of website, including http/s
     * @return int|boolean http return code or false in case of error
     */
    function get_status_code($url)
    {
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_HEADER, true);
        curl_setopt($handle, CURLOPT_NOBODY, true);
        $response = curl_exec($handle);
        return curl_getinfo($handle, CURLINFO_HTTP_CODE);
    }
}

if (!function_exists('get_domain_slug')) {
    /**
     * Gets hostname in a slug-friendly way
     *
     * @param string $domain Full URL of website
     * @return int|boolean
     */
    function get_domain_slug($domain)
    {
        $url = trim($domain, '/');
        if (!preg_match('#^http(s)?://#', $url)) { // If scheme not included, prepend it
            $url = 'http://' . $url;
        }
        $urlParts = parse_url($url);

        if ($urlParts !== false && !empty($urlParts)) {
            $domain = preg_replace('/^www\./', '', $urlParts['host']); // Remove www

            return str_slug($domain);
        }

        return false;
    }
}

if (!function_exists('app_name')) {
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

if (!function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

if (!function_exists('history')) {
    /**
     * Access the history facade anywhere
     */
    function history()
    {
        return app('history');
    }
}

if (!function_exists('gravatar')) {
    /**
     * Access the gravatar helper
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (!function_exists('get_fallback_locale')) {
    /**
     * Get the fallback locale
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function get_fallback_locale()
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
if (! function_exists('get_language_block')) {
    function get_language_block($view, $data = [])
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
        $result[$key] = trans('common.languages.langs.' . $value[0]);
    }

    return $result;
}
if (!function_exists('get_currency_symbol')) {
    function get_currency_symbol($cc = 'USD')
    {
        $cc = strtoupper($cc);
        $currency = [
            'USD' => ['name' => 'USD - U.S. Dollars', 'symbol' => '$', 'symbol_html' => '$'],
            'GBP' => ['name' => 'GBP - British Pounds', 'symbol' => '£', 'symbol_html' => '&pound;'],
            'EUR' => ['name' => 'EUR - Euros', 'symbol' => '€', 'symbol_html' => '&euro;'],
            'AUD' => ['name' => 'AUD - Australian Dollars', 'symbol' => '$', 'symbol_html' => '$'],
            'BRL' => ['name' => 'BRL - Brazilian Real', 'symbol' => 'R$', 'symbol_html' => 'R$'],
            'CAD' => ['name' => 'CAD - Canadian Dollars', 'symbol' => '$', 'symbol_html' => '$'],
            'CZK' => ['name' => 'CZK - Czech koruny', 'symbol' => 'Kč', 'symbol_html' => ''],
            'DKK' => ['name' => 'DKK - Danish Kroner', 'symbol' => 'kr', 'symbol_html' => 'kr'],
            'HKD' => ['name' => 'HKD - Hong Kong Dollars', 'symbol' => '$', 'symbol_html' => '$'],
            'HUF' => ['name' => 'HUF - Hungarian Forints', 'symbol' => 'Ft', 'symbol_html' => 'Ft'],
            'ILS' => ['name' => 'ILS - Israeli Shekels', 'symbol' => '₪', 'symbol_html' => '&#8362;'],
            'JPY' => ['name' => 'JPY - Japanese Yen', 'symbol' => '¥', 'symbol_html' => '&#165;'],
            'MYR' => ['name' => 'MYR - Malaysian Ringgits', 'symbol' => 'RM', 'symbol_html' => 'RM'],
            'MXN' => ['name' => 'MXN - Mexican Pesos', 'symbol' => '$', 'symbol_html' => '$'],
            'NZD' => ['name' => 'NZD - New Zealand Dollars', 'symbol' => '$', 'symbol_html' => '$'],
            'NOK' => ['name' => 'NOK - Norwegian Kroner', 'symbol' => 'kr', 'symbol_html' => 'kr'],
            'PHP' => ['name' => 'PHP - Philippine Pesos', 'symbol' => 'Php', 'symbol_html' => 'Php'],
            'PLN' => ['name' => 'PLN - Polish zloty', 'symbol' => 'zł', 'symbol_html' => ''],
            'SGD' => ['name' => 'SGD - Singapore Dollars', 'symbol' => '$', 'symbol_html' => '$'],
            'SEK' => ['name' => 'SEK - Swedish Kronor', 'symbol' => 'kr', 'symbol_html' => 'kr'],
            'CHF' => ['name' => 'CHF - Swiss Francs', 'symbol' => 'CHF', 'symbol_html' => 'CHF'],
            'TWD' => ['name' => 'TWD - Taiwan New Dollars', 'symbol' => '$', 'symbol_html' => '$'],
            'THB' => ['name' => 'THB - Thai Baht', 'symbol' => '฿', 'symbol_html' => ' &#3647;'],
            'TRY' => ['name' => 'TRY - Turkish Liras', 'symbol' => 'TL', 'symbol_html' => ' &#3647;'],
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

if (!function_exists('check_active_route')) {
    function check_active_route($path, $parent_check = false, $active = 'active', $else = '')
    {
        // Clean up path to check against... and refactor later
        $path = ltrim($path, '/');

        if ($parent_check && Request::is($path . "/*")) {
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

if (!function_exists('check_icon_type')) {
    function check_icon_type($handle)
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
if (!function_exists('check_sso_provider')) {
    function check_sso_provider()
    {
        $socialite_enable = [];
        $socialite_links  = '';

        if (strlen(getenv('BITBUCKET_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('common.auth.login.social', trans('auth.login_with', ['social_media' => 'Bit Bucket']), 'bitbucket');
        }

        if (strlen(getenv('FACEBOOK_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('common.auth.login.social', trans('auth.login_with', ['social_media' => 'Facebook']), 'facebook');
        }

        if (strlen(getenv('GOOGLE_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('common.auth.login.social', trans('auth.login_with', ['social_media' => 'Google']), 'google');
        }

        if (strlen(getenv('GITHUB_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('common.auth.login.social', trans('auth.login_with', ['social_media' => 'Github']), 'github');
        }

        if (strlen(getenv('LINKEDIN_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('common.auth.login.social', trans('auth.login_with', ['social_media' => 'Linked In']), 'linkedin');
        }

        if (strlen(getenv('TWITTER_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('common.auth.login.social', trans('auth.login_with', ['social_media' => 'Twitter']), 'twitter');
        }

        for ($i = 0; $i < count($socialite_enable); $i++) {
            $socialite_links .= ($socialite_links != '' ? '&nbsp;|&nbsp;' : '') . $socialite_enable[$i];
        }

        return $socialite_links;
    }
}
