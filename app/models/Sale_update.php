<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Cart;
use Illuminate\Support\Facades\Auth;

class Sale_update extends Model
{
    public function sold($status, $order_id)
    {

        $user = Auth::guard('client')->user();
        $cart = $this->getCart();
        foreach ($cart as $product) {
            $product_ = Product::find($product->id);
            // dd($product_->company_id);
            $sales = new Sale();
            $sales->product_id = $product->id;
            $sales->user_id = Auth::guard('client')->id();
            $sales->order_id = $order_id;
            $sales->company_id = $product_->company_id;
            $sales->list_price = $product->list_price;
            $sales->price = $product->price;
            $sales->quantity = $product->qty;
            $sales->total = $product->price;
            $sales->status = $status;
            $sales->client_name = $user->name;
            $sales->client_email = $user->email;
            $sales->client_phone = $user->phone;
            $sales->client_address = $user->address;
            $sales->product_name = $product->product_name;
            $sales->cart = serialize(Product::find($product->id));
            $sales->save();
            $this->update_qty();
        }
        return $sales;
    }
    public function getCart()
    {
        return Cart::content();
    }

    public function update_qty()
    {
        $cart = $this->getCart();
        foreach ($cart as $product) {
            $cart_id = $product->id;
            $cart_qty = $product->qty;
            $product_s = Product::find($cart_id);
            $new_qty = $product_s->quantity - $cart_qty;
            // dd($product_s->quantity .' - '. $cart_qty . ' = '. $new_qty);
            $product = Product::where('id', $cart_id)->update(['quantity' => $new_qty, 'qty' => $new_qty, 'onhand' => $new_qty]);
        }
        return $product;
    }

    public function cart_total()
    {
        $cart = Cart::subtotal();
        return str_replace(',', '', $cart);
    }
}
