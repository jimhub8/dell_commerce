<?php

namespace App\Http\Controllers;

use App\models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Attribute::all();
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
        $attribute = new Attribute();
        // $attribute->attribute = $request->attribute;
        // $attribute->description = $request->description;
        // $attribute->user_id = Auth::id();



        $attribute->id = $request->id;
        $attribute->code = $request->name;
        $attribute->name = $request->name;
        $attribute->frontend_type = $request->frontend_type;
        $attribute->is_filterable = true;
        $attribute->is_required = false;
        $attribute->save();
        return $attribute;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Attribute::find($id)->values;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $attribute = Attribute::find($id);
        $attribute->attribute = $request->attribute;
        $attribute->description = $request->description;
        $attribute->save();
        return $attribute;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attribute::find($id)->delete();
    }
}
