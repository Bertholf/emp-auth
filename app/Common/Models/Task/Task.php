<?php

namespace App\Common\Models\Task;

use App\Common\Models\Task\Traits\Relationship\TaskRelationship;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use TaskRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'text', 'status_id', 'priority', 'progress', 'completed', 'team_id', 'assigned_by', 'started_at', 'due_at',
    ];

    /**
     * What is the primary route key
     *
     * @var string
     */
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
        $this->table = config('app-task.teams_tasks_table');
    }
}
