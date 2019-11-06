@extends('layouts.app')
@section('title') Courier
@endsection
@push('styles')
{{--  <link href="{{ asset('css/invoice.css') }}" rel="stylesheet"> --}}

<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(n + 2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.item input {
        padding-left: 5px;
    }

    .invoice-box table tr.item td:first-child input {
        margin-left: -5px;
        width: 100%;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .invoice-box input[type="number"] {
        width: 60px;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
            sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

    .ribbon {
        margin: -27px;
        position: absolute !important;
        top: -5px;
        left: -5px;
        overflow: hidden;
        width: 96px;
        height: 94px;
        border-bottom-right-radius: 92px;
    }

    .ribbon .ribbon-draft {
        background: #94a5a6;
        border-color: #788e8f;
    }

    .ribbon .ribbon-inner {
        text-align: center;
        color: #FFF;
        top: 24px;
        left: -31px;
        width: 135px;
        padding: 3px;
        position: relative;
        transform: rotate(-45deg);
    }

    .ribbon .ribbon-inner:before {
        left: 0;
        border-left: 2px solid transparent;
    }

    .ribbon .ribbon-inner:after,
    .ribbon .ribbon-inner:before {
        content: "";
        border-top: 5px solid transparent;
        border-left: 5px solid;
        border-left-color: inherit;
        border-right: 5px solid transparent;
        border-bottom: 5px solid;
        border-bottom-color: inherit;
        position: absolute;
        top: 20px;
        transform: rotate(-45deg);
    }

    .ribbon .ribbon-inner:after {
        right: -4px;
        top: 22px;
        border-bottom: 3px solid transparent;
    }

    .ribbon .ribbon-inner:after,
    .ribbon .ribbon-inner:before {
        content: "";
        border-top: 5px solid transparent;
        border-left: 5px solid;
        border-left-color: inherit;
        border-right: 5px solid transparent;
        border-bottom: 5px solid;
        border-bottom-color: inherit;
        position: absolute;
        top: 20px;
        transform: rotate(-45deg);
    }
</style>

@endpush

@section('content')
{{--  @foreach ($datas as $data)  --}}
<div>
    <div class="invoice-box" v-loading="loading">
        <div class="container">
            {{--  <div class="ribbon">
                <div class="ribbon-inner ribbon-draft">Draft</div>
            </div>  --}}
            <h2 style="text-align: center"><strong>Invoice</strong></h2>
            <table cellpadding="0" cellspacing="0" class="table table-hover">
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ $logo }}" style="width:100%; max-width:200px;">
                                </td>
                                <td>
                                    Invoice No: {{ $data['invoice_no'] }} <br>
                                    Invoice Date: {{ $data['invoice_date'] }} <br>
                                    Due Date: {{ $data['due_date'] }} <br>
                                    Order Date : {{ $data['created_at'] }}<br>
                                    Shipment Date : {{ $data['pickup_date'] }}
                                    <br>
                                    Delivery Method : {{ $data['delivery_method'] }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td style="float: left">

                                    {{ $data['clients']['name'] }} <br>
                                    {{ $data['clients']['address'] }}<br>
                                    {{ $data['clients']['email'] }}<br>
                                    {{ $data['clients']['phone'] }}
                                </td>
                                <td style="float: right">
                                    <h3>{{ env('APP_NAME') }}</h3> <br>
                                    {{-- <pre> --}}
                                    {{ env('APP_URL') }} <br>
                                    Nairobi, Kenya <br>
                                    020-900-939-333 <br>
                                    support@mft.com
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">Item & Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amout</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $item)
                    <tr class="item">
                        <td style="text-align: left;">{{ $key + 1 }}</td>
                        <td style="text-align: left;">{{ $item['product_name'] }} <br>
                            {{-- <small>{{ $item['description'] }}</small> --}}
                        </td>
                        <td style="text-align: left;">
                            {{ $item['order_qty'] }}
                        </td>
                        <td style="text-align: left;">
                            {{ $data['amount'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td></td>
                    <td></td>
                    <td style="text-align: left;"><b>Total</b></td>
                    <td style="text-align: left;"><b>{{ $data['amount'] }}</b></td>
                </tfoot>
            </table>
            <small>{{ $data['instructions'] }}</small>

        </div>
    </div>
</div>
{{--  @endforeach  --}}
@endsection
