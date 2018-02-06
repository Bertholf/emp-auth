<?php

namespace App\Common\Libraries\Facades;

use Illuminate\Support\Facades\Facade;

class SEOTools extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seotools';
    }
}
