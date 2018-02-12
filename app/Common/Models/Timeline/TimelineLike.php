<?php

namespace App\Common\Models\Timeline;

use App\Common\Models\Timeline\Traits\Relationship\TimelineLikeRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TimelineComment
 * @package App\Common\Models\Timeline
 */
class TimelineLike extends Model
{
        use TimelineLikeRelationship;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timelines_post_likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'user_id'];

    /**
     * Rules when request for saving or updating comment
     */
    public static $rules = [
         'post_id' => 'required',
     ];

     // Add user name
    protected $appends = ['name_slug'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = ('timelines_post_likes');
    }
}
