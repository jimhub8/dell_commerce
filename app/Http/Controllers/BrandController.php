<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Brand::all();
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
        // $this->validate($request, [
        //     'name' => 'required',
        //     ]);
        $brand = new Brand;
        $brand->user_id = Auth::id();
        $brand->name = $request->form['name'];
        $brand->description = $request->form['description'];
        $brand->category_id = $request->categorySelect['id'];
        $brand->save();
        return $brand;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->save();
        return $brand;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }

    
    public function brandLimit()
    {
        return Brand::take(5)->inRandomOrder()->get();
    }
}
