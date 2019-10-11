<?php

namespace App\Http\Controllers;

use App\models\Wish;
use App\models\Product;
use Illuminate\Http\Request;
use App\models\WishList;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $product_id = Wish::all();
        // return Product::whereIn('id', $product_id)->get();
        // return (Session::get('wish'));
        if (Auth::check()) {
            $wishes = Wish::with(['product'])->where('user_id', Auth::id())->get();
            $wish_list = [];

            foreach ($wishes as $wish) {
                $wish_list[] = $wish->product;
            }
            return $wish_list;
        }
        $wishs_ar = Session::get('wish');
        return $wishs = array_flatten($wishs_ar);

        // $wishA = [];
        // foreach ($wishs as $itemsC) {
        //     $wishA[] = $itemsC;
        // }
        // return ($wishA);
        // if (Session::has('wish')) {
        //     $oldWish = Session::has('wish') ? Session::get('wish') : null;
        //     $wish = new Wish($oldWish);
        //     return $wish->getWish();
        // } else {
        //     return;
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function store(Wish $wish)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->session()->forget('wish');
        // return $request->all();
        $product = Product::find($id);
        $oldWish = Session::has('wish') ? Session::get('wish') : null;
        $id_array = [];
        if (!empty($oldWish[$id])) {
            foreach ($oldWish[$id] as $wish) {
                $id_array[] = $wish->id;
            }
            if (in_array($id, $id_array)) {
                // unset($oldWish[$id]);
                Session::forget('wish.' . $id, $id);
            } else {
                $request->session()->push('wish' . $id, $product);
            }
        } else {
            $request->session()->push('wish.' . $id, $product);
        }

        if (Auth::check()) {
            $wish_list = Wish::select('product_id')->where('user_id', Auth::id())->get();
            $product_id = $wish_list->map(function ($wish) {
                return $wish->only('product_id');
            });
            $pro_array = $product_id->toArray();
            $arr_pro = array_flatten($pro_array);
            if (in_array($id, $arr_pro)) {
                $this->destroy($id);
                return 'removed';
            }
            // return Auth::user();
            $wish = new Wish;
            $wish->user_id = Auth::id();
            $wish->product_id = $id;
            $wish->save();
        }

        return Session::get('wish');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Wish::where('user_id', Auth::id())->where('product_id', $id)->delete();
    }
}
