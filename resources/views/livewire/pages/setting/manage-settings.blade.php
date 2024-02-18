<?php

use App\Models\Setting;
use Livewire\Volt\Component;

new class extends Component {

    public $setting = [];

    public function mount()
    {
        $this->setting['business_name'] = config('settings.business_name');
        $this->setting['business_contact'] = config('settings.business_contact');
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
        <form wire:submit="save">

            <x-input-label for="business_name" :value="__('Business Name')" />
            <x-text-input wire:model="setting.business_name" id="business_name" class="block mt-1 w-full" type="text" />
            
            <x-input-label for="business_contact" :value="__('Business Contact')" />
            <x-text-input wire:model="setting.business_contact" id="business_contact" class="block mt-1 w-full" type="text" />

            <x-primary-button class="my-4" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-primary-button>
        </form>
    </div>
</section>
