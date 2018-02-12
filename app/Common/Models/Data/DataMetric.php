<?php

namespace App\Common\Models\Data;

use Illuminate\Database\Eloquent\Model;

class DataMetric extends Model
{
    const TYPE_RAW_DATA_DUMP = 0;
    const TYPE_INTEGER = 1;
    const TYPE_STRING = 2;
    const TYPE_JSON = 3;
    const TYPE_URL = 4;
    const TYPE_DATE = 5;
    const TYPE_BOOLEAN = 6;

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
    protected $fillable = [
        'slug', 'title', 'group', 'format', 'status'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-marketaing.data_metrics_table');
    }
}
