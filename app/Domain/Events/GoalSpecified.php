<?php

namespace App\Domain\Events;

use Spatie\EventSourcing\ShouldBeStored;

final class GoalSpecified implements ShouldBeStored
{
    public $attributes;

    /**
     * GoalSpecified constructor.
     * @param $attributes
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }
}