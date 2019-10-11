<?php

namespace App\Http\Controllers;

use App\models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\WarehouseReceive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\models\Product_warehouse;
use App\models\Product_variants;
use App\models\Variants;
use App\models\SubVariant;
use App\models\AutoGenerate;
use App\models\Productimg;

class ProductController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        $products = Product::Userid()->paginate(500);
        $products->transform(function ($product) {
            if ($product->active == 0 || $product->active == null) {
                $product->active = false;
            } else {
                $product->active = true;
            }
            if ($product->lot == 0 || $product->lot == null) {
                $product->lot = false;
            } else {
                $product->lot = true;
            }
            if ($product->dangerous == 0 || $product->dangerous == null) {
                $product->dangerous = false;
            } else {
                $product->dangerous = true;
            }
            if ($product->has_serial == 0 || $product->has_serial == null) {
                $product->has_serial = false;
            } else {
                $product->has_serial = true;
            }
            // $onhand = Product_warehouse::where('product_id', $product->id)->sum('onhand');
            // // dd($onhand);
            // // $product->onhand = $onhand;
            $product->onhand = $product->qty;
            // $awaiting_stoke = WarehouseReceive::where('products_id', $product->id)->sum('qty');
            // $product->awaiting_stoke = $awaiting_stoke;
            return $product;
        });
        return $products;
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
        $product->name = $request->product_name;
        $product->product_name = $request->product_name;
        $product->company_id = Auth::user()->company_id;
        $product->client_id = $request->client_id;
        $product->sku_no = $this->uniqueSku();;
        $product->user_id = Auth::id();
        $product->instructions = 'Product created by ' . Auth::user()->name;
        $product->save();
        return $product;
    }

    public function show_product($id)
    {
        return Product::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::Userid()->Userid()->where('id', $id)->get();
        $products->transform(function ($product) {
            if ($product->has_variants) {
                $product_val = Product_variants::where('product_id', $product->id)->get();
                // dd($product_val);
                $product_val->transform(function ($pro_val) {
                    $pro_val->variants = Variants::setEagerLoads([])->select('id', 'title')->where('id', $pro_val->variant_id)->get();
                    $pro_val->subvariants = SubVariant::select('id', 'title')->where('id', $pro_val->subvariant_id)->get();
                    // dd($pro_val->subvariant_id);
                    return $pro_val;
                });
                $product->variants = $product_val;
            }
            // // $onhand = Product_warehouse::where('product_id', $product->id)->sum('onhand');
            // dd($onhand);
            // // $product->onhand = $onhand;
            $product->dangerous = ($product->dangerous == 1) ? true : false;
            $product->lot = ($product->lot == 1) ? true : false;
            $product->digital = ($product->digital == 1) ? true : false;
            $product->has_serial = ($product->has_serial == 1) ? true : false;
            $product->active = ($product->active == 1) ? true : false;
            // // $onhand = Product_warehouse::where('product_id', $product->id)->sum('onhand');
            // dd($onhand);
            // // $product->onhand = ($onhand) ? $onhand : 0;
            // $product->onhand = $onhand;
            return $product;
        });
        return $products[0];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $variant = $request->form['variants_d'];
        // foreach ($variant as $key => $value) {
        //     foreach ($value['subvariants'] as $var_val) {
        //         // dd($value['variants'], $var_val);
        //         $product_variant  = new Product_variants();
        //         $product_variant->product_id = $id;
        //         $product_variant->subvariant_id = $var_val;
        //         $product_variant->variant_id = $value['variants'];
        //         $product_variant->save();
        //     }
        // }
        // return $request->all();
        $product = Product::find($id);
        $product->active = ($request->product['active']) ? 1 : 0;
        $product->dangerous = ($request->product['dangerous']) ? 1 : 0;
        $product->has_serial = ($request->product['has_serial']) ? 1 : 0;
        $product->lot = ($request->product['lot']) ? 1 : 0;
        $product->digital = ($request->product['digital']) ? 1 : 0;
        // $product->active = $request->product['active'];
        $product->box_id = $request->product['box_id'];
        $product->bar_code = $request->product['bar_code'];
        $product->classification_id = $request->product['classification_id'];
        $product->height = $request->product['height'];
        $product->length = $request->product['length'];
        // $product->lot = $request->product['lot'];
        $product->description = $request->product['description'];
        // $product->has_serial = $request->product['has_serial'];
        $product->name = $request->product['name'];
        $product->product_name = $request->product['product_name'];
        $product->product_type = $request->product['product_type'];
        $product->quantity = $request->product['quantity'];
        $product->onhand = $request->product['quantity'];
        $product->reorder_point = $request->product['reorder_point'];
        $product->tariff_code = $request->product['tariff_code'];
        $product->sku_no = $request->product['sku_no'];
        $product->value = $request->product['value'];
        $product->price = $request->product['value'];
        $product->weight = $request->product['weight'];
        $product->width = $request->product['width'];
        $product->price = $request->product['price'];
        $product->list_price = $request->product['list_price'];
        $product->has_variants = $request->product['has_variants'];
        // dd($product->getDirty());
        $product->instructions = 'Product details updated by ' . Auth::user()->name;
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function filterproducts(Request $request)
    {
        // return $request->all();
        $search = $request->search;
        $products = Product::Userid()->where('product_name', 'LIKE', "%{$search}%")->take(500)->get();
        $products->transform(function ($product) {
            $onhand = Product_warehouse::where('product_id', $product->id)->sum('onhand');
            // dd($onhand);
            $product->onhand = ($onhand) ? $onhand : 0;
            // $product->onhand = $onhand;
            return $product;
        });
        return $products;
    }


    public function pro_image(Request $request, $id)
    {
        // dd($request->image);
        $upload = Product::find($id);
        if ($request->hasFile('image')) {
            // return('test');
            // $imagename = time() . $request->image->getClientOriginalName();
            // $request->image->storeAs('public/test', $imagename);
            $img = $request->image;
            // $image_path = ;
            // $exists = Storage::disk('public')->exists($upload->image);

            // dd($exists, $upload->image);
            if (File::exists('storage/products/' . $upload->image)) {
                // return('test');
                $image_path = 'storage/products/' . $upload->image;
                File::delete($image_path);
                // return $image_path;
            }
            // $imagename =  Storage::disk('uploads')->put('products', $img);
            // $fileName = time() . $request->image->getClientOriginalName();
            // $request->image->storeAs('public/products/', $fileName);
            $imagename = Storage::disk('public')->put('products', $img);
            // dd($imagename);
            // return 'test';
        }

        // return('noop');
        $imgArr = explode('/', $imagename);
        $image_name = $imgArr[1];
        $upload->image = '/storage/products/' . $image_name;
        $upload->save();
        return $upload;
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

    public function randomId()
    {
        $id = str_random(10);
        $validator = \Validator::make(['sku_no' => $id], ['sku_no' => 'unique:products,sku_no']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $id;
    }

    public function filterProd_table(Request $request)
    {
        // return $request->all();
        if ($request->req == 'all') {
            $products = Product::Userid()->paginate(500);
        } else if ($request->req == 'inactive') {
            $products = Product::Userid()->where('active', false)->paginate(500);
        } else {
            $products = Product::Userid()->where($request->req, true)->paginate(500);
        }
        $products->transform(function ($product) {
            if ($product->active == 0 || $product->active == null) {
                $product->active = false;
            } else {
                $product->active = true;
            }
            if ($product->lot == 0 || $product->lot == null) {
                $product->lot = false;
            } else {
                $product->lot = true;
            }
            if ($product->dangerous == 0 || $product->dangerous == null) {
                $product->dangerous = false;
            } else {
                $product->dangerous = true;
            }
            if ($product->has_serial == 0 || $product->has_serial == null) {
                $product->has_serial = false;
            } else {
                $product->has_serial = true;
            }
            $onhand = Product_warehouse::where('product_id', $product->id)->sum('onhand');
            // dd($onhand);
            $product->onhand = ($onhand) ? $onhand : 0;
            // $product->onhand = $onhand;
            $awaiting_stoke = WarehouseReceive::where('products_id', $product->id)->sum('qty');
            $product->awaiting_stoke = $awaiting_stoke;
            return $product;
        });
        return $products;
    }

    public function activate(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->active = true;
            $product->save();
        }
    }

    public function deactivate(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->active = false;
            $product->save();
        }
    }

    public function digital(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->digital = true;
            $product->save();
        }
    }
    public function notdigital(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->digital = false;
            $product->save();
        }
    }

    public function dangerous(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->dangerous = true;
            $product->save();
        }
    }
    public function notdangerous(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->dangerous = false;
            $product->save();
        }
    }

    public function lot(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->lot = true;
            $product->save();
        }
    }
    public function notlot(Request $request)
    {
        // return $request->all();
        $products = $request->all();
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $product->lot = false;
            $product->save();
        }
    }

    public function commited()
    { }

    public function unique_sku()
    {
        $product = Product::select('id')->orderBy('id', 'Desc')->first();
        return $product->id;
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $product = ($product) ? str_pad($product->id + 1, 8, "0", STR_PAD_LEFT) : str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['sku_no' => $product], ['sku_no' => 'unique:products,sku_no']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $product;
    }


    public function product_group(Request $request)
    {
        // return $request->all();
        foreach ($request->itemAttribute_arr as $key => $value) {
            // dd($value['item_name']);
            $product = new Product;
            $product->product_name = $value['item_name'];
            $product->description = $request->description;
            $product->price = $value['price'];
            $product->value = $value['price'];
            $product->sku_no = $value['sku_no'];
            $product->reorder_point = $value['reorder_point'];
            $product->user_id = Auth::id();
            $product->instructions = 'Product created by ' . Auth::user()->name;
            $product->save();
        }
    }









    public function product_image(Request $request, $id)
    {
        // $id = 50;
        // dd($request->all());
        $upload = new Productimg();
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
            if ($upload->image) {
                $image_file_arr = explode('/', $upload->image);
                $image_file = ($image_file_arr) ? $image_file_arr[3] : '';

                if (File::exists('storage/products/' . $image_file)) {
                    // return('test');
                    $image_path = 'storage/products/' . $image_file;
                    File::delete($image_path);
                    // return $image_path;
                }
            }
            // $imagename =  Storage::disk('uploads')->put('products', $img);
            $imagename = Storage::disk('public')->put('products', $img);
        }

        // dd($imagename);
        $imgArr = explode('/', $imagename);
        $image_name = $imgArr[1];
        $upload->image = '/storage/products/' . $image_name;
        // $upload->image = '/storage/products/'.$image_name;
        $upload->save();
        return $upload;
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
            ->orWhere('product_name', 'LIKE', "%{$search}%")
            ->orwhere('description', 'LIKE', "%{$search}%")->paginate(12);
    }


    public function uniquesku_no()
    {
        $gen = new AutoGenerate;
        return $gen->randomSku();
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
}
