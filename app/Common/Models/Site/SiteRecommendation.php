<?php

namespace App\Common\Models\Site;

use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Data\DataRecommendation;
use App\Common\Models\Site\Traits\Relationship\SiteRecommendationRelationship;

class SiteRecommendation extends Model
{
    use SiteRecommendationRelationship;
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
        'site_id', 'recommendation_id', 'impact', 'metrics', 'text', 'protocol_id', 'service_id', 'service_count',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    protected $casts = [
        'impact' => 'json',
        'metrics' => 'json',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-marketaing.sites_recommendations_table');
        $this->connection = config('database.connections.marketaing.database');
    }


    public function getLargestImpactAttribute()
    {
        return is_array($this->impact) ? max($this->impact) : $this->impact * 10;
    }

    public function getImpactLevelAttribute()
    {
        $impact = 0;

        if ($this->largest_impact >= 70) {
            $impact = 'danger';
        } elseif ($this->largest_impact >= 30) {
            $impact = 'warning';
        } elseif ($this->largest_impact > 0) {
            $impact = 'info';
        } elseif ($this->largest_impact == 0) {
            $impact = 'success';
        }

        return $impact;
    }
}
