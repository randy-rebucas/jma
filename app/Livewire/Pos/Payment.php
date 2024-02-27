<?php

namespace App\Livewire\Pos;

use App\Models\Job;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use App\Enums\JobTypeEnum;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class Payment extends Component
{
    public $total;
    public $amount;
    public $type;
    public $types = [];
    public $mode;
    public $customerId = null;

    #[On('change-mode')]
    public function changeRegisterMode($mode)
    {
        $this->mode = $mode;
    }

    public function changeType($type)
    {
        $this->type = $type;
    }

    #[On('setCustomer')]
    public function setCustomer($customerId)
    {
        $this->customerId = $customerId;
    }
    public function doCanceled()
    {
        Cart::instance('default')->destroy();
        Cart::instance('job')->destroy();
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
        $sale_item->sale_total_amount = Cart::instance('default')->total();
        $sale_item->save();

        $sale_payment = new SalePayment();
        $sale_payment->sale_id = $sale->id;
        $sale_payment->payment_type = $this->type;
        $sale_payment->payment_amount = $this->amount;
        $sale_payment->save();

        if ($this->mode == JobTypeEnum::ORDER || $sale->sale_type == JobTypeEnum::ESTIMATE) {
            $job = new Job();
            $job->type = $this->mode;
            $job->sale_id = $sale->id;
            $job->scope_of_works = json_encode(Cart::instance('job')->content());
            $job->total_amount = Cart::instance('job')->total();
            $job->save();
        }

        $this->dispatch('saleCompleted', serial: $sale->serial);
    }

    #[On('addItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $this->total = Cart::instance('default')->total() + Cart::instance('job')->total();
        $this->mode = session('mode');

        $this->type = config('settings.payment_type');

        $this->types = [
            'cash' => 'Cash',
            'credit' => 'Credit',
        ];
        return view('livewire.pos.payment');
    }
}
