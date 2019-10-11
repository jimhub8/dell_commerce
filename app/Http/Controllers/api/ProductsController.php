<?php

namespace App\Http\Controllers\api;

use App\models\Product;
use App\models\Productimg;
use App\models\Size_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $products = Product::paginate(12);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::with(['sizes', 'images'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $product = Product::find($id);
        $product->subcategory_id = $request->subCatSelect['id'];
        $product->category_id = $request->CatSelect['id'];
        $product->name = $request->form['name'];
        $product->price = $request->form['price'];
        $product->list_price = $request->form['list_price'];
        $product->description = $request->form['description'];
        $product->quantity = $request->form['quantity'];
        $product->save();
        return $product;
    }

    public function getProducts()
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            return Product::take(500)->latest()->get();
        } else {
            return Product::where('company_id', Auth::user()->company_id)->take(500)->latest()->get();
        }
    }

    public function featured()
    {
        return Product::where('featured', 1)->get();
    }

    public function bestSell()
    {
        return Product::where('best_sell', 1)->get();
    }

    public function newProduct()
    {
        return Product::where('new_product', 1)->get();
    }

    public function best_sellItem(Request $request, $id)
    {
        return $request->all();
        $product = Product::find($id);
    }

    public function new_prodtctItem(Request $request, $id)
    {
        return $request->all();
        $product = Product::find($id);
    }

    public function related(Request $request, $id)
    {
        $product = Product::find($id);
        return Product::where('subCategory_id', $product->subCategory_id)->where('id', '!=', $id)->take(16)->get();
    }

    public function search(Request $request)
    {
        // return $request->all();
        $search = $request->search;
        return Product::where('name', 'LIKE', "%{$search}%")
            ->orwhere('description', 'LIKE', "%{$search}%")->paginate(12);
    }

    public function searchProduct(Request $request)
    {
        // return $request->all();
        $search = $request->search;
        return Product::where('name', 'LIKE', "%{$search}%")->get();
    }

    public function searchItems($search)
    {
        // return $search;
        return Product::where('name', 'LIKE', "%{$search}%")
            ->orwhere('description', 'LIKE', "%{$search}%")->paginate(12);
    }
}
