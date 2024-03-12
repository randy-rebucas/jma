@props([
    'index' => 0,
    'header' => '',
    'open' => false,
])

<div x-data="{ selected: 1 }" class="flex flex-col">
    <div class="flex flex-col border rounded shadow mb-2">

        <div @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null"
            class="p-4 cursor-pointer">
            {{ $header }}</div>
        <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container{{ $index }}"
        x-bind:style="selected == {{ $index }} ? 'max-height: ' + $refs.container{{ $index }}.scrollHeight + 'px' : ''">
            {{ $slot }}</div>
    </div>
</div>
