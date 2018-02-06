<?php

namespace App\Common\Libraries\Contracts;

interface SEOFriendly
{
    /**
     * Performs SEO settings.
     *
     * @param SEOTools $SEOTools
     */
    public function loadSEO(SEOTools $SEOTools);
}
