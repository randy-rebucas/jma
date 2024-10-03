<?php

namespace App\Http\Controllers;

use App\Classes\ScopeItem;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Job;
use App\Models\JobItem;
use App\Models\JobScopeOfWorks;
use App\Models\Car;
use App\Services\JmaInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'name' => config('settings.business_name'),
            'address' => config('settings.business_address'),
            'phone' => config('settings.business_contact')
        ]);

        $customer_address = CustomerAddress::with('address')->where('customer_id', $job->customer->id)->first();

        $customer = new Party([
            'name' => $job->customer->full_name,
            'address' => $customer_address->address->line_1 . ',' . $customer_address->address->district . ', ' . $customer_address->address->city->name,
        ]);


        $job_items = JobItem::with('item')->where('job_id', $job->id)->get();
        if($job_items){
            foreach ($job_items as $job_item) {
                $items[] = (new InvoiceItem())
                    ->title($job_item->item->name)
                    ->pricePerUnit($job_item->unit_price)
                    ->subTotalPrice($job_item->sub_total)
                    ->quantity($job_item->quantity);
            }
        } else {
            $items[] = (new InvoiceItem())
                    ->title('No Item')
                    ->pricePerUnit(0)
                    ->subTotalPrice(0)
                    ->quantity(0);
        }

        $job_scopes = JobScopeOfWorks::where('job_id', $job->id)->get();
        foreach ($job_scopes as $job_scope) {
            $scopes[] = (new ScopeItem())
                ->title($job_scope->name)
                ->pricePerUnit($job_scope->unit_price)
                ->subTotalPrice($job_scope->sub_total)
                ->quantity($job_scope->quantity);
        }

        $car_details = Car::findOrFail($job->car_id);
        $car = new Party([
            'brand' => $car_details->brand,
            'plate_number' => $car_details->plate_number,
            'model' => $car_details->model,
            'color' => $car_details->color,
            'odo_km' => $car_details->odo_km,
            'engine_number' => $car_details->engine_number,
            'chassis_number' => $car_details->chassis_number,
            'year' => $car_details->year,
        ]);

        $notes = [
            '....Nothing follows....'
        ];
        $notes = implode("<br>", $notes);

        $invoice = JmaInvoice::make('receipt')->template('job')
            ->series('JMA')
            ->status($job->paid ? __('invoices::invoice.paid') : __('invoices::invoice.due'))
            ->sequence($job->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)

            ->type('Job ' . $job->job_type)
            ->change($job->job_payment->change)
            ->tenderedAmount($job->job_payment->tendered_amount)
            ->car($car)
            ->addScopes($scopes)

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
            ->setCustomData(Auth::user()->name)
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
