<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Job;
use App\Models\JobPayment;
use Illuminate\Support\Str;

class JobPaymentObserver
{
    /**
     * Handle the JobPayment "created" event.
     */
    public function created(JobPayment $jobPayment): void
    {
        $job = Job::find($jobPayment->job->id);

        Inventory::create([
            "transaction_code" => Str::uuid(),
            "transaction_type" => $job->job_type,
            "user_id" => $job->user->id,
            "transaction_paid_amount" => $job->job_payment->payment_amount,
            "transaction_payment_method" => $job->job_payment->payment_type,
            "transaction_total_amount" => $job->job_item->total_amount,
            "items" => $job->job_item->items,
            "serial" => $job->serial
        ]);
    }

    /**
     * Handle the JobPayment "updated" event.
     */
    public function updated(JobPayment $jobPayment): void
    {
        //
    }

    /**
     * Handle the JobPayment "deleted" event.
     */
    public function deleted(JobPayment $jobPayment): void
    {
        //
    }

    /**
     * Handle the JobPayment "restored" event.
     */
    public function restored(JobPayment $jobPayment): void
    {
        //
    }

    /**
     * Handle the JobPayment "force deleted" event.
     */
    public function forceDeleted(JobPayment $jobPayment): void
    {
        //
    }
}
