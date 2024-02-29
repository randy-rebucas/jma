<?php

namespace App\Livewire;

use App\Models\Inventory;
use App\Models\Item;
use App\Models\Job;
use App\Models\Receiving;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class Dashboard extends Component
{
    // 12622.0 
    public function render()
    {
        // Jobs
        $total_job = 0;
        $job_sub_totals = Inventory::selectRaw('sum(transaction_total_amount)')
            ->whereColumn('serial', 'jobs.serial')->whereMonth('created_at', Carbon::now()->month)
            ->getQuery();
        $total_jobs = Job::select('jobs.*')
            ->selectSub($job_sub_totals, 'total')
            ->get();

        foreach ($total_jobs as $key => $value) {
            $total_job += $value->total;
        }

        // Sales
        $total_sale = 0;
        $sale_sub_totals = Inventory::selectRaw('sum(transaction_total_amount)')
            ->whereColumn('serial', 'sales.serial')->whereMonth('created_at', Carbon::now()->month)
            ->getQuery();
        $total_sales = Sale::select('sales.*')
            ->selectSub($sale_sub_totals, 'total')
            ->get();

        foreach ($total_sales as $key => $value) {
            $total_sale += $value->total;
        }

        // receiving
        $total_receiving = 0;
        $receiving_sub_totals = Inventory::selectRaw('sum(transaction_total_amount)')
            ->whereColumn('serial', 'receivings.serial')->whereMonth('created_at', Carbon::now()->month)
            ->getQuery();
        $total_receivings = Receiving::select('receivings.*')
            ->selectSub($receiving_sub_totals, 'total')
            ->get();

        foreach ($total_receivings as $key => $value) {
            $total_receiving += $value->total;
        }

        return view(
            'livewire.dashboard',
            [
                'total_jobs' => number_format($total_job, 2),
                'total_sales' => number_format($total_sale, 2),
                'total_receivings' => number_format($total_receiving, 2),
                'items' => Item::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
                'inventories' => Inventory::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
            ]
        );
    }

}
