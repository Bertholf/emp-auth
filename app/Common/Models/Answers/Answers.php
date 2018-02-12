<?php

namespace App\Common\Models\Answers;

use App\Common\Models\Answers\Traits\Relationship\AnswersRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use Translatable,
        AnswersRelationship;

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
     * The fields that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'question', 'answer', 'stat_viewed'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic_id', 'slug', 'question', 'answer', 'stat_viewed'
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
        $this->table = config('app-answers.answers_table');
    }
}
