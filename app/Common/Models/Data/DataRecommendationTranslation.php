<?php

namespace App\Common\Models\Data;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class DataRecommendationTranslation extends Model
{
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
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'text', 'text_pass', 'text_fail', 'link',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-marketaing.data_recommendations_translations_table');
    }
}
