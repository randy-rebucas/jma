<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use App\Models\Setting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use LivewireAlert;

    public $sale_modes = [];
    public $job_modes = [];
    public $types = [];
    public $setting = [];

    public function mount()
    {
        $this->setting['business_name'] = config('settings.business_name');
        $this->setting['business_contact'] = config('settings.business_contact');
        $this->setting['business_address'] = config('settings.business_address');
        $this->setting['sale_register_mode'] = config('settings.sale_register_mode');
        $this->setting['job_register_mode'] = config('settings.job_register_mode');
        $this->setting['payment_type'] = config('settings.payment_type');
        $this->setting['auto_print'] = (bool) config('settings.auto_print');

        $this->sale_modes = [
            'sale' => 'Sale',
            'return' => 'Return'
        ];

        $this->job_modes = [
            'order' => 'Order',
            'estimate' => 'Estimate'
        ];

        $this->types = [
            'cash' => 'Cash',
            'credit' => 'Credit',
        ];
    }

    /**
     * Delete the sale.
     */
    public function save()
    {
        foreach ($this->setting as $key => $value) {
            $item = Setting::where('key', $key)->first();

            if (empty($item)) {
                Setting::create([
                    'key' => $key,
                    'value' => $value,
                ]);
            } else {
                Setting::where('key', $key)->update(['value' => $value]);
            }
        }

        $this->alert('success', 'Settings successfully registered.', [
            'position' => 'center',
            'toast' => false
        ]);
    }
    public function render()
    {
        return view('livewire.setting.index');
    }
}
