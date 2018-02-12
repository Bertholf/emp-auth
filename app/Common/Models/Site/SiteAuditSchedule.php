<?php

namespace App\Common\Models\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Site\Traits\Relationship\SiteAuditScheduleRelationship;

class SiteAuditSchedule extends Model
{
    use SiteAuditScheduleRelationship;

    protected $fillable = ['checks', 'next_audit_at', 'status', 'recurring', 'frequency'];

    protected $dates = ['next_audit_at', 'last_audit_at'];

    protected $casts = [
        'checks' => 'json',
        'recurring' => 'bool'
    ];

    /**
     * @inheritdoc
     */
    public function asDateTime($value)
    {
        $date = Carbon::parse($value);
        if ($date) {
            return $date;
        }
        parent::asDateTime($value);
    }

    public function __construct()
    {
      parent::__construct();
      $this->connection = config('database.connections.marketaing.database');
    }
}
