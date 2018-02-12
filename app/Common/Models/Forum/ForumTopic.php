<?php

namespace App\Common\Models\Forum;

use App\Common\Models\Forum\Traits\Relationship\ForumTypeRelationship;
use App\Common\Models\Timeline\Traits\Timelineable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    use ForumTypeRelationship,
        Translatable,
        Timelineable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The fields that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title', 'text', 'calltoaction',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'text', 'priority', 'forum_type_id', 'icon', 'parent_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-forum.forum_topics_table');
    }
}
