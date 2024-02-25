<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class Dashboard extends Component
{
    
    public function render()
    {
        // return view('dashboard.index', [
        //     'total_paid' => Order::sum('pay'),
        //     'total_due' => Order::sum('due'),
        //     'complete_orders' => Order::where('order_status', 'complete')->get(),
        //     'products' => Product::orderBy('product_store')->take(5)->get(),
        //     'new_products' => Product::orderBy('buying_date')->take(2)->get(),
        // ]);
        return view('livewire.dashboard');
    }
}
