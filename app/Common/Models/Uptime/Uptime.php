<?php

namespace App\Common\Models\Uptime;

use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Uptime\Traits\Relationship\UptimeRelationship;

class Uptime extends Model
{

    use UptimeRelationship;

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
        'user_id', 'url', 'freq', 'last_check', 'available', 'check',
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
        $this->table = config('emp-marketaing.sites_uptime_table');
        $this->connection = config('database.connections.marketaing.database');
    }
}
