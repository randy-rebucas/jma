@props(['formAction' => false])

<div>
    @if ($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
    @endif
    <div class="bg-white border-b border-gray-150 dark:bg-gray-800 p-4 sm:px-6 sm:py-4 ">
        @if (isset($title))
            <h3 class="dark:text-gray-200 font-medium leading-6 text-gray-900 text-lg">
                {{ $title }}
            </h3>
        @endif
    </div>
    <div class="bg-white dark:bg-gray-700 px-4 sm:p-6">
        <div class="space-y-6">
            {{ $slot }}
        </div>
    </div>

    <div class="dark:bg-gray-800 flex items-center justify-end pr-5 py-3">
        {{ $buttons }}
    </div>
    @if ($formAction)
        </form>
    @endif
</div>
