<?php

namespace App\Http\Controllers;

use App\models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Company;
use App\User;
use App\models\Cart;
use Illuminate\Support\Facades\Session;
use App\models\Product;
use Carbon\Carbon;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->where('user_id', Auth::id())->orWhere('company_id' ,Auth::user()->company_id)->take(500)->get();
        $sales->transform(function($sale) {
            $company  = Company::find($sale->company_id);
            $user  = User::find($sale->user_id);
            $sale->company_name = $company->company_name;
            $sale->buyer_name = $user->name;
            $created_at = Carbon::parse($sale->created_at);
            $sale->order_date = $created_at->format('d-M-Y');
            $sale->cart = unserialize($sale->cart);
            return $sale;
        });
        return $sales;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cart = $this->getCart();
        // dd($cart);
        foreach ($cart as $product) {
            $sales = new Sale;
            $sales->product_id = $product['item']['id'];
            $sales->user_id = Auth::id();
            $sales->company_id = $product['item']['company_id'];
            $sales->list_price = $product['item']['list_price'];
            $sales->price = $product['item']['price'];
            $sales->quantity = $product['qty'];
            $sales->total = $product['price'];
            $sales->status = 'Payed';
            $sales->product_name = $product['item']['name'];
            $sales->cart = serialize(Product::find($product['item']['id']));
            $sales->save();
        }
        return $sales;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sale::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $sale = Sale::find($id);
        $sale->status = $request->name;
        $sale->save();
        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sale::find($id)->delete();
    }



    public function getCart()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $carts = new Cart($oldCart);
        $carts = $carts->getCart($oldCart);
        $newCart = [];
        // foreach ($carts as $cart) {
        //     $newCart = $cart->item;
        // }
        return $carts;
    }
    public function clientOrders()
    {
        $sales = Sale::where('user_id', Auth::id())->paginate(500);
        $sales->transform(function($sale) {
            $created_at = Carbon::parse($sale->created_at);
            $sale->order_date = $created_at->format('D d M Y');
            $sale->cart = unserialize($sale->cart);
            $sale->product_name = $sale->product->product_name;
            return $sale;
        });
        return $sales;
    }
}
