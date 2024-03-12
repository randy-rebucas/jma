<?php

namespace App\Services;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Contracts\PartyContract;
use App\Traits\JmaInvoiceHelpers;

class JmaInvoice extends Invoice
{
    use JmaInvoiceHelpers;
    /**
     * @var PartyContract
     */
    public $car;

    /**
     * @var string
     */
    public $type;


}