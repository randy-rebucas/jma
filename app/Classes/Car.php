<?php

namespace App\Classes;

use LaravelDaily\Invoices\Contracts\PartyContract;

/**
 * Class Seller
 */
class Car implements PartyContract
{
    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    public $brand;

    /**
     * Seller constructor.
     */
    public function __construct()
    {
        $this->brand          = config('jma-invoices.car.attributes.brand');
    }
}
