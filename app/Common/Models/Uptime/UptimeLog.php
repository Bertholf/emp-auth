<?php

namespace App\Common\Models\Uptime;

use Illuminate\Database\Eloquent\Model;

class UptimeLog extends Model
{
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
        'site_id', 'reachable', 'latency', 'status_code'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-marketaing.sites_uptime_logs_table');
        $this->connection = config('database.connections.marketaing.database');
    }
}
