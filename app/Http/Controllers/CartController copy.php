<?php

namespace App\Http\Controllers;

use Cart;
use App\models\CouponSession;
use App\models\Product;
use App\models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartControllercopy extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // return $request->all();
        $product = Product::find($id);
        Cart::add(['id' => $id, 'name' => $product->product_name, 'qty' => 1, 'price' => 9.99, 'options' => ['size' => 'small']]);
        return;
        // return $id;
        // $request->session()->flush('cart');
        $quantity = $product->quantity;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $cartA = [];
        foreach ($cart->items as $itemsC) {
            $cartA[] = $itemsC;
        }
        foreach ($cartA as $value) {
            if ($id == $value['item']['id']) {
                $qty = $value['qty'];
                $price = $value['price'];
            }
        }
        // dd($qty, $quantity);
        if ($qty > $quantity) {
            return response()->json(['errors' => "Only " . $quantity . " items are available, you already have " . $quantity . " in your cart", 'status' => '200'], '200');
        }
        $request->session()->put('cart', $cart);
        return $cartA;
    }

    public function subToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        // dd($oldCart);
        $cart = new Cart($oldCart);
        $cart->subtruct($product, $product->id);
        $cartA = [];
        foreach ($cart->items as $itemsC) {
            $cartA[] = $itemsC;
        }
        $request->session()->put('cart', $cart);
        return $cartA;
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
        return Cart::content();

        // dd(Session::get('cart'));
        if (Session::has('cart')) {
            $carts = Session::get('cart');
            $cartA = [];
            foreach ($carts->items as $itemsC) {
                $cartA[] = $itemsC;
            }
            return ($cartA);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            return $cart->getCart();
        } else {
            return;
        }

        // Get Total if coupons

    }

    public function couponSes()
    {
        $oldCounpon = Session::has('cart') ? Session::get('cart') : null;
        $coupon = new CouponSession($oldCounpon);
        return $coupon->getCoupon();
        // $coupon->amount;

        // $coupons = Session::has('coupon') ? Session::get('coupon') : null;
        // // return Session::get('coupon');
        // // return $coupons->created_at;
        // $couponA = [];
        // if ($coupons) {
        //     foreach ($coupons as $coupon) {
        //         $couponA[] = $coupon;
        //     }
        //     // return $couponA;
        // } else {
        //     return 'bbd';
        // }
        // foreach ($couponA as $cop) {
        //     return $cop['created_at'];
        // }
    }

    public function cartAdd(Request $request, $id)
    {
        // return $request->all();
        // $request->session()->flush('cart');

        $product = Product::setEagerLoads([])->find($id);
        $product->attribute_id = $request->attribute;
        $av_quantity = $product->quantity;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        // dd($oldCart);
        $cart = new Cart($oldCart);
        $quantity = $request->quantity;
        $cart->cartAdd($product, $product->id, $quantity, $request->attribute);
        $cartA = [];
        // dd($cart);
        foreach ($cart->items as $itemsC) {
            $cartA[] = $itemsC;
        }

        foreach ($cartA as $value) {
            // $qty = $value['qty'];
            if ($id == $value['item']['id']) {
                $qty = $value['qty'];
                $price = $value['price'];
            }
        }
        // dd($cartA);

        if ($request->attribute) {
            $attr_qty = ProductAttribute::select('quantity')->find($request->attribute);
            // dd($attr_qty);
            $attr_qty = $attr_qty->quantity;
            $av_quantity = $request->attribute;
            if ($qty > $attr_qty) {
                return response()->json(['errors' => "Only " . $attr_qty . " items are available, you already have " . $av_quantity . " in your cart", 'status' => '200'], '200');
            }
        } elseif($qty > $av_quantity) {
            return response()->json(['errors' => "Only " . $av_quantity . " items are available, you already have " . $av_quantity . " in your cart", 'status' => '200'], '200');
        }
        $request->session()->put('cart', $cart);
        // dd($cartA);
        return $cartA;
    }

    public function flashCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        // dd($oldCart);
        $cart = new Cart($oldCart);
        $cart->flashCart($product->id);
        $cartA = [];
        foreach ($cart->items as $itemsC) {
            $cartA[] = $itemsC;
        }
        $request->session()->put('cart', $cart);
        return $cartA;
    }
}
