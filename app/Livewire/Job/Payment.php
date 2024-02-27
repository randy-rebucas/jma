<?php

namespace App\Livewire\Job;

use Livewire\Component;
use App\Models\Job;
use App\Models\JobItem;
use App\Models\JobPayment;
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
    public $customerId = null;

    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->setMode($mode);
    }

    public function setMode($mode) {
        session()->put('job-mode', $mode);
    }

    public function getMode() {
        if (!session('job-mode')) {
            $this->setMode(config('settings.job_register_mode'));
        }

        return session('job-mode');
    }

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
            ['mode' => $this->getMode()],
            ['mode' => 'required'],
            ['required' => 'The register :attribute is required'],
        )->validate();

        $job = new Job();
        $job->job_type = $this->getMode();
        $job->user_id = Auth::id();
        $job->customer_id = $this->customerId;
        $job->serial = Str::uuid();
        $job->save();

        $job_item = new JobItem();
        $job_item->job_id = $job->id;
        $job_item->items = json_encode(Cart::instance('job')->content());
        $job_item->total_amount = Cart::instance('job')->total();
        $job_item->save();

        $job_payment = new JobPayment();
        $job_payment->job_id = $job->id;
        $job_payment->payment_type = $this->getType();
        $job_payment->payment_amount = $this->amount;
        $job_payment->save();

        $this->dispatch('saleCompleted', serial: $job->serial);
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

        $this->total = Cart::instance('job')->total();
        return view('livewire.job.payment');
    }
}
