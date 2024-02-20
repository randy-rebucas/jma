<?php

use App\Models\Setting;
use Livewire\Volt\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

new class extends Component {
    use LivewireAlert;

    public $modes = [];
    public $types = [];
    public $setting = [];

    public function mount()
    {
        $this->setting['business_name'] = config('settings.business_name');
        $this->setting['business_contact'] = config('settings.business_contact');
        $this->setting['business_address'] = config('settings.business_address');
        $this->setting['register_mode'] = config('settings.register_mode');
        $this->setting['payment_type'] = config('settings.payment_type');
        $this->setting['auto_print'] = (bool) config('settings.auto_print');

        $this->modes = [
            'sales' => 'Sales',
            'return' => 'Return',
            'order' => 'Order',
            'estimate' => 'Estimate',
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
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Settings') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Organize, Setup and Customized.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        <form wire:submit="save" class="w-full">
            <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
                <legend class="dark:text-gray-200 px-2">{{ __('Business Details') }}</legend>
                    <div class="mb-2 md:flex">
                        <div class="flex items-center md:w-1/4">
                            <x-input-label for="business_name" :value="__('Name')"
                                class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                        </div>
                        <div class="md:w-2/3">
                            <x-text-input wire:model="setting.business_name" id="business_name"
                                class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                type="text" />
                        </div>
                    </div>
                    <div class="md:flex mb-2">
                        <div class="flex items-center md:w-1/4">
                            <x-input-label for="business_contact" :value="__('Contact')"
                                class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                        </div>
                        <div class="md:w-2/3">
                            <x-text-input wire:model="setting.business_contact" id="business_contact"
                                class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                type="text" />
                        </div>
                    </div>
                    <div class="md:flex mb-2">
                        <div class="flex items-center md:w-1/4">
                            <x-input-label for="business_address" :value="__('Address')"
                                class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                        </div>
                        <div class="md:w-2/3">
                            <x-text-input wire:model="setting.business_address" id="business_address"
                                class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                type="text" />
                        </div>
                    </div>
            </fieldset>
            <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
                <legend class="dark:text-gray-200 px-2">{{ __('POS Settings') }}</legend>
                <div class="md:flex mb-2">
                    <div class="flex items-center md:w-1/4">
                        <x-input-label for="register_mode" :value="__('Default Register Mode')"
                            class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                    </div>
                    <div class="md:w-2/3">
                        <x-select wire:model="setting.register_mode" id="register_mode" name="register_mode"
                        :options="$modes" class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                    </div>
                </div>
                <div class="md:flex mb-2">
                    <div class="flex items-center md:w-1/4">
                        <x-input-label for="payment_type" :value="__('Default Payment Type')"
                            class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                    </div>
                    <div class="md:w-2/3">
                        <x-select wire:model="setting.payment_type" id="payment_type" name="payment_type"
                        :options="$types" class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                    </div>
                </div>
                <div class="md:flex mb-2">
                    <div class="flex items-center md:w-1/4">
                        <x-input-label for="payment_type" :value="__('Automatic Print')"
                            class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                    </div>
                    <div class="md:w-2/3">
                        <input value="1" wire:model="setting.auto_print" id="auto_print" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </div>
            </fieldset>
            <x-primary-button class="my-4" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-primary-button>
        </form>
    </div>
</section>
