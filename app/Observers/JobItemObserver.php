<?php

namespace App\Observers;

use App\Enums\JobTypeEnum;
use App\Models\Item;
use App\Models\Job;
use App\Models\JobItem;

class JobItemObserver
{
    /**
     * Handle the JobItem "created" event.
     */
    public function created(JobItem $jobItem): void
    {
        $job = Job::find($jobItem->job->id);

        if ($job->paid) {
            Item::where('id', $jobItem->item_id)->decrement('receiving_quantity', $jobItem->quantity);
        }
    }

    /**
     * Handle the JobItem "updated" event.
     */
    public function updated(JobItem $jobItem): void
    {
        //
    }

    /**
     * Handle the JobItem "deleted" event.
     */
    public function deleted(JobItem $jobItem): void
    {
        //
    }

    /**
     * Handle the JobItem "restored" event.
     */
    public function restored(JobItem $jobItem): void
    {
        //
    }

    /**
     * Handle the JobItem "force deleted" event.
     */
    public function forceDeleted(JobItem $jobItem): void
    {
        //
    }
}
