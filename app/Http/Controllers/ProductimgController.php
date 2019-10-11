<?php

namespace App\Http\Controllers;

use App\models\Productimg;
use Illuminate\Http\Request;

class ProductimgController extends Controller
{
        /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Productimg::where('product_id', $id)->get();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productimg::find($id)->delete();
    }
}
