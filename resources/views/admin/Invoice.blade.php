<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
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

        .information {
            background-color: #60A7A6;
            color: #FFF;
        }

        .information .logo {
            margin: 5px;
        }

        .information table {
            padding: 10px;
        }
    </style>

</head>

<body>

    <div class="information">
        <table width="100%">
            <tr>
                <td align="left" style="width: 40%;">
                    <h3>John Doe</h3>
                    <pre>
                        Street 15
                        123456 City
                        United Kingdom
                        <br /><br />
                        Date: 2018-01-01
                        Identifier: #uniquehash
                        Status: Paid
                        </pre>


                </td>
                <td align="center">
                    <img src="/path/to/logo.png" alt="Logo" width="64" class="logo" />
                </td>
                <td align="right" style="width: 40%;">

                    <h3>CompanyName</h3>
                    <pre>
                    https://company.com

                    Street 26
                    123456 City
                    United Kingdom
                </pre>
                </td>
            </tr>

        </table>
    </div>


    <br/>

    <div class="invoice">
        <h3>Invoice specification #123</h3>
        <table width="100%">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>List Price</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders->cart as $order)
                <tr>
                    <td>{{ $order->item->name }}</td>
                    <td>{{ $order->item->list_price }}</td>
                    <td align="left">{{ $order->item->price }}</td>
                    <td>{{ $order->item->description }}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="1"></td>
                    <td align="left">Total</td>
                    <td align="left" class="gray">€15,-</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    Company Slogan
                </td>
            </tr>

        </table>
    </div>
</body>

</html>