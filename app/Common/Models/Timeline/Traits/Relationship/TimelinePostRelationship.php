<?php

namespace App\Common\Models\Timeline\Traits\Relationship;

use App\Common\Models\User\User;
use App\Common\Models\Timeline\Timeline;
use App\Common\Models\Timeline\TimelineComment;
use App\Common\Models\TimeLine\TimeLinePostLike;
use App\Common\Models\TimeLine\TimeLinePostShare;
use App\Common\Models\TimeLine\TimelinePostTag;
use App\Common\Models\Timeline\TimelinePostUpload;
use Illuminate\Support\Facades\Auth;

/**
 * Class TimelinePostRelationship
 * @package App\Common\Models\Timeline\Traits\Relationship
 */
trait TimelinePostRelationship
{

    /**
     * Belongs to the Timeline model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    /**
     * BelongsTo relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poster()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Has many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(TimelineComment::class, 'post_id', 'id')->orderBy('created_at', 'asc')->where('parent_id', null);
    }

    /**
     * Has many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentcount()
    {
        return $this->hasMany(TimelineComment::class, 'post_id', 'id')->count();
    }

    public function uploads()
    {
        return $this->hasMany(TimelinePostUpload::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(TimeLinePostLike::class, 'post_id', 'id');
    }

    public function userLike()
    {
        if (!Auth::check()) {
            return false;
        }
        return $this->hasOne(TimeLinePostLike::class, 'post_id', 'id')->where('user_id', Auth::user()->id);
    }

    public function share()
    {
        return $this->hasMany(TimeLinePostShare::class, 'post_id', 'id');
    }

    public function shared_from()
    {
        return $this->belongsTo(TimeLinePostShare::class, 'share_id', 'id');
    }

    public function tag()
    {
        return $this->hasMany(TimelinePostTag::class, 'post_id', 'id');
    }


  /* @TODO: Link to Likes
	/* @TODO: Link to Shares
	public function likes()
	{
		return $this->morphMany(Like::class, 'likeable');
	}
	*/
    // @TODO: Link to Media
    // @TODO: Link to Type
    // @TODO: Link to Location
}
