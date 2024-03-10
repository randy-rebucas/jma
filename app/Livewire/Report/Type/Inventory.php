<?php

namespace App\Livewire\Report\Type;

use App\Enums\SaleTypeEnum;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class Inventory extends Component
{
    public $fromDate;

    public $toDate;
    public $items = [];
    public $sum = 0;

    public function mount()
    {
        $this->fromDate = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->toDate = Carbon::parse(Carbon::now())->format('Y-m-d');
    }

    #[On('dateFiltered')]
    public function setFilter($from, $to)
    {
        $this->fromDate = Carbon::parse($from)->format('Y-m-d');
        $this->toDate = Carbon::parse($to)->format('Y-m-d');

        $this->items = Sale::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->where('sale_type', SaleTypeEnum::SALE)
            ->orderBy('created_at', 'desc')
            ->get();

        $this->sum = $this->items->sum('total_amount');
    }


    public function render()
    {
        return view('livewire.report.type.inventory');
    }
}
