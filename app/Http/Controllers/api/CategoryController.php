<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Category;

class CategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::with(['subCategories'])->orderBy('name')->get();
    }

    public function show(Request $request, $id)
    {
        return Category::find($id);
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
        $this->validate($request, [
            'name' => 'required',
            'main_category' => 'required',
        ]);
        $category = new Category;
        $category->user_id = Auth::id();
        $category->menu_id = $request->main_category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $category = Category::find($id);
        $category->menu_id = $request->menu['id'];
        $category->name = $request->form['name'];
        $category->description = $request->form['description'];
        $category->save();
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function category(Request $request, $id)
    {
        // $category = Category::with(['products'])->find($id);
        // return $category->products;
        return Product::where('category_id', $id)->paginate(12);

        // return Category::whereHas('products', function($query) use($id) {
        //     $query->where('category_id', $id)->paginate(10);
        // });
    }

    public function catLimit()
    {
        return Category::take(5)->inRandomOrder()->get();
    }
}
