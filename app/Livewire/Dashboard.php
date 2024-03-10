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
    public function navigate()
    {
        return $this->redirect('/inventories', navigate: true);
    }

    public function render()
    {
        return view(
            'livewire.dashboard',
            [
                'total_sales' => Sale::orderBy('created_at', 'desc')->whereMonth('created_at', Carbon::now()->month)->get()->sum('total_amount'),
                'total_jobs' => Job::orderBy('created_at', 'desc')->whereMonth('created_at', Carbon::now()->month)->get()->sum('total_amount'),
                'total_receivings' => Receiving::orderBy('created_at', 'desc')->whereMonth('created_at', Carbon::now()->month)->get()->sum('total_amount'),
                'items' => Item::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
                'inventories' => Sale::orderBy('created_at', 'desc')->limit(5)->latest()->get(),
            ]
        );
    }

}
