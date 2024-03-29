<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Job;

class JobObserver
{
    /**
     * Handle the Job "created" event.
     */
    public function created(Job $job): void
    {
        //
    }

    /**
     * Handle the Job "updated" event.
     */
    public function updated(Job $job): void
    {

        if ($job->paid) {
            foreach ($job->job_items as $jobItem) {
                Item::where('id', $jobItem->item_id)->decrement('receiving_quantity', $jobItem->quantity);
            }
        }

        if (!$job->paid) {
            foreach ($job->job_items as $jobItem) {
                Item::where('id', $jobItem->item_id)->increment('receiving_quantity', $jobItem->quantity);
            }
        }
    }

    /**
     * Handle the Job "deleted" event.
     */
    public function deleted(Job $job): void
    {
        //
    }

    /**
     * Handle the Job "restored" event.
     */
    public function restored(Job $job): void
    {
        //
    }

    /**
     * Handle the Job "force deleted" event.
     */
    public function forceDeleted(Job $job): void
    {
        //
    }
}
