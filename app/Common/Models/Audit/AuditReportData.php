<?php

namespace App\Common\Models\Audit;

use App\Common\Models\Audit\Traits\Relationship\AuditReportDataRelationship;
use Illuminate\Database\Eloquent\Model;

class AuditReportData extends Model
{
    use AuditReportDataRelationship;

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
        'report_id', 'factor_id', 'data', 'analysis',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('app-audit.audit_reports_data_table');
    }
}
