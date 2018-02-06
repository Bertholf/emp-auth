<?php

namespace App\Models\Common\Data;

use App\Models\Common\Data\Traits\Relationship\DataPillarRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DataPillar
 * @package App\Models\Common\Data
 */
class DataPillar extends Model
{
    use DataPillarRelationship,
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
    public $translationForeignKey = 'pillar_id';

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
        'slug', 'order', 'icon', 'title', 'text',
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
        $this->table = config('data.data_pillars_table');
    }
}
