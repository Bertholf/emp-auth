<?php

namespace App\Common\Models\Service;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ServicePriceTier extends Model
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
    public $translationForeignKey = 'pricetier_id';

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
        'title', 'text', 'currency',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'order', 'active', 'title', 'text', 'currency',
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
        $this->table = 'services_pricetiers';
    }
}
