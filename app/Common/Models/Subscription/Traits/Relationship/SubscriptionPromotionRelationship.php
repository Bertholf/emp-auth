<?php

namespace App\Common\Models\Subscription\Traits\Relationship;

use App\Common\Models\Subscription\SubscriptionPromotionCode;

/**
 * Class SubscriptionPromotionRelationship
 * @package App\Common\Models\Subscription\Traits\Relationship
 */
trait SubscriptionPromotionRelationship
{

    /**
     * A promotion has one code
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->HasMany(SubscriptionPromotionCode::class, 'promotion_code_id', 'promotion_id');
    }
}
