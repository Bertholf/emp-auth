<?php

namespace App\Models\Common\Article;

//use App\Models\App\Timeline\Traits\Timelineable;
use App\Models\Common\Article\Traits\Relationship\ArticleRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	use Translatable,
		//Timelineable,
		ArticleRelationship;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * Foreign key for the translation relationship
	 *
	 * @var string
	 */
	public $translationForeignKey = 'article_id';

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * The fields that are translatable.
	 *
	 * @var array
	 */
	public $translatedAttributes = [
		'slug', 'title', 'text', 'excerpt', 'meta_title', 'meta_description', 'meta_robots', 'meta_canonical',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'status', 'type', 'user_id', 'parent_id', 'commentable', 'shareable', 'password', 'meta_image', 'meta_image_facebook', 'meta_image_twitter',
		'slug', 'title', 'text', 'excerpt', 'meta_title', 'meta_description', 'meta_robots', 'meta_canonical',
	];

	/**
	 * @param array $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->table = config('article.article_table');
	}
}
