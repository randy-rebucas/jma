<div>
    <form wire:submit="save" class="w-full" id="myTabContent">

        <div class="mb-2 md:flex p-4 shadow">
            <div class="flex items-center md:w-1/2">
                <x-input-label for="business_name" :value="__('Name')"
                    class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
            </div>
            <div class="md:w-1/2">
                <x-text-input wire:model="setting.business_name" id="business_name"
                    class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    type="text" />
            </div>
        </div>
        <div class="md:flex mb-2 p-4 shadow">
            <div class="flex items-center md:w-1/2">
                <x-input-label for="business_contact" :value="__('Contact')"
                    class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
            </div>
            <div class="md:w-1/2">
                <x-text-input wire:model="setting.business_contact" id="business_contact"
                    class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    type="text" />
            </div>
        </div>
        <div class="md:flex mb-2 p-4 shadow">
            <div class="flex items-center md:w-1/2">
                <x-input-label for="business_address" :value="__('Address')"
                    class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
            </div>
            <div class="md:w-1/2">
                <x-text-input wire:model="setting.business_address" id="business_address"
                    class="block rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    type="text" />
            </div>
        </div>

        <div class="md:flex mb-2 p-4 shadow">
            <div class="flex items-start flex-col md:w-1/2">
                <x-input-label for="sale_register_mode" :value="__('Sale Mode')"
                    class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                    <span
                    class="text-gray-400 text-sm">{{ __('This will set as default register sales.') }}</span>
            </div>
            <div class="md:w-1/2">
                <x-select wire:model="setting.sale_register_mode" id="sale_register_mode" name="sale_register_mode"
                    :options="$sale_modes"
                    class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
            </div>
        </div>
        <div class="md:flex mb-2 p-4 shadow">
            <div class="flex items-start flex-col md:w-1/2">
                <x-input-label for="job_register_mode" :value="__('Job Mode')"
                    class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                    <span
                    class="text-gray-400 text-sm">{{ __('This will set as default register jobs.') }}</span>
            </div>
            <div class="md:w-1/2">
                <x-select wire:model="setting.job_register_mode" id="job_register_mode" name="job_register_mode"
                    :options="$job_modes"
                    class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
            </div>
        </div>
        <div class="md:flex mb-2 p-4 shadow">
            <div class="flex items-start flex-col md:w-1/2">
                <x-input-label for="receiving_register_mode" :value="__('Receiving Mode')"
                    class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                    <span
                    class="text-gray-400 text-sm">{{ __('This will set as default register receivings.') }}</span>
            </div>
            <div class="md:w-1/2">
                <x-select wire:model="setting.receiving_register_mode" id="receiving_register_mode"
                    name="receiving_register_mode" :options="$receiving_modes"
                    class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
            </div>
        </div>
        <div class="md:flex mb-2 p-4 shadow">
            <div class="flex items-start flex-col md:w-1/2">
                <x-input-label for="payment_type" :value="__('Payment Type')"
                    class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                <span
                    class="text-gray-400 text-sm">{{ __('This will set as default payment option on register jobs, sales and receivings.') }}</span>
            </div>
            <div class="md:w-1/2">
                <x-select wire:model="setting.payment_type" id="payment_type" name="payment_type" :options="$payment_methods"
                    class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
            </div>
        </div>

        <x-primary-button class="mb-2 ml-4" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-primary-button>
    </form>
</div>
