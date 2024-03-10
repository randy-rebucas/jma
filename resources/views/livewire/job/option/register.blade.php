<section class="">
    <div class="flex flex-row justify-between">
        <div class="w-3/4">
            <div class="bg-slate-200 justify-between p-2 dark:bg-gray-800 sm:rounded-lg shadow">
                <livewire:job.mode :mode="$mode" />
            </div>
            @if ($mode)
                <div class="bg-slate-100 justify-between p-2 dark:bg-gray-700 mt-2 sm:rounded-lg shadow">
                    <livewire:pos.scan-item />
                </div>
                <div class="h-auto">
                    <livewire:job.items />

                    <livewire:job.scope-line-items />
                </div>
            @else
                <livewire:pos.empty-line-items />
            @endif
        </div>

        <div class="bg-slate-100 dark:bg-gray-700 dark:text-gray-200 mx-2 p-2 w-1/4 sm:rounded-lg shadow">
            <livewire:pos.scan-customer :showCarLists="'true'" />
            <livewire:job.total />
            <livewire:job.payment :mode="$mode" />
        </div>
    </div>
</section>
