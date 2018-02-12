<?php

namespace App\Common\Models\Timeline;

use App\Events\TimelinePostSaved;
use App\Common\Models\Timeline\Traits\Relationship\TimelinePostRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TimelinePost
 * @package App\Common\Models\Timeline
 */
class TimelinePost extends Model
{
    use SoftDeletes, TimelinePostRelationship;

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
    protected $fillable = ['text', 'timeline_id', 'user_id', 'active', 'media_type', 'media_id', 'media_title', 'location', 'url_video', 'type', 'share_id'];

    protected $appends = ['link', 'video_source'];

    /**
     * Rules when doing request
     */
    public static $rules = [
        'text' => 'required',
    ];

    protected $dispatchesEvents = [
        'saved' => TimelinePostSaved::class
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('social-network.timelines_posts_table');
    }

    public function getVideoSourceAttribute()
    {
        if ($this->url_video) {
            if (preg_match('/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/', $this->url_video, $matches)) {
                return "https://www.youtube.com/embed/{{$matches[2]}}?autoplay=0";
            } elseif (preg_match('/^(http:\/\/|https:\/\/|)(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $this->url_video, $matches)) {
                return "https://player.vimeo.com/video/{{$matches[4]}}?autoplay=0";
            }
        }
    }

    public function getLinkAttribute()
    {
        return route('app.timeline.post.view', $this->id);
    }
}
