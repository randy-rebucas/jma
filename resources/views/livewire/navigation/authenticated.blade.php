<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        @if (config('settings.business_logo'))
                            <img src="{{ asset('storage/' . config('settings.business_logo')) }}"
                                class="w-48 h-auto fill-current">
                        @else
                            <img src="https://placehold.co/150x60?text=Logo" alt="placeholder">
                        @endif
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @can('customer.menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('customers')" :active="request()->routeIs('customers')" wire:navigate>
                            {{ __('Customers') }}
                        </x-nav-link>
                    </div>
                @endcan
                @can('supplier.menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('suppliers')" :active="request()->routeIs('suppliers')" wire:navigate>
                            {{ __('Suppliers') }}
                        </x-nav-link>
                    </div>
                @endcan
                @can('item.menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('items')" :active="request()->routeIs('items')" wire:navigate>
                            {{ __('Items') }}
                        </x-nav-link>
                    </div>
                @endcan
                @can('job.menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('jobs', 'register')" :active="request()->routeIs('jobs')" wire:navigate>
                            {{ __('Jobs') }}
                        </x-nav-link>
                    </div>
                @endcan
                @can('sale.menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('sales', 'register')" :active="request()->routeIs('sales')" wire:navigate>
                            {{ __('Sales') }}
                        </x-nav-link>
                    </div>
                @endcan
                @can('receiving.menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('receivings', 'register')" :active="request()->routeIs('receivings')" wire:navigate>
                            {{ __('Receivings') }}
                        </x-nav-link>
                    </div>
                @endcan
                @can('report.menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('reports')" :active="request()->routeIs('reports')" wire:navigate>
                            {{ __('Reports') }}
                        </x-nav-link>
                    </div>
                @endcan

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @can('user.menu')
                            <x-dropdown-link :href="route('users')" wire:navigate>
                                {{ __('Users') }}
                            </x-dropdown-link>
                        @endcan
                        @can('employee.menu')
                            <x-dropdown-link :href="route('employees')" wire:navigate>
                                {{ __('Employees') }}
                            </x-dropdown-link>
                        @endcan
                        @can('role.menu')
                            <x-dropdown-link :href="route('roles')" wire:navigate>
                                {{ __('Roles') }}
                            </x-dropdown-link>
                        @endcan
                        @can('expense.menu')
                            <x-dropdown-link :href="route('expenses')" wire:navigate>
                                {{ __('Expenses') }}
                            </x-dropdown-link>
                        @endcan
                        @can('setting.menu')
                            <x-dropdown-link :href="route('settings')" wire:navigate>
                                {{ __('Settings') }}
                            </x-dropdown-link>
                        @endcan
                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @can('customer.menu')
                <x-responsive-nav-link :href="route('customers')" :active="request()->routeIs('customers')" wire:navigate>
                    {{ __('Customers') }}
                </x-responsive-nav-link>
            @endcan
            @can('supplier.menu')
                <x-responsive-nav-link :href="route('suppliers')" :active="request()->routeIs('suppliers')" wire:navigate>
                    {{ __('Suppliers') }}
                </x-responsive-nav-link>
            @endcan
            @can('item.menu')
                <x-responsive-nav-link :href="route('items')" :active="request()->routeIs('items')" wire:navigate>
                    {{ __('Items') }}
                </x-responsive-nav-link>
            @endcan
            @can('job.menu')
                <x-responsive-nav-link :href="route('jobs', 'register')" :active="request()->routeIs('jobs')" wire:navigate>
                    {{ __('Jobs') }}
                </x-responsive-nav-link>
            @endcan
            @can('sale.menu')
                <x-responsive-nav-link :href="route('sales', 'register')" :active="request()->routeIs('sales')" wire:navigate>
                    {{ __('Sales') }}
                </x-responsive-nav-link>
            @endcan
            @can('receiving.menu')
                <x-responsive-nav-link :href="route('receivings', 'register')" :active="request()->routeIs('receivings')" wire:navigate>
                    {{ __('Receivings') }}
                </x-responsive-nav-link>
            @endcan
            @can('report.menu')
                <x-responsive-nav-link :href="route('reports')" :active="request()->routeIs('reports')" wire:navigate>
                    {{ __('Reports') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                    x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @can('user.menu')
                    <x-responsive-nav-link :href="route('users')" wire:navigate>
                        {{ __('Users') }}
                    </x-responsive-nav-link>
                @endcan
                @can('employee.menu')
                    <x-responsive-nav-link :href="route('employees')" wire:navigate>
                        {{ __('Employees') }}
                    </x-responsive-nav-link>
                @endcan
                @can('role.menu')
                    <x-responsive-nav-link :href="route('roles')" wire:navigate>
                        {{ __('Roles') }}
                    </x-responsive-nav-link>
                @endcan
                @can('expense.menu')
                    <x-responsive-nav-link :href="route('expenses')" wire:navigate>
                        {{ __('Expenses') }}
                    </x-responsive-nav-link>
                @endcan
                @can('setting.menu')
                    <x-responsive-nav-link :href="route('settings')" wire:navigate>
                        {{ __('Settings') }}
                    </x-responsive-nav-link>
                @endcan
                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
