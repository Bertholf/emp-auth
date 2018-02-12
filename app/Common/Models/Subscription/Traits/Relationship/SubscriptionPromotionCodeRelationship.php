<?php

namespace App\Common\Models\Subscription\Traits\Relationship;

use App\Common\Models\Subscription\SubscriptionPromotion;

/**
 * Class SubscriptionPromotionRelationship
 * @package App\Common\Models\Subscription\Traits\Relationship
 */
trait SubscriptionPromotionCodeRelationship
{

    /**
     * A promotion has one code
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotions()
    {
        return $this->BelongsTo(SubscriptionPromotion::class, 'promotion_code_id', 'promotion_id');
    }
}
