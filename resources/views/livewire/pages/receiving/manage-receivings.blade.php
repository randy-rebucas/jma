<?php

use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Delete the sale.
     */
    public function delete(Receiving $id): void
    {
        $sale = Receiving::find($id);
        $sale->delete();
        // $this->emit('');
        // $this->close();
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Receivings') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Receivings.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        Receiving table
    </div>
</section>