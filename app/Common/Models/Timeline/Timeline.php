<?php

namespace App\Common\Models\Timeline;

use App\Common\Models\Timeline\Traits\Attribute\TimelineAttribute;
use App\Common\Models\Timeline\Traits\Relationship\TimelineRelationship;
use App\Common\Models\Timeline\Traits\Scope\TimelineScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Timeline
 * @package App\Common\Models\Timeline
 */
class Timeline extends Model
{
    use TimelineRelationship,
        TimelineAttribute,
        TimelineScope;

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
    protected $fillable = ['timelineable_type', 'timelineable_id'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('social-network.timelines_table');
    }
}
