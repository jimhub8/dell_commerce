<?php

namespace App\Http\Controllers;

use App\models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Size::all();
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
        $size = new Size;
        $size->name = $request->name;
        $size->user_id = Auth::id();
        $size->save();
        return $size;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        return Size::find($size->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request->all();
        $size = Size::find($id);
        $size->name = $request->name;
        $size->user_id = Auth::id();
        $size->save();
        return $size;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        Size::find($size->id)->delete();
    }
}
