<?php

namespace App\Http\Controllers;

use App\models\Attribute;
use App\models\AttributeValueProductAttribute;
use App\models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductAttribute::select('price', 'quantity')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request->all();
        $productAttribute = new ProductAttribute();
        $productAttribute->product_id = $request->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function product_attribute_c(Request $request, $id)
    {
        // return $request->all();
        $productAttribute = new ProductAttribute();
        $productAttribute->product_id = $request->id;
        $productAttribute->attribute_id = $request->attribute;
        $productAttribute->price = $request->price;
        $productAttribute->quantity = $request->qty;
        $productAttribute->value = $request->attribute_value;
        $productAttribute->save();
        $product_attribute_id = Attribute::select('id')->find($request->id);
        $product_attribute_id = $productAttribute->id;
        $pro_att = new AttributeValueProductAttribute();
        $pro_att->attribute_value_id = $productAttribute->id;
        $pro_att->product_attribute_id  = $product_attribute_id;
        $pro_att->save();
        return $productAttribute;
    }
}
