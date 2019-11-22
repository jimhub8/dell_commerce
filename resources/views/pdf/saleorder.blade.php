<!doctype html>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 20px;
        }

        body {
            margin: 0px;
            background: #f8fafc;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .invoice table {
            margin: 15px;
        }

        .invoice h3 {
            margin-left: 15px;
        }


        .information .logo {
            margin: 5px;
        }

        .information table {
            padding: 10px;
        }

        .page-break {
            page-break-after: always;
        }

        .table thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        .table tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        th {
            text-align: inherit;
        }
    </style>

</head>

<body>
    <div class="information">
        <table width="100%">
            <tr>
                <td align="left">
                    <img src="{{ $logo }}" alt="MFT" style="width:200px;">
                </td>
                <td align="right" style="width: 40%;">
                    <strong>SALES ORDER</strong>
                    {{-- <h4>Sales Order#: {{ $orders->order_no }}<br></h4> --}}
                    {{-- <pre> --}}
                    <br>
                    <br>
                    Name: {{ $orders['name'] }}
                    <br>
                    Address:{{ $orders['address'] }}
                    <br>
                    Status: {{ $orders['status'] }}
                    <br>
                    {{-- Date: {{ $orders['created_at']->date->format('l jS \\of F Y h:i:s A') }} --}}
                    {{ date('D d M Y', strtotime($orders['created_at'])) }}
                    <br>
                    Payment id: {{ $orders['payment_id'] }}
                    {{-- </pre> --}}
                </td>
            </tr>

        </table>
    </div>
    <hr style="color: rgba(0,0,0,.12)" />
    <div class="information">
        <table width="100%">
            <tr>
                <td align="left" style="width: 40%;">
                    <h3>Bill To</h3>
                    <b>Name</b>: {{ $orders->user->name }} <br>
                    <b>Address</b>: {{ $orders->user->address }}<br>
                    <b>Email</b>: {{ $orders->user->email }}<br>
                    <b>Phone</b>: {{ $orders->user->phone }}
                </td>
                <td align="right" style="width: 40%;">
                    <h3>Ship To</h3>
                    <b>Name</b>: {{ $orders->user->name }} <br>
                    <b>Address</b>: {{ $orders->user->address }}<br>
                    <b>Email</b>: {{ $orders->user->email }}<br>
                    <b>Phone</b>: {{ $orders->user->phone }}
                </td>
            </tr>

        </table>
    </div>

    <br />
    <div class="invoice">
        <table width="100%" class="table table-striped">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['product']->product_name }}</td>
                    <td>{!! str_limit($item['product']->description, $limit = 100, $end = '...') !!}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td align="left">{{ $item['product']->price }}</td>
                </tr>
                @endforeach --}}

            </tbody>

            <tfoot>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td align="left">Total</td>
                    <td align="left" class="gray">KSH {{ $orders->amount }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} {{ env('APP_NAME') }} - All rights reserved.
                </td>
            </tr>

        </table>
    </div>
    </div>
</body>

</html>
