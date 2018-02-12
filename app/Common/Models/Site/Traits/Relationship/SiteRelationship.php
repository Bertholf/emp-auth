<?php

namespace App\Common\Models\Site\Traits\Relationship;

use App\Common\Models\Site\SiteAuditSchedule;
use App\Common\Models\Site\SiteRecommendation;
use App\Common\Models\Site\SiteMetric;
use App\Common\Models\Site\SiteScore;
use App\Common\Models\Agency\Agency;

trait SiteRelationship
{

  /**
   * Site Scheduled Audits
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
    public function schedules()
    {
        return $this->hasMany(SiteAuditSchedule::class);
    }

    /**
     * A site has many metrics
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recommendations()
    {
        return $this->hasMany(SiteRecommendation::class, 'site_id');
    }

    /**
     * A site has many metrics
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metric()
    {
        return $this->hasMany(SiteMetric::class, 'site_id');
    }

    /**
     * Site Scores
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany(SiteScore::class);
    }

    /**
     * Agency
     *
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
