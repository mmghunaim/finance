<?php

namespace App\Domain;

use Spatie\EventSourcing\ShouldBeStored;

final class CategoryCreated implements ShouldBeStored
{
    public $attributes;

    /**
     * WalletOpened constructor.
     * @param $attributes
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }
}
