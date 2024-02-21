<?php

use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Delete the sale.
     */
    public function delete(Sale $id): void
    {
        $sale = Sale::find($id);
        $sale->delete();
        // $this->emit('');
        // $this->close();
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Detailed Reports') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Select a date start and end to view detailed report.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        Detailed report
    </div>
</section>