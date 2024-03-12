<?php

namespace App\Traits;

use LaravelDaily\Invoices\Contracts\PartyContract;
trait JmaInvoiceHelpers
{
    /**
     * @return $this
     */
    public function car(PartyContract $car)
    {
        $this->car = $car;

        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;

        return $this;
    }
}
