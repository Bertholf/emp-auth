<?php

namespace App\Common\Models\Timeline\Traits;

use App\Common\Models\Timeline\Timeline;

trait Timelineable
{
    /**
     * Can have timeline.
     *
     * @return mixed
     */
    public function timeline()
    {
        return $this->morphOne(Timeline::class, 'timelineable');
    }

    /**
     * Create timeline.
     *
     * @return mixed
     */
    public function createTimeline()
    {
        if ($timeline = $this->hasTimeline()) {
            return $timeline;
        }

        return $this->timeline()->create([]);
    }

    /**
     * Determine if timeline available.
     *
     * @return mixed
     */
    public function hasTimeline()
    {
        return $this->getTimeline();
    }

    /**
     * Get timeline.
     *
     * @return mixed
     */
    public function getTimeline()
    {
        return $this->timeline;
    }
}
