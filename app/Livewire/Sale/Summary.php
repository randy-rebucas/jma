<?php

namespace App\Livewire\Sale;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use Livewire\Component;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;
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

    protected $listeners = ['refreshItem' => '$refresh'];

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
        $this->totalQuantity = Cart::count();
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

    public function changeType($type) {
        $this->type = $type;
    }

    public function doCanceled()
    {
        Cart::destroy();
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

        $sale = new Sale();
        $sale->sale_type = $this->mode;
        $sale->user_id = Auth::id();
        $sale->customer_id = $this->customerId;
        $sale->serial = Str::uuid();
        $sale->save();

        $sale_item = new SaleItem();
        $sale_item->sale_id = $sale->id;
        $sale_item->items = json_encode(Cart::content());
        $sale_item->sale_total_amount = $this->total;
        $sale_item->save();
        
        $sale_payment = new SalePayment();
        $sale_payment->sale_id = $sale->id;
        $sale_payment->payment_type = $this->type;
        $sale_payment->payment_amount = $this->amount;
        $sale_payment->save();
        
        $this->dispatch('saleCompleted', serial: $sale->serial);
    }


    public function render()
    {
        return view('livewire.sale.summary', [
            'total' => $this->total,
        ]);
    }
}
