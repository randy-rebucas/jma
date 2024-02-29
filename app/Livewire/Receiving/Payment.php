<?php

namespace App\Livewire\Receiving;

use App\Models\Receiving;
use App\Models\ReceivingItem;
use App\Models\ReceivingPayment;
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
    public $supplierId = null;

    public function changeType($type)
    {
        $this->setTypeValue('payment-type', $type);
    }
    
    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->mode = $mode;
    }

    #[On('setSupplier')]
    public function setSupplier($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    public function doCanceled()
    {
        Cart::instance('receiving')->destroy();
        $this->dispatch('saleCanceled');
    }

    public function doComplete()
    {
        $this->validate([
            'type' => 'required',
            'amount' => 'required|gte:' . ($this->total),
        ]);

        Validator::make(
            ['supplier' => $this->supplierId],
            ['supplier' => 'required'],
            ['required' => 'The :attribute field is required'],
        )->validate();

        Validator::make(
            ['mode' => $this->mode],
            ['mode' => 'required'],
            ['required' => 'The register :attribute is required'],
        )->validate();

        $receiving = new Receiving();
        $receiving->receiving_type = $this->mode;
        $receiving->user_id = Auth::id();
        $receiving->supplier_id = $this->supplierId;
        $receiving->serial = Str::uuid();
        $receiving->save();

        $receiving_item = new ReceivingItem();
        $receiving_item->receiving_id = $receiving->id;
        $receiving_item->items = json_encode(Cart::instance('receiving')->content());
        $receiving_item->total_amount = Cart::instance('receiving')->total();
        $receiving_item->save();

        $receiving_payment = new ReceivingPayment();
        $receiving_payment->receiving_id = $receiving->id;
        $receiving_payment->payment_type = $this->getTypeValue('payment-type');
        $receiving_payment->payment_amount = $this->amount;
        $receiving_payment->save();

        $this->dispatch('saleCompleted', serial: $receiving->serial);
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
        $this->types['cash'] = 'Cash';
        $this->types['credit'] = 'Credit';

        $this->total = Cart::instance('receiving')->total();

        return view('livewire.receiving.payment');
    }
}
