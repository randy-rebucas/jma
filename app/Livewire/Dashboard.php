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
    public function navigate() {
        return $this->redirect('/inventories', navigate: true);
    }

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
                'total_jobs' => $total_job,
                'total_sales' => $total_sale,
                'total_receivings' => $total_receiving,
                'items' => Item::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
                'inventories' => Inventory::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
            ]
        );
    }

}
