<?php

namespace App\Common\Models\Audit;

use App\Common\Models\Audit\Traits\Relationship\AuditReportRelationship;
use App\Common\Models\Timeline\Traits\Timelineable;
use Illuminate\Database\Eloquent\Model;

class AuditReport extends Model
{
    use AuditReportRelationship,
        Timelineable;

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
        'pricing_id', 'paid', 'topic_id', 'team_id', 'text',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-audit.audit_reports_table');
    }
}
