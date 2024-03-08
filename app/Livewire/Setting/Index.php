<?php

namespace App\Livewire\Setting;

use App\Enums\JobTypeEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\ReceivingTypeEnum;
use App\Enums\SaleTypeEnum;
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
    public $receiving_modes = [];
    public $payment_methods = [];
    public $setting = [];

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

    public function mount()
    {
        $this->setting['business_name'] = config('settings.business_name');
        $this->setting['business_contact'] = config('settings.business_contact');
        $this->setting['business_address'] = config('settings.business_address');
        $this->setting['sale_register_mode'] = config('settings.sale_register_mode');
        $this->setting['job_register_mode'] = config('settings.job_register_mode');
        $this->setting['receiving_register_mode'] = config('settings.receiving_register_mode');
        $this->setting['payment_type'] = config('settings.payment_type');
        $this->setting['auto_print'] = (bool) config('settings.auto_print');

        $this->receiving_modes = ReceivingTypeEnum::toSelectArray();
        $this->job_modes = JobTypeEnum::toSelectArray();
        $this->sale_modes = SaleTypeEnum::toSelectArray();
        $this->payment_methods = PaymentMethodEnum::toSelectArray();
    }
    
    public function render()
    {
        // logo
        // lines_per_page
        // dateformat
        // timeformat

        // baclup db
        return view('livewire.setting.index');
    }
}
