<div>
    <fieldset class="border-2 border-double border-gray-200 pb-3 px-4 rounded-md">
        <legend class="px-2">{{ __('Summary') }}</legend>
        <ul class="list-none">
            <li>{{ __('Qty') }} <span class="float-right">{{ $count }}</span></li>
            <li class="text-2xl">{{ __('Total') }} <span class="float-right">@currency($total)</span>
            </li>
        </ul>
    </fieldset>
</div>
