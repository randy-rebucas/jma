<x-slot name="header">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Manage Settings') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Organize, Setup and Customized.') }}
    </p>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">

                <div class="space-y-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                        <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 active"
                                    id="general-tab" data-tabs-target="#general" type="button" role="tab"
                                    aria-controls="general" aria-selected="true">{{ __('General') }}</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
                                    id="register-tab" data-tabs-target="#register" type="button" role="tab"
                                    aria-controls="register" aria-selected="false">{{ __('Register') }}</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
                                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                                    aria-controls="settings" aria-selected="false">{{ __('Settings') }}</button>
                            </li>
                        </ul>
                    </div>

                    <form wire:submit="save" class="w-full" id="myTabContent">
                        <div class="bg-gray-50 p-4 rounded-lg dark:bg-gray-800" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
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
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg dark:bg-gray-800 hidden" id="register" role="tabpanel"
                            aria-labelledby="register-tab">
                            <div class="md:flex mb-2">
                                <div class="flex items-center md:w-1/4">
                                    <x-input-label for="sale_register_mode" :value="__('Sale Mode')"
                                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                                </div>
                                <div class="md:w-2/3">
                                    <x-select wire:model="setting.sale_register_mode" id="sale_register_mode"
                                        name="sale_register_mode" :options="$sale_modes"
                                        class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                                </div>
                            </div>
                            <div class="md:flex mb-2">
                                <div class="flex items-center md:w-1/4">
                                    <x-input-label for="job_register_mode" :value="__('Job Mode')"
                                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                                </div>
                                <div class="md:w-2/3">
                                    <x-select wire:model="setting.job_register_mode" id="job_register_mode"
                                        name="job_register_mode" :options="$job_modes"
                                        class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                                </div>
                            </div>
                            <div class="md:flex mb-2">
                                <div class="flex items-center md:w-1/4">
                                    <x-input-label for="receiving_register_mode" :value="__('Receiving Mode')"
                                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                                </div>
                                <div class="md:w-2/3">
                                    <x-select wire:model="setting.receiving_register_mode"
                                        id="receiving_register_mode" name="receiving_register_mode" :options="$receiving_modes"
                                        class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                                </div>
                            </div>
                            <div class="md:flex mb-2">
                                <div class="flex items-center md:w-1/4">
                                    <x-input-label for="payment_type" :value="__('Payment Type')"
                                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                                </div>
                                <div class="md:w-2/3">
                                    <x-select wire:model="setting.payment_type" id="payment_type" name="payment_type"
                                        :options="$payment_methods"
                                        class="rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                                </div>
                            </div>
                            <div class="md:flex mb-2">
                                <div class="flex items-center md:w-1/4">
                                    <x-input-label for="payment_type" :value="__('Automatic Print')"
                                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                                </div>
                                <div class="md:w-2/3">
                                    <input value="1" wire:model="setting.auto_print" id="auto_print"
                                        type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg dark:bg-gray-800 hidden" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            <p class="text-gray-500 dark:text-gray-400 text-sm">This is some placeholder content
                                the
                                <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated
                                    content</strong>. Clicking another tab will toggle the visibility of this one
                                for the next. The tab JavaScript swaps classes to control the content visibility and
                                styling.
                            </p>
                        </div>
                        <x-primary-button class="my-4" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
</div>
