<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
use Illuminate\Support\Facades\Session;
use App\models\Category;
use App\models\Menu;

class FilterController extends Controller
{
    public function filterItem(Request $request)
    {
        // return $request->all();
        return Product::whereIn('subcategory_id', $request->all())->paginate(9);
    }
    public function filterProduct(Request $request, $id)
    {
        // return $request->all();
        return Product::where('subcategory_id', $id)->paginate(9);
    }

    public function filterItems(Request $request)
    {
        // return $request->all();
        if ($request->brand != null) {
            return Product::where('brand_id', $request->brand)->paginate(9);
        } elseif ($request->sub_cat) {
            return Product::where('subcategory_id', $request->sub_cat)->paginate(9);
        } elseif ($request->price) {
            return Product::whereBetween('price', $request->price)->paginate(9);
        } else {
            return 'noop';
        }
    }


    public function FilterShop(Request $request)
    {
        // return $request->all();
        // return $request->price['state'];
        $products = new Product;

        if ($request->price[1] > 0) {
            $products = $products->whereBetween('price', $request->price);
        }
        if ($request->category_id > 0) {
            $products = $products->where('category_id', $request->category_id);
        }
        $products = $products->paginate(12);
        $products->transform(function ($product, $key) {
            $wishList = Session::has('wish') ? Session::get('wish') : null;
            $wish_id = [];
            if (!empty($wishList)) {
                foreach ($wishList as $wish) {
                    foreach ($wish as $value) {
                        // dd($value);
                        $wish_id[] = $value['id'];
                    }
                }
            }
            if (in_array($product->id, $wish_id)) {
                $product->wish_list = 1;
            } else {
                $product->wish_list = 0;
            }
            return $product;
        });
        return $products;
    }
}
