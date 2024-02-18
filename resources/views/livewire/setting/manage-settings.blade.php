<?php

use App\Models\Setting;
use Livewire\Volt\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

new class extends Component {
    use LivewireAlert;


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
            <div class="border-b mb-6 md:flex pb-6">
                <div class="flex items-center md:w-1/4">
                    <x-input-label for="business_name" :value="__('Business Name')"
                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                </div>
                <div class="md:w-2/3">
                    <x-text-input wire:model="setting.business_name" id="business_name"
                        class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        type="text" />
                </div>
            </div>
            <div class="md:flex mb-6">
                <div class="flex items-center md:w-1/4">
                    <x-input-label for="business_contact" :value="__('Business Contact')"
                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                </div>
                <div class="md:w-2/3">
                    <x-text-input wire:model="setting.business_contact" id="business_contact"
                        class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        type="text" />
                </div>
            </div>

            <x-primary-button class="my-4" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-primary-button>
        </form>
    </div>
</section>
