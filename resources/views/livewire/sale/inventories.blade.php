<x-modal>
    <x-slot name="title">
        {{ __('Transaction info') }}
    </x-slot>

    <h3 class="flex justify-between">Trxn Code: <span>{{ $inventory->transaction_code }}</span></h3>
    <p class="flex justify-between">Trxn Type: <span>{{ $inventory->transaction_type }}</span></p>
    <p class="flex justify-between">Trxn Total Amount: <span>{{ $inventory->transaction_total_amount }}</span></p>
    <p class="flex justify-between">Trxn Payment Method: <span>{{ $inventory->transaction_payment_method }}</span></p>
    <ul class="">
        <li class="bg-gray-100 p-2">Item Purchased</li>
        @foreach ($inventory->items as $key => $item)
            <li class="flex justify-between px-2 py-2">{{ $item['name'] . ' : ' . $item['qty'] }} <span>{{ $item['price'] }}</span></li>
        @endforeach
    </ul>
    <x-slot name="buttons">
        <div class="flex items-center justify-end">
            <x-secondary-button class="ms-3" wire:click="$dispatch('closeModal')">
                {{ __('Close') }}
            </x-secondary-button>
        </div>
    </x-slot>
</x-modal>
