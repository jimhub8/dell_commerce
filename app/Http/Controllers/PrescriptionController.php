<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Prescription;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Prescription::latest()->take(500)->get();
    }

    public function preImg(Request $request, $id)
    {
		// return $request->all();
        $upload = Prescription::find($request->id);
        if ($request->hasFile('image')) {
            $imagename = time() . $request->image->getClientOriginalName();
            $request->image->storeAs('public/prescriptions', $imagename);
			// return response();
        }
        $image_name = $imagename;
        $upload->image = $image_name;
        $upload->save();
        return $upload;
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
        $prescription = new Prescription;
        $prescription->description = $request->description;
        $prescription->user_id = Auth::id();
        $prescription->save();
        return $prescription;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        //
    }
}
