<?php

namespace App\Livewire\Sale;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Summary extends Component
{
    public $mode;
    public $total;
    public $totalQuantity;
    public $type;
    public $amount;
    public $types = [];

    public $hasSelected = false;
    public $search;
    public $records;
    public $details;
    public $customerId;

    #[On('change-mode')] 
    public function changeRegisterMode($mode)
    {
        $this->mode = $mode;
    }

    #[On('saleCompleted')] 
    #[On('saleCanceled')] 
    #[On('removeItem')] 
    #[On('addItem')] 
    #[On('clearItem')]
    public function getCartTotal()
    {
        $this->amount = '';
        $this->details = null;
        $this->total = Cart::total();
        $this->totalQuantity = Cart::quantity();
    }

    public function searchResult()
    {
        $this->records = Customer::orderby('first_name', 'asc')
            ->select('*')
            ->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get();
    }
    public function setCustomer($id)
    {
        $record = Customer::select('*')
            ->where('id', $id)
            ->first();

        $this->details = $record;

        $this->customerId = $id;
        $this->records = [];
        $this->search = '';
    }
    public function mount(): void
    {
        $this->mode = config('settings.register_mode');
        $this->type = config('settings.payment_type');

        $this->types = [
            'cash' => 'Cash',
            'credit' => 'Credit',
        ];

        if ($this->customerId) {
            $this->setCustomer($this->customerId);
        }

        $this->getCartTotal();
    }

    public function doCanceled()
    {
        Cart::clear();
        $this->dispatch('saleCanceled');
    }

    public function doComplete()
    {
        $this->validate([
            'type' => 'required',
            'amount' => 'required|gte:' . $this->total,
        ]);

        Validator::make(
            ['customer' => $this->customerId],
            ['customer' => 'required'],
            ['required' => 'The :attribute field is required'],
        )->validate();

        $sale = Sale::create([
            'sale_status' => 'paid',
            'sale_type' => $this->mode,
            'user_id' => Auth::id(),
            'customer_id' => $this->customerId,
            'serial' => Str::uuid()
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'items' => json_encode(Cart::content()),
            'sale_total_amount' => $this->total,
        ]);

        SalePayment::create([
            'sale_id' => $sale->id,
            'payment_type' => $this->type,
            'payment_amount' => $this->amount
        ]);
        
        $this->dispatch('saleCompleted', serial: $sale->serial);
    }


    public function render()
    {
        return view('livewire.sale.summary', [
            'total' => $this->total,
        ]);
    }
}
