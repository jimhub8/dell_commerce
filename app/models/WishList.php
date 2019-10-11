<?php

namespace App\models;

use Illuminate\Support\Facades\Session;


class WishList
{
    public $items = [];

    public function __construct($oldwish)
    {
        // dd($oldwish);
        if ($oldwish) {
            $this->items = $oldwish;
        }
    }

    public function add($oldwish, $item, $id)
    {
        // dd($oldwish);
        // if ($id  == $oldwish->id) {
        //     // $storedItem = $this->items[$id];
        //     // var_dump($id);
        //     // die();
        //     $this->remove();
        // } else {
            // $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
            // var_dump('eee');die();
            $this->items = $item;
            // dd($this->items);
        // }
    }


    public function remove($item, $id)
    {
        unset($this->items[$id]);
    }

    public function getWish()
    {
        // dd(Session::get('wish'));
        $wishes = Session::get('wish');
        $wishA = [];
        foreach ($wishes->items as $itemsC) {
            $wishA[] = $itemsC;
        }
        return ($wishA);
    }
}
