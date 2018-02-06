<?php

namespace App\Models\Common\Article;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'slug', 'title', 'text', 'excerpt', 'meta_title', 'meta_description', 'meta_robots', 'meta_canonical', 'meta_image', 'meta_image_facebook', 'meta_image_twitter',
	];

	/**
	 * @param array $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->table = config('article.article_translations_table');
	}
}
