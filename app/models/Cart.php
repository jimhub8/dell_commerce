<?php

namespace App\models;

use Illuminate\Support\Facades\Session;

class Cart
{
    public $items = [];
    public $totalPrice = 0;
    public $totalQty = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalQty = $oldCart->totalQty;
        }
    }

    public function add($item, $id)
    {
        if (array_key_exists($id, $this->items)) {
            $storedItem = $this->items[$id];
        } else {
            $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        }

        $storedItem['qty']++;

        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalPrice += $item->price;
        $this->totalQty++;
        // dd($this->items);
    }

    public function cartAdd($item, $id, $quatity, $attribute)
    {
        dd($this->items);
        if (array_key_exists($id, $this->items)) {
            $storedItem = $this->items[$id];
        } else {
            $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        }
        $storedItem['attribute'] = $attribute;
        $storedItem['qty'] += $quatity;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        // dd($this->items[$id]);
        $this->totalPrice += $item->price;
        $this->totalQty++;
    }

    public function subtruct($item, $id)
    {
        $storedItem = $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalPrice -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function coupon($coupon)
    {
        // $storedItem = $this->items[$id]['qty']--;
        // $this->items[$id]['final_price'] -= $this->items[$id]['item']['price'];
        // var_dump($this->items);
        $this->items['coupon'] = $coupon;
        $coupon_t = $this->totalPrice * $coupon / 100;
        $this->items['final_price'] = $coupon_t;
        // $this->totalQty--;
        // if ($this->items[$id]['qty'] <= 0) {
        //     unset($this->items[$id]);
        // }
    }

    public function getCart()
    {
        // dd(Session::get('cart'));
        $carts = Session::get('cart');
        $cartA = [];
        // dd($carts);
        foreach ($carts->items as $itemsC) {
            $cartA[] = $itemsC;
        }
        return ($cartA);
    }

    public function flashCart($id)
    {
        unset($this->items[$id]);
    }
}
