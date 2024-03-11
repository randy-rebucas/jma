<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Job;
use App\Models\JobItem;
use App\Models\JobScopeOfWorks;
use App\Models\Car;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;


class JobOrderInvoice extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        $job = Job::findOrFail($id);

        $client = new Party([
            'name' =>  config('settings.business_name'),
            'address' => config('settings.business_address'),
            'phone' =>  config('settings.business_contact'),
            // 'custom_fields' => [
            //     'note' => 'IDDQD',
            //     'business id' => '365#GG',
            // ],
        ]);

        $customer_address = CustomerAddress::with('address')->where('customer_id', $job->customer->id)->first();

        $customer = new Party([
            'name' => $job->customer->full_name,
            'address' => $customer_address->address->line_1 . ',' . $customer_address->address->district . ', ' . $customer_address->address->city->name,
            // 'code' => '#22663214',
            'custom_fields' => [
                'order number' => '> 654321 <', // job order number
            ],
        ]);

        $job_items = JobItem::with('item')->where('job_id', $job->id)->get();
        foreach($job_items as $job_item) {
            $items []= (new InvoiceItem())
            ->title($job_item->item->name)
            ->units('pcs')
            ->pricePerUnit($job_item->unit_price)
            ->subTotalPrice($job_item->sub_total)
            ->quantity($job_item->quantity);
        }

        $job_scopes = JobScopeOfWorks::where('job_id', $job->id)->get();
        foreach($job_scopes as $job_scope) {
            $scopes []= (new InvoiceItem())
            ->title($job_scope->name)
            ->pricePerUnit($job_scope->unit_price)
            ->subTotalPrice($job_scope->sub_total)
            ->quantity($job_scope->quantity);
        }

        $car = Car::findOrFail($job->car_id);

        $notes = [
            '....Nothing follows....'
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('receipt')->template('job')
            ->series('JMA')
            ->status($job->paid ? __('invoices::invoice.paid') : __('invoices::invoice.due'))
            ->sequence($job->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('₱')
            ->currencyCode('PHP')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            ->setCustomData($scopes)
            ->totalAmount($job->total_amount)
            ->notes($notes)
            ->logo(public_path('storage/' . config('settings.business_logo')))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
