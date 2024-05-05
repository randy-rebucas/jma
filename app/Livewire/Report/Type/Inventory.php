<?php

namespace App\Livewire\Report\Type;

use App\Enums\SaleTypeEnum;
use App\Models\Expense;
use App\Models\Sale;
use App\Models\Job;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class Inventory extends Component
{
    public $fromDate;

    public $toDate;
    public $sales = [];
    public $jobs = [];
    public $expenses = [];
    public $totalSales = 0;
    public $totalJobs = 0;
    public $totalExpenses = 0;
    public $grandTotal = 0;

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

        $this->sales = Sale::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->where('sale_type', 'sale')
            ->orderBy('created_at', 'desc')
            ->get();
        $this->totalSales = $this->sales->sum('total_amount');

        $this->jobs = Job::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->orderBy('created_at', 'desc')
            ->get();
        $this->totalJobs = $this->jobs->sum('total_amount');

        $this->expenses = Expense::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->orderBy('created_at', 'desc')
            ->get();
        $this->totalExpenses = $this->expenses->sum('amount');

        $this->grandTotal = $this->totalSales + $this->totalJobs - $this->totalExpenses;
    }

    #[On('printDateFiltered')]
    public function printFilter($from, $to)
    {
        dd($from);
    }

    public function render()
    {
        return view('livewire.report.type.inventory');
    }
}
