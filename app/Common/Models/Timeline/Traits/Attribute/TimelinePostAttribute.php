<?php

namespace App\Common\Models\Timeline\Traits\Attribute;

/**
 * Class TimelinePostAttribute
 * @package App\Common\Models\Timeline\Traits\Attribute
 */
trait TimelinePostAttribute
{

    /* @TOTO: Restore
	public function getLikeCountAttribute()
	{
		return $this->likes->count();
	}

	public function getLikedByCurrentUserAttribute()
	{
		return $this->likes->where('user_id', Auth::user()->id)->count() === 1;
	}
	*/
}
