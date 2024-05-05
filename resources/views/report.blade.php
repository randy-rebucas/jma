<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
        * {
            font-family: Menlo, Monaco, Consolas, Courier New, monospace;
        }

        html {
            margin: 1rem
        }

        table {
            width: 100%;
        }

        table thead tr th {
            padding: 2px 5px;
            font-size: 18px;
            background-color: rgb(115, 115, 245);
            color: #fff;
        }

        table tbody {
            border-bottom: 1px solid;
        }

        table tbody tr td {
            font-size: 18px;
            padding: 2px 5px;
        }

        table tbody tr td.grand-total {
            font-size: 22px;
            font-weight: 300;
        }

        table tfoot tr td,
        table tfoot tr th {
            font-size: 18px;
            padding: 2px 5px;
        }

        table thead tr th.left,
        table tbody tr td.left {
            text-align: left;
        }

        table thead tr th.center,
        table tbody tr td.center {
            text-align: center;
        }

        table thead tr th.right,
        table tbody tr td.right,
        table tfoot tr th.right,
        table tfoot tr td.right {
            text-align: right;
        }

        h1 {
            font-size: 22px;
        }

        h3 {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <h1>As of {{ $asOf }}</h1>
    <h3>Sales</h3>
    <table class="sales">
        <thead>
            <tr>
                <th class="left">Customer </th>
                <th class="center">Date</th>
                <th class="center">Payment Type</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td class="left">{{ $sale->customer->full_name }}</td>
                    <td class="center">@datetime($sale->created_at)</td>
                    <td class="center">{{ $sale->sale_payment->payment_type }}</td>
                    <td class="right">
                        {{ number_format($sale->sale_payment->payment_amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="right">Total Sales: </th>
                <td class="right">
                    {{ number_format($total_sales, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <h3>Jobs</h3>
    <table class="jobs">
        <thead>
            <tr>
                <th class="left">Customer </th>
                <th class="center">Date</th>
                <th class="center">Payment Type</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td class="left">{{ $job->customer->full_name }}</td>
                    <td class="center">@datetime($job->created_at)</td>
                    <td class="center">{{ $job->job_payment->payment_type }}</td>
                    <td class="right">
                        {{ number_format($job->total_amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="right">Total Jobs: </th>
                <td class="right">
                    {{ number_format($total_jobs, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <h3>Expenses</h3>
    <table class="expenses">
        <thead>
            <tr>
                <th class="left">Name </th>
                <th class="center">Date</th>
                <th class="left">Description</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td class="left">{{ $expense->name }}</td>
                    <td class="center">@datetime($expense->created_at)</td>
                    <td class="left">{{ $expense->description }}</td>
                    <td class="right">
                        {{ number_format($expense->amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="right">Total Expenses: </th>
                <td class="right">
                    {{ number_format($total_expenses, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>
    <br/>

    <table>
        <tbody>
            <tr>
                <th class="right">Grand Total:</th>
                <td class="right grand-total">{{ number_format($grand_total, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
