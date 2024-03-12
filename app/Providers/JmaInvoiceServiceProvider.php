<?php

namespace App\Providers;

use \App\Classes\Car;
use App\Services\JmaInvoice;
use Illuminate\Foundation\Application;
use LaravelDaily\Invoices\InvoiceServiceProvider as BaseServiceProvider;

class JmaInvoiceServiceProvider extends BaseServiceProvider
{

    public function register(): void
    {
        $this->registerServices();
    }

    protected function registerServices()
    {
        $this->app->singleton(JmaInvoice::class, function (Application $app) {
            return new JmaInvoice(config('invoices.car.attributes.name'));
        });
    }
}