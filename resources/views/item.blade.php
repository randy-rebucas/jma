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
    <h3>Items</h3>
    <table class="sales">
        <thead>
            <tr>
                <th class="left">Name </th>
                <th class="center">Re-Order Level</th>
                <th class="center">Quantity</th>
                <th class="left">Part Number</th>
                <th class="right">Selling Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="left">{{ $item->name }}</td>
                    <td class="center">{{ $item->reorder_level }}</td>
                    <td class="center">{{ $item->receiving_quantity }}</td>
                    <td class="left">{{ $item->part_number }}</td>
                    <td class="right">
                        {{ number_format($item->selling_price, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>
