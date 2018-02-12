<?php

namespace App\Common\Models\Data\Traits\Relationship;

use App\Common\Models\Term\Term;
use App\Common\Models\Data\DataFactor;

/**
 * Class DataFactorRelationship
 * @package App\Common\Models\Data\Traits\Relationship
 */
trait DataFactorRelationship
{

    /**
     * Audit Factor Parent
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(DataFactor::class, 'parent_id');
    }

    /**
     * Audit Factor Children
     *
     * @return \Illuminate\Database\Eloquent\Relationships\HasMany
     */
    public function children()
    {
        return $this->hasMany(DataFactor::class, 'parent_id');
    }

    /**
     * A Factor belongs to a Topic
     *
     * @return \Illuminate\Database\Eloquent\Relationships\BelongsTo
     */
    public function term()
    {
        return $this->belongsTo(Term::class, 'glossary_id');
    }
}
