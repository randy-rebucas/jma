@props(['item'])

<td {{ $attributes->merge(['class' => ' px-6 py-4 whitespace-nowrap text-sm leading-5 text-cool-gray-500']) }}>
    {{ $item }}
</td>
