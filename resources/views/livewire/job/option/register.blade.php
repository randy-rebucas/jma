<section>
    <div class="flex flex-row justify-between">
        <div class="w-3/4">
            <div class="bg-slate-200 justify-between p-2 dark:bg-gray-800">
                <livewire:pos.register-mode />
            </div>
            @isset($mode)
                <div class="bg-slate-100 justify-between p-2 dark:bg-gray-700">
                    <livewire:pos.scan-item />
                </div>
                <div class="h-auto">
                    <livewire:pos.line-items />
                </div>
                <div class="bg-slate-100 flex justify-between p-2 dark:bg-gray-700">
                    <livewire:job.detail-form />
                </div>
                <div class="h-auto">
                    <livewire:job.details :mode="$mode" />
                </div>
            @endisset
            @empty($mode)
                <livewire:pos.empty-line-items />
            @endempty
        </div>

        <div class="bg-slate-100 dark:bg-gray-700 dark:text-gray-200 m-1 p-2 w-1/4">
            <livewire:pos.scan-customer />
            <livewire:pos.total />
            <livewire:pos.payment />
        </div>
    </div>
</section>
