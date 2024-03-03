<?php

namespace App\Livewire\Job;

use App\Enums\PaymentMethodEnum;
use App\Models\JobScopeOfWorks;
use Livewire\Component;
use App\Models\Job;
use App\Models\JobItem;
use App\Models\JobPayment;
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

    #[On('setCustomer')]
    public function setCustomer($customerId)
    {
        $this->customerId = $customerId;
    }

    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->mode = $mode;
    }

    public function doCanceled()
    {
        Cart::instance('job')->destroy();
        Cart::instance('scope')->destroy();
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

        $grand_total = Cart::instance('job')->total() + Cart::instance('scope')->total();

        $job = new Job();
        $job->job_type = $this->mode;
        $job->user_id = Auth::id();
        $job->customer_id = $this->customerId;
        $job->total_amount = $grand_total;

        if ($this->amount == $grand_total) {
            $job->paid = true;
        }
        $job->save();

        foreach (Cart::instance('job')->content() as $item) {
            $job_item = new JobItem();
            $job_item->job_id = $job->id;
            $job_item->quantity = $item->qty;
            $job_item->unit_price = $item->price;
            $job_item->sub_total = $item->total;
            $job_item->item_id = $item->id;
            $job_item->save();
        }
        
        foreach (Cart::instance('scope')->content() as $item) {
            $job_scope_of_works = new JobScopeOfWorks();
            $job_scope_of_works->job_id = $job->id;
            $job_scope_of_works->quantity = $item->qty;
            $job_scope_of_works->unit_price = $item->price;
            $job_scope_of_works->sub_total = $item->total;
            $job_scope_of_works->name = $item->name;
            $job_scope_of_works->save();
        }

        $job_payment = new JobPayment();
        $job_payment->job_id = $job->id;
        $job_payment->payment_type = $this->getTypeValue('payment-type');
        $job_payment->payment_amount = $this->amount;
        $job_payment->save();

        $this->dispatch('saleCompleted', serial: $job->serial);
    }

    public function mount()
    {
        $this->types = PaymentMethodEnum::toSelectArray();
        $this->type = $this->getTypeValue('payment-type');
    }
    
    #[On('addItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $this->total = Cart::instance('job')->total() + Cart::instance('scope')->total();
        return view('livewire.job.payment');
    }
}
