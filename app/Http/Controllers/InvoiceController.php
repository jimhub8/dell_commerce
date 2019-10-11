<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\InvoiceMail;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoiceOrder');
    }
    public function invoice(Request $request, $id)
    {
        // return $request->all();
        $type = $request->type;
        $orders = Order::where('id', $id)->get();
        $user = [];
        foreach ($orders as $order) {
            $user = User::find($order->buyer_id);
        }
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            // dd(unserialize($order->paypal['id']));
            // $order->paypal = unserialize($order->paypal);
            // $user = User::find($order->buyer_id);
            $user = User::find($order->buyer_id);
            $order->buyer_id = $user->name;
            return $order;
        });
        // dd($user);
        foreach ($orders as $cart) {
            $cart = $cart->cart;
        }
        // dd($orders);
        // dd($cart);
        // return view('admin.invoiceOrder', compact('orders', 'cart'));
        // dd($cart);
        $pdf = app('dompdf.wrapper')->loadView('admin.invoiceOrder', ['orders' => $orders, 'cart' => $cart]);
        // Mail::send(new InvoiceMail($user, $user->email, $pdf));
        if ($type == 'stream') {
            return $pdf->stream('invoice.pdf');
        }

        if ($type == 'download') {
            return $pdf->download('invoice.pdf');
        }

        // return view('admin.invoiceOrder', compact('orders', 'cart'));
    }
// ...
    // return $order->getPdf(); // Returns stream default
    // return $order->getPdf('download'); // Returns the PDF as download
}
