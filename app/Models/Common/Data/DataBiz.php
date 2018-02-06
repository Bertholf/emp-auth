<?php

namespace App\Models\Common\Data;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DataBiz
 * @package App\Models\Common\Data
 */
class DataBiz extends Model
{
    use Translatable;

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
        'type', 'slug', 'active', 'title', 'text',
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
        $this->table = config('data.data_biz_table');
    }
}
