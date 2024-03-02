<?php

namespace App\Livewire;

use App\Models\Inventory;
use App\Models\Item;
use App\Models\Job;
use App\Models\Receiving;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $total_sale = 0;

    public function navigate() {
        return $this->redirect('/inventories', navigate: true);
    }

    public function render()
    {
        $this->total_sale = DB::table('sales')->whereMonth('created_at', Carbon::now()->month)->sum('total_amount');
        
        return view(
            'livewire.dashboard',
            [
                // 'total_jobs' => $total_job,
                'total_sales' => $this->total_sale,
                // 'total_receivings' => $total_receiving,
                'items' => Item::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
                'inventories' => Inventory::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
            ]
        );
    }

}
