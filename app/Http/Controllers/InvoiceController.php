<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\InvoiceMail;
use App\models\Logo;
use App\models\Sale;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoiceOrder');
    }
    public function invoice(Request $request, $id)
    {
        // dd($request->all());
        // dd($id);
        $type = $request->type;
        $sale = Sale::with('order')->find($id);
        $orders = $sale->order;
        // dd($sale->order);
        $user = Auth::user();
        // dd($user);
        // $orders->cart = unserialize($orders->cart);
        $orders->buyer_id = $user->name;
        $orders->user = $user;
        $cart = $orders->cart;
        $logo = new Logo;
        $logo = $logo->logo();

        $pdf = app('dompdf.wrapper')->loadView('pdf.saleorder', ['orders' => $orders, 'cart' => $cart, 'logo' => $logo]);
        if ($type == 'stream') {
            return $pdf->stream('invoice.pdf');
        }

        if ($type == 'download') {
            return $pdf->download('invoice.pdf');
        }
    }
}
