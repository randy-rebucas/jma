<?php

namespace App\Livewire\Sale;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use Livewire\Component;
use App\Facades\Cart;
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

    protected $listeners = ['removeItem', 'addItem', 'saleCompleted'];

    private function getCartTotal()
    {
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
    public function mount($activeMode = 'sales'): void
    {
        $this->mode = $activeMode;

        $this->getCartTotal();

        $this->types = [
            'cash' => 'Cash',
            'credit' => 'Credit',
        ];

        $this->type = 'cash';

        if ($this->customerId) {
            $this->setCustomer($this->customerId);
        }
    }

    public function saleCompleted()
    {
        $this->getCartTotal();
        $this->amount = '';
        $this->details = null;
    }
    public function addItem()
    {
        $this->getCartTotal();
    }
    public function removeItem()
    {
        $this->getCartTotal();
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
            'customer_id' => $this->customerId
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

        Cart::clear();
        session()->flash('status', 'Sales successfully registered.');
        $this->dispatch('saleCompleted');
    }
    public function render()
    {
        return view('livewire.sale.summary', [
            'total' => $this->total,
        ]);
    }
}
