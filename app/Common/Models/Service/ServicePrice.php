<?php

namespace App\Common\Models\Service;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{

    /**
     * The database connection instance.
     *
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $connection;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        'service_id', 'pricetier_id', 'setup', 'recur',
    ];

    /**
     * A Price belongs to a Service
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'id', 'service_id');
    }

    /**
     * A Price belongs to a PriceTier
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function pricetier()
    {
        return $this->belongsTo(ServicePriceTier::class, 'pricetier_id');
    }

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('database.empire');
        $this->table = 'services_prices';
    }
}
