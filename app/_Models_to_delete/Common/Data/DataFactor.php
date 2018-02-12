<?php

namespace App\Common\Models\Data;

use App\Common\Models\Data\Traits\Relationship\DataFactorRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class DataFactor extends Model
{
    use Translatable,
        DataFactorRelationship;

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
    public $translationForeignKey = 'factor_id';

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
        'slug', 'icon', 'parent_id', 'topic_id', 'glossary_id', 'title', 'text', 'text_sell', 'text_show'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('data.data_factors_table');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
