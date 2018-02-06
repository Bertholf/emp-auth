<?php

namespace App\Models\Common\Data;

use App\Models\Common\Data\Traits\Relationship\DataKPIRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DataKPI
 * @package App\Models\Common\Data
 */
class DataKPI extends Model
{
    use DataKPIRelationship,
        Translatable;

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
    public $translationForeignKey = 'data_id';

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
        'title', 'text',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'unit', 'title', 'text', 'active', 'featured',
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
        $this->table = config('data.data_kpis_table');
    }
}
