<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\models\Client;
use App\models\Country;
use App\models\Logo;
use App\models\Saleorder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function invoiceDownload(Request $request)
    {
        // $order = Saleorder::userId()->find($request->order);
        // dd(json_decode($request->order));
        $data = json_decode($request->order);
        // dd($data);
        // $data = $data->order;
        $logo = new Logo;
        $products = [];
        $total = 0;
        foreach ($data->order->receiveorders as $key => $value) {
            $products[] = $value->products;
            $order_qty = $value->order_qty;
        }
        // dd($products);
        // dd($total);
        $products = $products;
        $pdf_arr = array('data' => $data, 'logo' => $logo->logo(), 'products' => $products, 'client' => $data->order->clients, 'order_qty' => $order_qty);
        // dd($pdf_arr);
        $pdf = PDF::loadView('pdf.invoiceStream', $pdf_arr);
        return $pdf->stream();
    }

    public function saleOrderDown(Request $request)
    {
        // $order = Saleorder::userId()->find($request->order);
        // dd(json_decode($request->order));
        $data = json_decode($request->order);
        // dd($data->sender_id);
        $client = Client::find($data->sender_id);
        $logo = new Logo;
        $products = [];
        $total = 0;
        foreach ($data->product as $key => $value) {
            $products[] = $value;
            $total = $total + $value->price;
        }
        // dd($data);
        // dd($total);
        $products = $products;
        // $pdf_arr = array('data' => $data, 'logo' => $logo->logo(), 'products' => $products, 'client' => $data->clients, 'total' =>$total);
        $pdf_arr = array('data' => $data, 'logo' => $logo->logo(), 'products' => $products, 'total' =>$total, 'client' =>$client);
        // dd($pdf_arr);
        $pdf = PDF::loadView('pdf.saleorder', $pdf_arr);
        return $pdf->stream();
    }

    public function lableDownload(Request $request)
    {
        // return $request->all();
        // $order = Saleorder::userId()->find($request->order);
        // dd(json_decode($request->order));
        $data = json_decode($request->inventory);
        $client = Client::find($data->client_id);
        // $date = date('Y-m-d h:i:s', strtotime($data->delivery_date));
        // $date->isoFormat('MMMM Do YYYY');
        $date = Carbon::parse($data->delivery_date)->format('D, jS F Y');
        // dd($date);
        // dd($data);
        $boxes = $data->boxes;
        $products = $data->selectedProducts;
        // $logo = new Logo;
        // $total = 0;
        // foreach ($products as $key => $value) {
        //     $total = $total + $value->price;
        // }
        // dd($total);
        $products = $products;
        $pdf_arr = array('data' => $data, 'products' => $products, 'client' => $client, 'boxes' => $boxes, 'date' => $date);
        // dd($pdf_arr);
        $pdf = PDF::loadView('pdf.Lables', $pdf_arr);
        return $pdf->stream();
    }

    public function packageDownload(Request $request)
    {
        $data = json_decode($request->inventory);
        $client = $data->client;
        $receiveorders = $data->order->receiveorders;
        $order = $data->order;
        // dd($receiveorders);
        // $date = Carbon::parse($data->delivery_date)->format('D, jS F Y');
        $pdf_arr = array('data' => $data, 'products' => $receiveorders, 'client' => $client, 'order' => $order);
        $pdf = PDF::loadView('pdf.Package', $pdf_arr);
        return $pdf->stream();
    }

    public function package_download(Request $request)
    {

        $data = json_decode($request->packages);
        // dd($data->start_date);
        $start_date = Carbon::parse($data->start_date);
        $end_date = Carbon::parse($data->end_date);
        $orders = Saleorder::with(['products', 'receiveorders', 'clients'])->whereBetween('delivery_date', [$start_date, $end_date])->where('status', 'Scheduled')->where('printed', false)->take(100);
        $update_orders = $orders;
        $orders = $orders->get();
        // dd($orders);
        $this->transform_orders($orders);
        $country_id = Auth::user()->country_id;
        $currency = Country::select('currency_code')->find($country_id);
        $currency_value = ($currency) ? $currency->currency_code : '' ;
        // dd($currency_value);
        $logo = new Logo;
        $pdf_arr = array('data' => $orders, 'logo' => $logo->logo(), 'currency' => $currency_value);
        $pdf = PDF::loadView('pdf.saleorder_mult', $pdf_arr);
        // $orders = Saleorder::with(['products', 'receiveorders', 'clients'])->whereBetween('delivery_date', [$start_date, $end_date])->where('status', 'Scheduled')->where('printed', false)->take(100);
        $update_orders->update(['printed' => true]);
        // foreach ($orders as $key => $value) {
        //     dd($value);
        // }
        // $orders->update(['printed' => true]);
        return $pdf->stream();
        // foreach ($data as  $value) {
        //     dd($value);
        // }
    }

    public function picking_list(Request $request)
    {
        // dd($request->all());
        $data = json_decode($request->packages);
        // dd($data->data);
        $logo = new Logo;
        $pdf_arr = array('data' => $data->data, 'logo' => $logo->logo());
        $pdf = PDF::loadView('pdf.Pickinglist', $pdf_arr);
        return $pdf->stream();
        // foreach ($data as  $value) {
        //     dd($value);
        // }
    }


    public function transform_orders($saleorder)
    {
        $saleorder->transform(function ($order) {
            $product_a = [];
            $order->packed = (int) $order->packed;
            $order->invoiced = (int) $order->invoiced;
            foreach ($order->receiveorders as $key => $product) {
                $product_arr['order_qty'] = $product['order_qty'];
                $product_arr['sent'] = $product['sent'];
                $product_arr['id'] = $product['id'];
                $product_arr['send_qty'] = $product['send_qty'];
                $product_arr['remaining'] = $product['remaining'];
                $product_arr['id'] = $product['products']['id'];
                $product_arr['sku_no'] = $product['products']['sku_no'];
                $product_arr['price'] = $product['products']['price'];
                $product_arr['qty'] = $product['products']['qty'];
                $product_arr['client_email'] = $product['products']['client_email'];
                $product_arr['product_name'] = $product['products']['product_name'];
                $product_a[] = $product_arr;
                $order->product = $product['products'];
            }
            $product_arr = [];
            $order->sender_name = ($order->clients['name']) ?  $order->clients['name'] : '';
            $order->sender_mail = ($order->clients['email']) ?  $order->clients['email'] : '';
            // $order->client_name = ($order->clients['name']) ?  $order->clients['name'] : '';

            if (Auth::guard('web')->check()) {
                $order->user_name = ($order->user['name']) ?  $order->user['name'] : '';
            } elseif (Auth::guard('clients')->check('clients')) {
                $order->user_name = ($order->user['name']) ?  $order->user['name'] : '';
            }

            $order->product = $product_a;
            return $order;
        });
    }
}
