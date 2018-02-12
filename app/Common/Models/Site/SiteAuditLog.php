<?php

namespace App\Common\Models\Site;

use App\Notifications\Site\RecommendationsReady as RecommendationsReadyNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Site\Traits\Relationship\SiteAuditLogRelationship;

/**
 * @property Site site
 */
class SiteAuditLog extends Model
{
    use SiteAuditLogRelationship;

    protected $fillable = ['checks', 'completed_at', 'status', 'auditor_type', 'auditor_id'];

    protected $casts = ['checks' => 'json'];

    protected $dates = ['completed_at'];

    protected $with = ['checks'];

    public function __construct()
    {
      parent::__construct();
      $this->connection = config('database.connections.marketaing.database');
    }

    public function logUpdated()
    {
        $incomplete = $this->checks()
            ->get()
            ->reject(function ($check) {
                return in_array($check->status, ['successful', 'failed']);
            });

        //All checks are complete, update log with status and timestamp
        if (!$incomplete->count()) {
            $failed = $this->checks->filter(function ($check) {
                return array_get($check, 'status') === 'failed';
            });

            $this->status = $failed->count() ? 'failed' : 'successful';
            $this->completed_at = Carbon::now();
            $this->save();

            //Initiate site recommendations check
            $this->site->runRecommendations();

            //Send email if asked for
            if ($this->site->email_when_ready) {
                $this->emailResults();
            }
        }

        return $this;
    }

    protected function emailResults()
    {
        \Log::info(url($this->site->source_url . '/frontend/' . $this->site->hash_id . '/recommendations'));
        $this->site->notify(new RecommendationsReadyNotification($this));
    }

    public function auditor()
    {
        return $this->morphTo();
    }
}
