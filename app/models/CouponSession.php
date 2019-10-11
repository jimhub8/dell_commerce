<?php

namespace App\models;

use Illuminate\Support\Facades\Session;

class CouponSession
{
    // public $items = [];

    // public function __construct($oldCoupon)
    // {
    //     if ($oldCoupon) {
    //         $this->items = $oldCoupon->items;
    //     }
    // }

    public function add($item, $id)
    {
        // var_dump($item);die;
        // if (array_key_exists($id, $this->items)) {
        //     $storedItem = $this->items[$id];
        //     // var_dump('storedItem');die();
        // } else {
        //     // var_dump('storItem');die();
        //     $storedItem = [
        //         'amount' => $item->amount, 'expiry_date' => $item->expiry_date, 'disc_type' => $item->disc_type, 'id' => $item->id, 'name' => $item->name, 'price' => $item->price, 'item' => $item,
        //     ];
        // }

        // $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $item;
        // $this->totalPrice += $item->price;
        // }

        // dd($this->items);
    }

    public function getCoupon()
    {
        // dd(Session::get('coupon'));
        $coupons = Session::get('coupon');
        $couponA = [];
        foreach ($coupons->items as $itemsC) {
            $couponA[] = $itemsC;
        }
        return ($couponA);
    }
}
