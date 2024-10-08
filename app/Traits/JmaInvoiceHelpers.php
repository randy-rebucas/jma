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

    public function change(int $change)
    {
        $this->change = $change;

        return $this;
    }

    public function tenderedAmount(int $tendered_amount)
    {
        $this->tendered_amount = $tendered_amount;

        return $this;
    }
}
