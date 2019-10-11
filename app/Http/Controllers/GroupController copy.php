<?php

namespace App\Http\Controllers;

use App\models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Product;
use App\models\Product_variants;
use App\models\AutoGenerate;

class GroupController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Group::where('company_id',  Auth::user()->company_id)->paginate(500);
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
        $attribute_1 = $request->attribute_arr[0]['attribute'];
        $attribute_2 = $request->attribute_arr[1]['attribute'];
        // dd($attribute_1, $attribute_2);
        // $group = new Group();
        // $group->group_name = $request->group_name;
        // $group->unit = $request->units;
        // $group->user_id = Auth::id();
        // $group->description = $request->description;
        // $group->company_id = Auth::user()->company_id;
        // $group->save();
        $attribute_exp = [];
        foreach ($request->itemAttribute_arr as $key => $value) {
            $prod_exp = explode('-', $value['item_name']);
            $product_name = $prod_exp[0];
            $attribute_exp[] = explode('/', $prod_exp[1]);
            $attributes = $attribute_exp;


            $product = new Product();
            $product->product_name = $value['item_name'];
            $product->category_id = $request->category;
            $product->subCategory_id = $request->subcategories;
            $product->description = $request->description;
            $product->price = $value['price'];
            $product->value = $value['price'];
            $product->sku_no = $value['sku_no'];
            // $product->group_id = $group->id;
            $product->reorder_point = $value['reorder_point'];
            $product->user_id = Auth::id();
            $product->has_variants = true;
            $product->company_id = Auth::user()->company_id;
            $product->instructions = 'Product created by ' . Auth::user()->name;
            // $product->save();

            // $product
        }
        // dd($attribute_exp);
        foreach ($attribute_exp as $key => $attrib) {
            $att_1 = $attribute_1 . '/' . $attrib[1];
            $att_1 = $attribute_2 . '/' . $attrib[0];
            // dd($attribute_2, $attrib[0], $attribute_1, $attrib[1]);
        }
        return;
        // $product->save();
        foreach ($request->itemAttribute_arr as $key => $value) {
            $product = new Product();
            $product->product_name = $value['item_name'];
            $product->category_id = $request->category;
            $product->subCategory_id = $request->subcategories;
            $product->description = $request->description;
            $product->price = $value['price'];
            $product->value = $value['price'];
            $product->sku_no = $value['sku_no'];
            $product->group_id = $group->id;
            $product->reorder_point = $value['reorder_point'];
            $product->user_id = Auth::id();
            $product->has_variants = true;
            $product->company_id = Auth::user()->company_id;
            $product->instructions = 'Product created by ' . Auth::user()->name;
            $product->save();
            // $product = new Product();
            // $gen = new AutoGenerate;
            // $product->group_id = $group->id;
            // $product->product_name = $request->group_name;
            // $product->sku_no = $gen->randomSku();
            // $product->has_variants = true;
            // $product->client_id = Auth::id();
            // $product->company_id = Auth::user()->company_id;

            // dd($value);
            $product_v = new Product_variants();
            $product_v->product_id = $product->id;
            $product_v->group_id = $group->id;
            $product_v->price = $value['price'];
            $product_v->reorder_point = $value['reorder_point'];
            $product_v->sku_no = $value['sku_no'];
            $product_v->item_name = $value['item_name'];
            $product_v->variant_id = $value['varient_i'];
            $product_v->save();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $groups = Group::with('variants')->find($id);
        // return array_flatten($groups->products);
        // $groups->transform(function($group) {
        //     // dd($group->products);
        //     // $group->products->transform()
        // });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
