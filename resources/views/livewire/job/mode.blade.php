<div class="flex">
    <div class="flex-1">
        <div class="flex items-center">
            <x-input-label for="mode" :value="__('Register Mode')" class="block flex-initial" />
            <x-select wire:model="mode" wire:change="changeMode($event.target.value)" id="mode" name="mode"
                :options="$modes" class="mx-6" />
        </div>
    </div>
    <div class="flex">
        <x-secondary-button class="ms-3 mx-3" wire:click="$dispatch('openModal', { component: 'job.scope-form' })">
            {{ __('Scope of work') }}
        </x-secondary-button>
        <x-secondary-button class="ms-3 mx-3" wire:click="onClickLists">
            {{ __('View Jobs') }}
        </x-secondary-button>
    </div>
</div>
