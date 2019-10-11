<?php

namespace App\Http\Controllers;

use App\models\Attribute;
use App\models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Product;
use App\models\Product_variants;
use App\models\AutoGenerate;
use App\models\ProductAttribute;

class GroupController extends Controller
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
        $attribute_1 = [];
        $attribute_2 = [];
        $attribute_v_1 = [];
        $attribute_v_2 = [];
        $price = [];
        // dd(count($request->itemAttribute_arr));
        foreach ($request->itemAttribute_arr as $key => $attri_v) {
            $attribute_1[] = $attri_v['attribute_1'];
            $attribute_2[] = $attri_v['attribute_2'];
            $attribute_v_1[] = $attri_v['attribute_value_1'];
            $attribute_v_2[] = $attri_v['attribute_value_2'];
            $price[] = $attri_v['price'];
        }

        $com = [];
        for ($i = 0; $i < count($request->itemAttribute_arr); $i++) {
            $com[] = $attribute_1[$i] . ':' . $attribute_v_1[$i] . '-' . $attribute_2[$i] . ':' . $attribute_v_2[$i] . '/' . $price[$i];
        }
        $collection_1 = collect($attribute_v_1);
        $unique_1 = $collection_1->unique();
        $unique_1 = $unique_1->values()->all();
        $collection_2 = collect($attribute_v_2);
        $unique_2 = $collection_2->unique();
        $unique_2 = $unique_2->values()->all();

        $product_attribute = new ProductAttribute();
        $product_attribute->attribute_v_1 = serialize($attribute_v_1);
        $product_attribute->attribute_v_2 = serialize($attribute_v_2);
        // dd($attribute_1, $attribute_2, $attribute_v_1, $attribute_v_2,$price);
        // dd($unique_2, $unique_1);

        /*
        $attribute_1 = $request->attribute_arr[0];
        $attribute_2 = $request->attribute_arr[1];
        $att_t = [];
        $tags = [];
        foreach ($request->attribute_arr as $att_tags) {
            $tags = [];
            foreach ($att_tags['tags'] as $tags_att) {
                $tags[] = $tags_att['text'];
            }
            $att_t[] = $tags;
        }
        // dd($att_t);
        foreach ($request->itemAttribute_arr as $key => $value) {
            $prod_exp = explode('-', $value['item_name']);
            $attribute_exp = explode('/', $prod_exp[1]);
            // dd($attribute_exp[0]);
            // $attribute = Attribute::select('id')->where('attribute', $attribute_exp[$key])->first();
            // dd($attribute);
            $product_name = $prod_exp[0];
            $product = new Product();
            $product->name = $product_name;
            $gen = new AutoGenerate;
            $product->sku_no = $gen->randomSku();
            $product->product_name = $product_name;
            // $product->save();

            $prod_att = new ProductAttribute;
            $prod_att->product_id = $product->id;
            $prod_att->attribute_id = $attribute->id;
            $prod_att->attributes = serialize($att_t[$key]);
            $prod_att->save();
        }*/
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
