<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\SupCategory;
use Illuminate\Support\Facades\Auth;
use App\models\Product;

class SupCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SupCategory::orderBy('name', 'ASC')->get();
    }

    public function show(Request $request, $id)
    {
        return SupCategory::find($id);
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
        $supCategory = new SupCategory;
        $supCategory->user_id = Auth::id();
        $supCategory->name = $request->form['name'];
        $supCategory->description = $request->form['description'];
        $supCategory->category_id = $request->categorySelect['id'];
        $supCategory->save();
        return $supCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupCategory  $supCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $supCategory = SupCategory::find($id);
        $supCategory->name = $request->form['name'];
        $supCategory->description = $request->form['description'];
        $supCategory->category_id = $request->SubcatSelect['id'];
        $supCategory->save();
        return $supCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupCategory  $supCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupCategory $supCategory)
    {
        //
    }

    
    public function subcategory(Request $request, $id)
    {
        return Product::where('subCategory_id', $id)->paginate(12);
        // $subcat = SupCategory::find($id);
        // return $subcat->products();
    }
}
