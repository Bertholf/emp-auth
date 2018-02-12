<?php

namespace App\Common\Models\Site;

use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Site\Traits\Relationship\SiteScoreRelationship;

class SiteScore extends Model
{
    use SiteScoreRelationship;

    protected $fillable = ['overall_confidence', 'overall_score', 'brand_confidence', 'brand_score', 'technical_confidence',
        'technical_score', 'authority_confidence', 'authority_score', 'content_confidence', 'content_score',
        'experience_confidence', 'experience_score', 'community_confidence', 'community_score', ];

    protected $casts = [
        'overall_score' => 'float',
        'overall_confidence' => 'float',
        'brand_score' => 'float',
        'brand_confidence' => 'float',
        'technical_score' => 'float',
        'technical_confidence' => 'float',
        'authority_score' => 'float',
        'authority_confidence' => 'float',
        'content_score' => 'float',
        'content_confidence' => 'float',
        'experience_score' => 'float',
        'experience_confidence' => 'float',
        'community_score' => 'float',
        'community_confidence' => 'float',
    ];

    public function __construct()
    {
      parent::__construct();
      $this->connection = config('database.connections.marketaing.database');
    }
}
