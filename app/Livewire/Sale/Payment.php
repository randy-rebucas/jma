<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Traits\CartSession;

class Payment extends Component
{
    use CartSession;

    public $mode;
    public $total;
    public $amount;
    public $type;
    public $types = [];
    public $customerId = null;

    public function changeType($type)
    {
        $this->setType($type);
    }

    public function setType($mode) {
        session()->put('payment-type', $mode);
    }

    public function getType() {
        if (!session('payment-type')) {
            $this->setType(config('settings.payment_type'));
        }

        return session('payment-type');
    }

    #[On('setCustomer')]
    public function setCustomer($customerId)
    {
        $this->customerId = $customerId;
    }

    public function doCanceled()
    {
        Cart::instance('default')->destroy();
        $this->dispatch('saleCanceled');
    }

    public function doComplete()
    {
        $this->validate([
            'type' => 'required',
            'amount' => 'required|gte:' . ($this->total),
        ]);

        Validator::make(
            ['customer' => $this->customerId],
            ['customer' => 'required'],
            ['required' => 'The :attribute field is required'],
        )->validate();

        Validator::make(
            ['mode' => $this->mode],
            ['mode' => 'required'],
            ['required' => 'The register :attribute is required'],
        )->validate();

        $sale = new Sale();
        $sale->sale_type = $this->mode;
        $sale->user_id = Auth::id();
        $sale->customer_id = $this->customerId;
        $sale->serial = Str::uuid();
        $sale->save();

        $sale_item = new SaleItem();
        $sale_item->sale_id = $sale->id;
        $sale_item->items = json_encode(Cart::instance('default')->content());
        $sale_item->total_amount = Cart::instance('default')->total();
        $sale_item->save();

        $sale_payment = new SalePayment();
        $sale_payment->sale_id = $sale->id;
        $sale_payment->payment_type = $this->getType();
        $sale_payment->payment_amount = $this->amount;
        $sale_payment->save();

        $this->dispatch('saleCompleted', serial: $sale->serial);
    }

    #[On('addItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $this->types['cash'] = 'Cash';
        $this->types['credit'] = 'Credit';

        $this->total = Cart::instance('default')->total();

        return view('livewire.sale.payment');
    }
}
