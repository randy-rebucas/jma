<?php

use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Delete the item.
     */
    public function deleteItem(Item $id): void
    {
        $item = Item::find($id);
        $item->delete();
        // $this->emit('');
        // $this->close();
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Items') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Items.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        Item table
    </div>
</section>