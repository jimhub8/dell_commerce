<?php

namespace App\Http\Controllers;

use App\models\Product;
use App\models\Productimg;
use App\models\Size_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\models\AutoGenerate;

class ProductController3 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd('request');
        return $products = Product::paginate(12);
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
        // return $valueNOK = Currency::conv($from = 'USD', $to = 'NOK', $value = 10, $decimals = 2);

        return Product::with(['sizes', 'images'])->find($product->id);
    }

    public function product_image(Request $request, $id)
    {
        // $id = 50;
        // dd($request->all());
        $upload = new Productimg;
        if ($request->hasFile('image')) {
            $fileName = time() . $request->image->getClientOriginalName();
            $mime = $request->image->getMimeType();
            $ext = $request->image->getClientOriginalExtension();
            // dd($fileName);
            // $imagename = Storage::disk('public')->put('products', $fileName);
            $request->image->storeAs('public/products/', $fileName);
        }
        $file_name = $fileName;
        $upload->image = '/storage/products/' . $file_name;
        $upload->mimetype = $mime;
        $upload->ext = $ext;
        $upload->product_id = $id;
        $upload->user_id = Auth::id();
        $upload->save();
        return $upload;
    }
    public function proImg(Request $request, $id)
    {

        $upload = Product::find($id);
        if ($request->hasFile('image')) {
            // return('test');
            // $imagename = time() . $request->image->getClientOriginalName();
            // $request->image->storeAs('public/test', $imagename);
            $img = $request->image;
            // $image_path = ;
            $image_file_arr = explode('/', $upload->image);
            $image_file = $image_file_arr[3];
            // $image_path = ;

            if (File::exists('storage/testImage/' . $image_file)) {
                // return('test');
                $image_path = 'storage/testImage/' . $image_file;
                File::delete($image_path);
                // return $image_path;
            }
            // $imagename =  Storage::disk('uploads')->put('testImage', $img);
            $imagename = Storage::disk('public')->put('testImage', $img);
        }

        // dd($imagename);
        $imgArr = explode('/', $imagename);
        $image_name = $imgArr[1];
        $upload->image = '/storage/testImage/' . $image_name;
        // $upload->image = '/storage/testImage/'.$image_name;
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
        $request->validate([
            'product_name' => 'required|unique:products',
            // 'client_id' => 'required',
            'sku_no' => 'required|unique:products',
        ]);
        // return $request->all();
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->name = $request->product_name;
        $product->client_id = Auth::user();
        $product->sku_no = $this->uniqueSku();;
        $product->user_id = Auth::id();
        $product->instructions = 'Product created by ' . Auth::user()->name;
        $product->save();
        return $product;
    }

    public function uniqueSku()
    {
        $product = Product::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $product = ($product) ? 'MFT_' . str_pad($product->id + 1, 8, "0", STR_PAD_LEFT) : 'MFT_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['sku_no' => $product], ['sku_no' => 'unique:products,sku_no']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $product;
        // dd($product);
    }
    /**
     * Server upload start
     *
     **/

/*
    public function product_image(Request $request, $id)
    {
        $upload = new Productimg;
        if ($request->hasFile('image')) {
            $img = $request->image;
            $imagename =  Storage::disk('uploads')->put('dellmat', $img);
        }

        // dd($imagename);
        $imgArr = explode('/', $imagename);
        $image_name = $imgArr[1];
        $upload->image = '/estorage/dellmat/' . $image_name;
        $upload->product_id = $id;

        $upload->save();
        return $upload;
    }


    public function proImg(Request $request, $id)
    {

        $upload = Product::find($id);
        if ($request->hasFile('image')) {
            // return('test');
            // $imagename = time() . $request->image->getClientOriginalName();
            // $request->image->storeAs('public/test', $imagename);
            $img = $request->image;
            // $image_path = ;
            $image_file_arr = explode('/', $upload->image);
            $image_file = $image_file_arr[3];
            // $image_path = ;

            if (File::exists('estorage/products/' . $image_file)) {
                // return('test');
                $image_path = 'estorage/products/' . $image_file;
                File::delete($image_path);
                // return $image_path;
            }
            $imagename =  Storage::disk('uploads')->put('products', $img);
            // $imagename = Storage::disk('public')->put('productstest', $img);
        }

        // dd($imagename);
        $imgArr = explode('/', $imagename);
        $image_name = $imgArr[1];
        $upload->image = '/estorage/products/' . $image_name;
        // $upload->image = '/storage/productstest/'.$image_name;
        $upload->save();
        return $upload;
    }
    */

    /**
     * Server upload End
     *
     **/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     // return $request->all();
    //     $this->Validate($request, [
    //         'category' => 'required',
    //         'subCategory' => 'required',
    //         'name' => 'required',
    //         'price' => 'required|numeric',
    //         'quantity' => 'required',
    //     ]);
    //     $product = new Product;
    //     $product->subcategory_id = $request->subCategory;
    //     // $category_id = SupCategory::find($request->id';
    //     $product->category_id = $request->category;
    //     $product->company_id = Auth::user()->company_id;
    //     $product->name = $request->name;
    //     $product->price = $request->price;
    //     $product->list_price = $request->list_price;
    //     $product->description = $request->description;
    //     $product->details = $request->editorData;
    //     $product->quantity = $request->quantity;
    //     $product->user_id = Auth::id();

    //     if ($product->save() && $request->size) {
    //         // return 'test';
    //         $product_id = $product->id;
    //         $size_id = $request->size;
    //         $pro_size = new Size_product;
    //         $pro_size->product_id = $product_id;
    //         $pro_size->size_id = $size_id;
    //         $pro_size->save();
    //         // return $pro_size;
    //     } else {
    //         $product->save();
    //     }

    //     return $product;
    // }

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

    public function StatusItem(Request $request, $id)
    {
        // return $request->all();
        $status = $request->status;
        $data = $request->data;
        $product = Product::find($id);
        if ($status == 'featured') {
            // dd($status);
            $product->featured = !$data;
        } elseif ($status == 'best_sell') {
            // dd($status);
            $product->best_sell = !$data;
        } elseif ($status == 'new_product') {
            // dd($status);
            $product->new_product = !$data;
        } elseif ($status == 'carousel') {
            // dd($status);
            $product->carousel = !$data;
        }
        $product->save();
        return $product;
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

    public function featuredItemFalse(Request $request, $id)
    {
        // return $request->all();
        $product = Product::find($id);
        $product->featured = !$request->id;
        $product->save();
        return $product;
    }

    public function best_sellItemFalse(Request $request, $id)
    {
        return $request->all();
        $product = Product::find($id);
    }

    public function new_productItemFalse(Request $request, $id)
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


    public function uniquesku_no()
    {
        $gen = new AutoGenerate;
        return $gen->randomSku();
    }
}
