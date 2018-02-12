<?php

namespace App\Common\Models\Service;

use App\Common\Models\Data\DataSkill;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Translatable;

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
     * Foreign key for the translation relationship
     *
     * @var string
     */
    public $translationForeignKey = 'service_id';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The fields that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title', 'text', 'unit',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'active', 'multiple', 'ongoing', 'icon', 'generic', 'order',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('database.empire');
        $this->table = 'services';
    }

    /**
     * A Service belongs to a Service Category
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function skill()
    {
        return $this->belongsTo(DataSkill::class, 'data_id');
    }

    /**
     * A Service has many Prices (Cost/Wholesale/Retail)
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function prices()
    {
        return $this->hasMany(ServicePrice::class, 'service_id', 'id');
    }

    /**
     * A Service has a Retail Price
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasManyThrough
     */
    public function priceCost()
    {
        return $this->hasManyThrough(ServicePrice::class, ServicePriceTier::class, 'id', 'pricetier_id', 'service_id')->where('slug', 'cost');
    }

    /**
     * A Service has a Retail Price
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasManyThrough
     */
    public function priceWholesale()
    {
        return $this->hasManyThrough(ServicePrice::class, ServicePriceTier::class, 'id', 'pricetier_id', 'service_id')->where('slug', 'wholesale');
    }

    /**
     * A Service has a Retail Price
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasManyThrough
     */
    public function priceRetail()
    {
        return $this->hasManyThrough(ServicePrice::class, ServicePriceTier::class, 'id', 'pricetier_id', 'service_id')->where('slug', 'retail');
    }
}
