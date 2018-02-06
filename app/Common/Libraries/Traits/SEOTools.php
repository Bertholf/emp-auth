<?php

namespace App\Common\Libraries\Traits;

use App\Common\Libraries\Contracts\SEOFriendly;

trait SEOTools
{
	/**
	 * @return \App\Common\Libraries\Contracts\SEOTools;
	 */
	protected function seo()
	{
		return app('seotools');
	}

	/**
	 * @param SEOFriendly $friendly
	 *
	 * @return \App\Common\Libraries\Contracts\SEOFriendly;
	 */
	protected function loadSEO(SEOFriendly $friendly)
	{
		$SEO = $this->seo();

		$friendly->loadSEO($SEO);

		return $SEO;
	}
}
