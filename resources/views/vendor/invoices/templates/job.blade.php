<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $invoice->name }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: .5rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4,
        .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h4,
        .h4 {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 0.8rem;
            background-color: #6B7280;
            color: #fff;
            padding: .2rem
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.45rem;
            vertical-align: top;
        }

        .table.table-items td {
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .mt-5 {
            margin-top: 1rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        .text-sm {
            font-size: .7rem;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        th,
        tr,
        td,
        p,
        div {
            line-height: 1.1;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }

        .cool-gray {
            color: #6B7280;
        }

        .signature-line {
            border-bottom: 1px solid;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    @if ($invoice->logo)
        <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
    @endif

    <table class="table mt-5">
        <tbody>
            <tr>
                <td class="border-0 pl-0" width="70%">
                    <h4 class="text-uppercase">
                        <strong>{{ $invoice->type }}</strong>
                    </h4>
                    @if ($invoice->status)
                        <h4 class="text-uppercase cool-gray text-sm">
                            <strong>{{ $invoice->status }}</strong>
                        </h4>
                    @endif
                </td>
                <td class="border-0 pl-0">
                    <p>{{ __('invoices::invoice.serial') }} <strong>{{ $invoice->getSerialNumber() }}</strong></p>
                    <p>{{ __('invoices::invoice.date') }}: <strong>{{ $invoice->getDate() }}</strong></p>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Buyer | Car --}}
    <table class="table">
        <tbody>
            <tr>
                <th>{{ __('invoices::invoice.buyer') }}: </th>
                <td>
                    {{ $invoice->buyer->name }}
                </td>
            </tr>
            <tr>
                <th>{{ __('invoices::invoice.address') }} </th>
                <td>{{ $invoice->buyer->address }}</td>
            </tr>
            <tr>
                <th>{{ __('invoices::invoice.phone') }}</th>
                <td>
                    {{ $invoice->buyer->phone }}
                </td>
            </tr>
            <tr>
                <th>Brand:</th>
                <td>{{ $invoice->car->brand }}</td>
                <th>Odo km:</th>
                <td>{{ $invoice->car->odo_km }}</td>
            </tr>
            <tr>
                <th>Model:</th>
                <td>{{ $invoice->car->model }}</td>
                <th>Engine #:</th>
                <td>{{ $invoice->car->engine_number }}</td>
            </tr>
            <tr>
                <th>Plate #:</th>
                <td>{{ $invoice->car->plate_number }}</td>
                <th>Chasis #:</th>
                <td>{{ $invoice->car->chassis_number }}</td>
            </tr>
            <tr>
                <th>Color:</th>
                <td>{{ $invoice->car->color }}</td>
                <th>Year:</th>
                <td>{{ $invoice->car->year }}</td>
            </tr>
        </tbody>
    </table>

    <h2>{{ __('invoices::invoice.scope_of_works') }}</h2>
    <table class="table table-items">
        <thead>
            <tr>
                <th scope="col" class="border-0 pl-0">{{ __('invoices::invoice.title') }}</th>
                <th scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                <th scope="col" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                <th scope="col" class="text-right border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->scopes as $item)
                <tr>
                    <td class="pl-0">
                        {{ $item->title }}
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Table --}}
    <h2>{{ __('invoices::invoice.parts') }}</h2>
    <table class="table table-items">
        <thead>
            <tr>
                <th scope="col" class="border-0 pl-0">{{ __('invoices::invoice.title') }}</th>
                @if ($invoice->hasItemUnits)
                    <th scope="col" class="text-center border-0">{{ __('invoices::invoice.units') }}</th>
                @endif
                <th scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                <th scope="col" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                @if ($invoice->hasItemDiscount)
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</th>
                @endif
                @if ($invoice->hasItemTax)
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</th>
                @endif
                <th scope="col" class="text-right border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</th>
            </tr>
        </thead>
        <tbody>
            {{-- Items --}}
            @foreach ($invoice->items as $item)
                <tr>
                    <td class="pl-0">
                        {{ $item->title }}

                        @if ($item->description)
                            <p class="cool-gray">{{ $item->description }}</p>
                        @endif
                    </td>
                    @if ($invoice->hasItemUnits)
                        <td class="text-center">{{ $item->units }}</td>
                    @endif
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    @if ($invoice->hasItemDiscount)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->discount) }}
                        </td>
                    @endif
                    @if ($invoice->hasItemTax)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->tax) }}
                        </td>
                    @endif

                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
            @endforeach
            {{-- Summary --}}
            @if ($invoice->hasItemOrInvoiceDiscount())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.total_discount') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->total_discount) }}
                    </td>
                </tr>
            @endif
            @if ($invoice->taxable_amount)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.taxable_amount') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                    </td>
                </tr>
            @endif
            @if ($invoice->tax_rate)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.tax_rate') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->tax_rate }}%
                    </td>
                </tr>
            @endif
            @if ($invoice->hasItemOrInvoiceTax())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->total_taxes) }}
                    </td>
                </tr>
            @endif
            @if ($invoice->shipping_amount)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.shipping') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->shipping_amount) }}
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="{{ $invoice->table_columns - 2 }}" class="border"></td>
                <td class="text-right pl-0">{{ __('invoices::invoice.total_amount') }}</td>
                <td class="text-right pr-0 total-amount">
                    {{ $invoice->formatCurrency($invoice->total_amount) }}
                </td>
            </tr>
        </tbody>
    </table>

    @if ($invoice->notes)
        <p>
            {{ __('invoices::invoice.notes') }}: {!! $invoice->notes !!}
        </p>
    @endif

    <p>
        {{ __('invoices::invoice.amount_in_words') }}: {{ $invoice->getTotalAmountInWords() }}
    </p>

    <p>
        {{ __('invoices::invoice.pay_until') }}: {{ $invoice->getPayUntilDate() }}
    </p>
    <br />
    <br />
    <br />
    <br />
    <table class="table">
        <tbody>
            <tr>
                <td style="width: 20%">{{ __('invoices::invoice.customer_signature') }}:</td>
                <td style="width: 30%" class="signature-line">&nbsp;</td>
                <td style="width: 25%" class="text-right">{{ __('invoices::invoice.prepared_by') }}:</td>
                <td style="width: 25%" class="text-left signature-line">{{ $invoice->getCustomData() }}</td>
            </tr>
        </tbody>
    </table>

    <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "{{ __('invoices::invoice.page') }} {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
</body>

</html>
