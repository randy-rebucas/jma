<?php

use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Delete the customer.
     */
    public function deleteCustomer(Customer $id): void
    {
        $customer = Customer::find($id);
        $customer->delete();
        // $this->emit('');
        // $this->close();
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Customers') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Customers.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        <div class="not-prose relative bg-slate-50 rounded-xl overflow-hidden dark:bg-slate-800/25">
            <table class="table-auto w-full border-collapse table-auto w-full">
                <thead>
                    <tr>
                        <th class="text-start">Song</th>
                        <th class="text-start">Artist</th>
                        <th class="text-start">Year</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                    <tr>
                        <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                        <td>Malcolm Lockyer</td>
                        <td>1961</td>
                    </tr>
                    <tr>
                        <td>Witchy Woman</td>
                        <td>The Eagles</td>
                        <td>1972</td>
                    </tr>
                    <tr>
                        <td>Shining Star</td>
                        <td>Earth, Wind, and Fire</td>
                        <td>1975</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>