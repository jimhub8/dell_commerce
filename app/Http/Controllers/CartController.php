<?php

namespace App\Http\Controllers;

use Cart;
use App\models\CouponSession;
use App\models\Product;
use App\models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // return $request->all();
        $product = Product::find($id);
        Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => 1, 'price' => $product->price]);
        return $this->getCart();
    }

    public function subToCart(Request $request, $id)
    {
        $product = Product::find($id);
        Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => -1, 'price' => $product->price]);
        return $this->getCart();
    }

    public function getCartProduct()
    {
        $cart = $this->getCart();
        foreach ($cart as $product) {
            $cart_id = $product['item']['id'];
            $cart_qty = $product['qty'];
            $product_s = Product::find($cart_id);
            $new_qty = $product_s->quantity - $cart_qty;
            // dd($product_s->quantity .' - '. $cart_qty . ' = '. $new_qty);
            $product = Product::where('id', $cart_id)->update(['quantity' => $new_qty]);
        }
        return $product;
    }
    public function getCart()
    {
        // Cart::destroy();
        // return;
        $cart_d =  Cart::content();
        $cart_d->transform(function ($cart) {
            // dd($cart->id);
            $product = Product::setEagerLoads([])->find((int) $cart->id);
            // dd($product);
            $cart->name = $product;
            return $cart;
        });
        return $cart_d;
    }

    public function couponSes()
    {
        $oldCounpon = Session::has('coupon') ? Session::get('coupon') : null;
        $coupon = new CouponSession($oldCounpon);
        return $coupon->getCoupon();
    }

    public function cartAdd(Request $request, $id)
    {
        // Cart::destroy();
        // return;
        // return $request->all();
        $product = Product::setEagerLoads([])->find($id);
        if ($request->attribute) {
            $attr_ = ProductAttribute::select('quantity', 'value', 'price')->find($request->attribute);
            $attr_qty = $attr_->quantity;
            $product->quantity = $request->attribute;
            $price = (float) $attr_['price'];
            // dd($price);
            $value = $attr_['value'];
            if ($request->quantity > $attr_qty) {
                return response()->json(['errors' => "Only " . $attr_qty . " items are available, you already have " . $av_quantity . " in your cart", 'status' => '200'], '200');
            }
            Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => $request->quantity, 'price' => $price, 'options' => ['size' => $value]]);
        } else {
            // dd($product->price);
            if ($request->quantity > $product->quantity) {
                return response()->json(['errors' => "Only " . $product->quantity . " items are available, you already have " . $product->quantity . " in your cart", 'status' => '200'], '200');
                Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => $request->quantity, 'price' => $product->price]);
            }
            Cart::add(['id' => $id, 'product' => $product, 'name' => $product->product_name, 'qty' => $request->quantity, 'price' => (int) $product->price]);
        }
    }

    public function flashCart(Request $request)
    {
        // return $request->all();
        $rowId = $request->rowId;

        Cart::remove($rowId);
        // $product = Product::find($id);
        // $oldCart = Session::has('cart') ? Session::get('cart') : null;
        // // dd($oldCart);
        // $cart = new Cart($oldCart);
        // $cart->flashCart($product->id);
        // $cartA = [];
        // foreach ($cart->items as $itemsC) {
        //     $cartA[] = $itemsC;
        // }
        // $request->session()->put('cart', $cart);
        // return $cartA;
    }

    public function cart_total()
    {
        $cart = Cart::total();
        return str_replace(',', '', $cart);
    }

    public function cart_count() {
        return Cart::count();
    }
}
