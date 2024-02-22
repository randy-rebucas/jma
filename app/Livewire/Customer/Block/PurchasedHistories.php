<?php

namespace App\Livewire\Customer\Block;

use App\Models\Sale;
use Livewire\Component;

class PurchasedHistories extends Component
{
    public $sales;

    // public Sale $sale;
    public function render()
    {
        return view('livewire.customer.block.purchased-histories');
    }
}
