<?php

namespace App\Common\Models\Term\Traits\Relationship;

use App\Common\Models\Term\Term;

/**
 * Class TermExampleRelationship
 * @package App\Common\Models\Term\Traits\Relationship
 */
trait TermExampleRelationship
{

    /**
     * An example belongs to a term
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
