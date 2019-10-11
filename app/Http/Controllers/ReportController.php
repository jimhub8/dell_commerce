<?php

namespace App\Http\Controllers;

use App\models\Sale;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Maatwebsite\Excel\Exporter;
//

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        // return $request->all();
        $date_array = array(
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        );
        return $orders = Sale::where('company_id', $request->sale)->whereBetween('created_at', [$date_array])->take(5000)->get();
        $orders->transform(function ($order) {
            $order->cart = unserialize($order->cart);
            $products = [];
            if ($order->delivered == 0) {
                $order->delivered = 'false';
            } else {
                $order->delivered = 'true';
            }
            foreach ($order->cart as $value) {
                $products[] = $value['item'];
                $order->price = $value['price'];
                $order->quantity = $value['qty'];
            }
            foreach ($products as $product) {
                $order->product_name = $product->name;
                $order->list_price = $product->list_price;
                // $company = Company::find($product->company_id);
                // dd($product->company_id);
                // $order->vendor_name = $company->company_name;
                // $order->vendor_email = $company->email;
                // $order->vendor_phone = $company->phone;
            }
            $order->products = $products;
            return $order;
        });
        return $orders;

    }
    public function vendorProduct(Request $request)
    {
        $date_array = array(
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        );
        $orders = Order::whereBetween('created_at', [$date_array])->take(5000)->get();
        $orders->transform(function ($order) {
            $order->cart = unserialize($order->cart);
            $products = [];
            if ($order->delivered == 0) {
                $order->delivered = 'false';
            } else {
                $order->delivered = 'true';
            }
            foreach ($order->cart as $value) {
                $products[] = $value['item'];
                $order->price = $value['price'];
                $order->quantity = $value['qty'];
            }
            foreach ($products as $product) {
                $order->product_name = $product->name;
                $order->list_price = $product->list_price;
                // $company = Company::find($product->company_id);
                // dd($product->company_id);
                // $order->vendor_name = $company->company_name;
                // $order->vendor_email = $company->email;
                // $order->vendor_phone = $company->phone;
            }
            $order->products = $products;
            return $order;
        });
        return $orders;

    }

    public function DelivReport(Request $request)
    {
        // return $request->all();
        $date_array = array(
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        );
        $Update_array = array(
            'Upstart_date' => $request->Upstart_date,
            'Upend_date' => $request->Upend_date,
        );
        $status = $request->status;
        $branch_id = $request->branch_id;

        if (empty($branch_id)) {
            if ($status == 'Dispatched') {
                return Shipment::where('country_id', Auth::user()->country_id)->latest()->setEagerLoads([])->whereBetween('dispatch_date', [$date_array])->whereBetween('created_at', [$Update_array])->take(5000)->get();
            } else {
                return Shipment::where('country_id', Auth::user()->country_id)->latest()->setEagerLoads([])->whereBetween('derivery_date', [$date_array])->whereBetween('created_at', [$Update_array])->where('status', $status)->take(5000)->get();
            }
        } else {
            if ($status == 'Dispatched') {
                return Shipment::where('country_id', Auth::user()->country_id)->where('branch_id', $branch_id)->latest()->setEagerLoads([])->whereBetween('dispatch_date', [$date_array])->whereBetween('created_at', [$Update_array])->take(5000)->get();
            } else {
                return Shipment::where('country_id', Auth::user()->country_id)->where('branch_id', $branch_id)->latest()->setEagerLoads([])->whereBetween('derivery_date', [$date_array])->whereBetween('created_at', [$Update_array])->where('status', $status)->take(5000)->get();
            }
        }
    }

    public function ProdReport(Request $request)
    {
        // return $request->all();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $email = $request->email;
        $status = $request->status;

        $date_array = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
        );

        if ($status == 'Dispatched') {
            return Shipment::where('country_id', Auth::user()->country_id)->latest()->setEagerLoads([])->whereBetween('dispatch_date', [$date_array])->where('client_email', 'LIKE', "%{$email}%")->take(5000)->get();
        } else {
            return Shipment::where('country_id', Auth::user()->country_id)->latest()->setEagerLoads([])->whereBetween('derivery_date', [$date_array])->where('client_email', 'LIKE', "%{$email}%")->where('status', $status)->take(5000)->get();
        }

    }
}
