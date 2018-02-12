<?php

namespace App\Models\Common\Article\Traits\Relationship;

use App\Models\Common\User\User;

/**
 * Class ArticleRelationship
 * @package App\Models\Common\Article\Traits\Relationship
 */
trait ArticleRelationship
{

	/**
	 * Belongs to Parent
	 *
	 * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
	 */
	public function parent()
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	/**
	 * Has Many Children
	 *
	 * @return \Illuminate\Database\Eloquent\Relationships\HasMany
	 */
	public function children()
	{
		return $this->hasMany(self::class, 'parent_id');
	}

	/**
	 * Belongs to a User
	 *
	 * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	* Has Many Topics
	 *
	 * @return \Illuminate\Database\Eloquent\Relationships\HasMany
	 */

	// @TODO:

	/**
	 * Has Many Terms
	 *
	 * @return \Illuminate\Database\Eloquent\Relationships\HasMany
	 */

	// @TODO:
}
