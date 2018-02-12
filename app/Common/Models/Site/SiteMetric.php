<?php

namespace App\Common\Models\Site;

use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Data\DataMetric;
use App\Common\Models\Site\Traits\Relationship\SiteMetricRelationship;

class SiteMetric extends Model
{

    use SiteMetricRelationship;

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
        'site_id', 'metric_id', 'value',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-marketaing.sites_metrics_table');
        $this->connection = config('database.connections.marketaing.database');
    }
}
