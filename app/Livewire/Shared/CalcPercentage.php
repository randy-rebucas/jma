<?php

namespace App\Livewire\Shared;

use App\Models\Inventory;
use App\Models\Job;
use App\Models\Receiving;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class CalcPercentage extends Component
{
    public $total;
    public $model;
    public $count = 0;
    public $percentage;
    public $percentageCacl;
    public $prev_total_job = 0;
    public $prev_total_sale = 0;
    public $prev_total_receiving = 0;
    public function mount()
    {
        $job_sub_totals = Inventory::selectRaw('sum(transaction_total_amount)')
            ->whereColumn('serial', 'jobs.serial')->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->getQuery();
        $total_jobs = Job::select('jobs.*')
            ->selectSub($job_sub_totals, 'total')
            ->get();

        foreach ($total_jobs as $key => $value) {
            $this->prev_total_job += $value->total;
        }
        // Sales
        $sale_sub_totals = Inventory::selectRaw('sum(transaction_total_amount)')
            ->whereColumn('serial', 'sales.serial')->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->getQuery();
        $total_sales = Sale::select('sales.*')
            ->selectSub($sale_sub_totals, 'total')
            ->get();

        foreach ($total_sales as $key => $value) {
            $this->prev_total_sale += $value->total;
        }

        // receiving
        $receiving_sub_totals = Inventory::selectRaw('sum(transaction_total_amount)')
            ->whereColumn('serial', 'receivings.serial')->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->getQuery();
        $total_receivings = Receiving::select('receivings.*')
            ->selectSub($receiving_sub_totals, 'total')
            ->get();

        foreach ($total_receivings as $key => $value) {
            $this->prev_total_receiving += $value->total;
        }

        switch ($this->model) {
            case 'job':
                $this->percentage = ($this->total - $this->prev_total_job) / $this->prev_total_job;
                break;
            case 'receiving':
                $this->percentage = ($this->total - $this->prev_total_sale) / $this->prev_total_sale;
                break;
            default: // sale
                $this->percentage = ($this->total - $this->prev_total_receiving) / $this->prev_total_receiving;
                break;
        }
        // $this->percentage = round($this->percentageCacl * 100);
    }

    public function render()
    {
        return view('livewire.shared.calc-percentage');
    }
}
