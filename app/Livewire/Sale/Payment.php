<?php

namespace App\Livewire\Sale;

use App\Enums\PaymentMethodEnum;
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
        $this->setTypeValue('payment-type', $type);
    }

    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->mode = $mode;
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
        $sale->total_amount = Cart::instance('default')->total();
        $sale->save();

        foreach (Cart::instance('default')->content() as $item) {
            $sale_item = new SaleItem();
            $sale_item->sale_id = $sale->id;
            $sale_item->quantity = $item->qty;
            $sale_item->unit_price = $item->price;
            $sale_item->sub_total = $item->total;
            $sale_item->item_id = $item->id;
            $sale_item->save();
        }

        $sale_payment = new SalePayment();
        $sale_payment->sale_id = $sale->id;
        $sale_payment->payment_type = $this->getTypeValue('payment-type');
        $sale_payment->payment_amount = $this->amount;
        $sale_payment->save();

        $this->dispatch('saleCompleted', serial: $sale->serial);
    }

    public function mount()
    {
        $this->type = $this->getTypeValue('payment-type');
    }

    #[On('addItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $this->types = PaymentMethodEnum::toSelectArray();

        $this->total = Cart::instance('default')->total();

        return view('livewire.sale.payment');
    }
}
