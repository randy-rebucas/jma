<?php
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Job;

new class extends Component {
    use WithPagination;

    public $search;

    #[On('job-created')]
    #[On('job-updated')]
    #[On('job-deleted')]
    public function with(): array
    {
        return [
            'jobs' => Job::search('job_number', $this->search)->paginate(10),
        ];
    }

    public function delete($id): void
    {
        $job = Job::find($id);
        $job->delete();

        $this->dispatch('job-deleted');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Jobs') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Jobs.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">

        <div class="flex justify-between">
            <x-text-input wire:model.live="search" class="py-2" type="search" placeholder="Search Jobs..." />
            <x-secondary-button class="ms-3 py-3" wire:click="$dispatch('openModal', { component: 'job.create-job' })">
                {{ __('Create Job') }}
            </x-secondary-button>
        </div>

        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
            <x-table for="jobs">
                <x-table.thead>
                    <x-table.row>
                        <x-table.thead-cell title="Job Number" class="text-left" />
                        <x-table.thead-cell title="Type" class="text-left" />
                        <x-table.thead-cell title="Customer" class="text-left" />
                        <x-table.thead-cell title="Actions" class="text-right" />
                    </x-table.row>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($jobs as $job)
                        <x-table.row class="bg-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$job->job_number" />
                            <x-table.tbody-cell :item="$job->type" />
                            <x-table.tbody-cell :item="$job->customer->first_name . ', ' . $job->customer->last_name" />
                            <x-table.tbody-cell :item="$job->id" class="text-right" :action="true">
                                <button type="button" class="btn btn-info m-1 font-medium underline"
                                    wire:click="$dispatch('openModal', {component: 'job.edit-job', arguments: {job: {{ $job }} }})">Edit</button>
                                <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                    wire:click="delete({{ $job->id }})"
                                    wire:confirm="Are you sure you want to delete this job?">Delete</button>
                            </x-table.tbody-cell>
                        </x-table.row>
                    @empty
                        <x-table.row class="bg-white">
                            <x-table.tbody-cell colspan="6" :item="'No job found!!'" />
                        </x-table.row>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </div>
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</section>
