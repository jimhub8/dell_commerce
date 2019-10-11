<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ProductResource::collection(Product::with('reviews')->paginate(5));
        return $products = Product::with('reviews')->paginate();
        // return view('products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Product::with(['sizes', 'images', 'reviews'])->find($product->id);
    }

    public function product_imageg(Request $request, $id)
    {
        $upload = new Productimg;
        if ($request->hasFile('file')) {
            // return 'file';
            $fileName = time() . $request->file->getClientOriginalName();
            $mime = $request->file->getMimeType();
            $ext = $request->file->getClientOriginalExtension();
            // dd($mime);
            $request->file->storeAs('public/productstest/', $fileName);
        }
        $file_name = $fileName;
        $upload->image = '/storage/productstest/' . $file_name;
        $upload->mimetype = $mime;
        $upload->ext = $ext;
        $upload->product_id = $id;
        $upload->user_id = Auth::id();
        $upload->save();
        return $upload;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->Validate($request, [
            'category' => 'required',
            'subCategory' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
        ]);
        $user = auth('api')->user();
        $product = new Product;
        $product->subcategory_id = $request->subCategory;
        // $category_id = SupCategory::find($request->id';
        $product->category_id = $request->category;
        $product->company_id = $user->company_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->list_price = $request->list_price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->user_id = $user->id;

        if ($product->save() && $request->size) {
            // return 'test';
            $product_id = $product->id;
            $size_id = $request->size;
            $pro_size = new Size_product;
            $pro_size->product_id = $product_id;
            $pro_size->size_id = $size_id;
            $pro_size->save();
            // return $pro_size;
        } else {
            $product->save();
        }

        return response([
            'data' => new ProductResource($product),
        ], Response::HTTP_CREATED);
        return $product;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::find($product->id)->delete();
    }

    public function getProducts()
    {
        $user = $user;
        if ($user->hasRole('Admin')) {
            return Product::take(500)->latest()->get();
        } else {
            return Product::where('company_id', $user->company_id)->take(500)->latest()->get();
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
        return Product::where('product_name', 'LIKE', "%{$search}%")->get();
    }
}
