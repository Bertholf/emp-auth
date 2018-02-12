<?php

namespace App\Common\Models\Subscription;

use App\Common\Models\Subscription\Traits\Relationship\SubscriptionPromotionRelationship;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubscriptionPromotion
 * @package App\Common\Models\Subscription
 */
class SubscriptionPromotion extends Model
{
    use Translatable,
        SubscriptionPromotionRelationship;

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
    public $translationForeignKey = 'promotion_id';

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

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'discount_amount', 'discount_amount', 'generate', 'count_max',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date_valid', 'date_expires', 'created_at', 'updated_at'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('subscription.subscription_promotions_table');
    }
}
