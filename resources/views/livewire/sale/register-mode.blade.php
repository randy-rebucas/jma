<div class="flex-1">
    <div class="flex items-center">
        <x-input-label for="mode" :value="__('Register Mode')" class="block flex-initial"/>
        <x-select wire:model="mode" wire:change="changeRegisterMode($event.target.value)" id="mode" name="mode"
            :options="$modes" class="mx-6" />
    </div>
</div>
