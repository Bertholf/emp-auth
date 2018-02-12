<?php

namespace App\Common\Models\TimeLine;

use App\Common\Models\Timeline\Traits\Relationship\TimelineCommentRelationship;
use Illuminate\Database\Eloquent\Model;

class TimeLineCommentLike extends Model
{
    use TimelineCommentRelationship;

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
    protected $table = 'timelines_comment_likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment_id', 'user_id'];

    /**
     * Rules when request for saving or updating comment
     */
    public static $rules = [
        'comment_id' => 'required',
    ];

    // Add user name
    // protected $appends = ['name_slug', 'liked', 'fill'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = ('timelines_comment_likes');
    }
}
