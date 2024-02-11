<?php

use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Delete the customer.
     */
    public function deleteJob(Job $id): void
    {
        $job = Customer::find($id);
        $job->delete();
        // $this->emit('');
        // $this->close();
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Jobs') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Jobs.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        Job table
    </div>
</section>