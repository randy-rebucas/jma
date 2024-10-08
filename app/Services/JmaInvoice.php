<?php

namespace App\Services;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Contracts\PartyContract;
use App\Traits\JmaInvoiceHelpers;
use App\Classes\ScopeItem;
use Illuminate\Support\Collection;

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

        /**
     * @var int
     */
    public $change;

        /**
     * @var int
     */
    public $tendered_amount;

        /**
     * @var int
     */
    public $total_scope_of_works;
    
        /**
     * @var int
     */
    public $total_items;

    /**
     * @var Collection
     */
    public $scopes;

    public function __construct($name = '')
    {
        parent::__construct($name);
        $this->scopes = Collection::make([]);
    }

    /**
     * @return ScopeItem
     */
    public static function makeItem(string $title = '')
    {
        return(new ScopeItem())->title($title);
    }

    /**
     * @return $this
     */
    public function addScope(ScopeItem $scope)
    {
        $this->scopes->push($scope);

        return $this;
    }

    /**
     * @param $scopes
     *
     * @return $this
     */
    public function addScopes($scopes)
    {
        foreach ($scopes as $scope) {
            $this->addScope($scope);
        }

        return $this;
    }
}