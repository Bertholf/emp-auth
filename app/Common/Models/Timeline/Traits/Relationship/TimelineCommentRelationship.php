<?php

namespace App\Common\Models\Timeline\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\Timeline\TimelineComment;
use App\Common\Models\TimeLine\TimeLineCommentLike;
use App\Common\Models\Timeline\TimelineCommentUpload;
use App\Common\Models\Timeline\TimelinePost;

/**
 * Class TimelineCommentsRelationship
 * @package App\Common\Models\Timeline\Traits\Relationship
 */
trait TimelineCommentRelationship
{

    /**
     * BelongsTo relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * BelongsTo a post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(TimelinePost::class, 'post_id', 'id');
    }

    /**
     * Has many replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(TimelineComment::class, 'parent_id', 'id')->orderBy('created_at', 'asc');
    }

    public function uploads()
    {
        return $this->hasMany(TimelineCommentUpload::class, 'comment_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(TimeLineCommentLike::class, 'comment_id', 'id');
    }

    /**
     * BelongsTo relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany

    public function comments_liked()
    {
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id');
    }
*/
}
