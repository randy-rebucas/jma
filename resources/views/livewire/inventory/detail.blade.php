<x-modal>
    <x-slot name="title">
        {{ __('Transaction info') }}
    </x-slot>

    <h3 class="flex justify-between">Trxn Code: <span>{{ $inventory->transaction_code }}</span></h3>
    <p class="flex justify-between uppercase">Trxn Type: <span>{{ $inventory->transaction_type }}</span></p>
    <p class="flex justify-between">Trxn Total Amount: <span>{{ number_format($inventory->transaction_total_amount, 2) }}</span></p>
    <p class="flex justify-between uppercase">Trxn Payment Method: <span>{{ $inventory->transaction_payment_method }}</span></p>
    <x-slot name="buttons">
        <div class="flex items-center justify-end">
            <x-secondary-button class="ms-3" wire:click="$dispatch('closeModal')">
                {{ __('Close') }}
            </x-secondary-button>
        </div>
    </x-slot>
</x-modal>