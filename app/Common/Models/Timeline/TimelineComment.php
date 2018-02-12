<?php

namespace App\Common\Models\Timeline;

use App\Common\Models\Timeline\Traits\Relationship\TimelineCommentRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TimelineComment
 * @package App\Common\Models\Timeline
 */
class TimelineComment extends Model
{
    use SoftDeletes,
        TimelineCommentRelationship;

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
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'text', 'user_id', 'parent_id', 'media_type', 'media_title'];

    public static $rules = [
        'post_id' => 'required',
        'text'=> 'required',
    ];

    // Add user name
//    protected $appends = ['name_slug', 'comment_likers','likedId',];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('social-network.timelines_comments_table');
    }
}
