<?php

namespace App\Common\Models\Data;

use Auth;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Common\Models\Data\Traits\Relationship\DataRecommendationRelationship;

class DataRecommendation extends Model
{
    use Translatable, DataRecommendationRelationship;

    const GLOBAL_DISABLED = 0;
    const GLOBAL_ENABLED = 1;

    const RECOM_COSTUM = 0;
    const RECOM_GOOGLE = 1;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The fields that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'user_id', 'title', 'text', 'text_pass', 'text_fail', 'link',
    ];
    /**
     * Foreign key for the translation relationship
     *
     * @var string
     */
    public $translationForeignKey = 'recommendation_id';
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
        // Common
        'slug', 'agency_id', 'user_id', 'global', 'type',
        // Dynamic
        'groups',
        // Hard Coded
        'node',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'groups' => 'json',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('emp-marketaing.data_recommendations_table');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($recommend) {
            if ($agency = session('agency')) {
                $recommend->agency_id = $agency['id'];
            }
        });
        static::saving(function ($recommend) {
            if (Auth::check()) {
                $recommend->user_id = Auth::user()->id;
            }
            if (!$recommend->global) {
                $recommend->global = 0;
            }
        });
    }

    /**
     * What is the primary route key
     *
     * @var string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
