<?php

namespace App\Livewire\Job;

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

        $job = new Job();
        $job->job_type = $this->mode;
        $job->user_id = Auth::id();
        $job->customer_id = $this->customerId;
        $job->serial = Str::uuid();
        $job->save();

        $job_item = new JobItem();
        $job_item->job_id = $job->id;
        $job_item->items = json_encode(Cart::instance('job')->content());
        $job_item->total_amount = Cart::instance('job')->total();
        $job_item->save();

        $job_scope_of_works = new JobScopeOfWorks();
        $job_scope_of_works->job_id = $job->id;
        $job_scope_of_works->scopes = json_encode(Cart::instance('scope')->content());
        $job_scope_of_works->total_amount = Cart::instance('scope')->total();
        $job_scope_of_works->save();

        $job_payment = new JobPayment();
        $job_payment->job_id = $job->id;
        $job_payment->payment_type = $this->getTypeValue('payment-type');
        $job_payment->payment_amount = $this->amount;
        $job_payment->save();

        $this->dispatch('saleCompleted', serial: $job->serial);
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

        $this->total = Cart::instance('job')->total() + Cart::instance('scope')->total();
        return view('livewire.job.payment');
    }
}
