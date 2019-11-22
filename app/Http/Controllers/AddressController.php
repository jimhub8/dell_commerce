<?php

namespace App\Http\Controllers;

use App\models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Address::where('user_id', Auth::id())->first();
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
        $address = Address::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'email' => $request->email,
                'city' => $request->city,
                'phone' => $request->phone,
                'additinal_phone' => $request->additinal_phone,
                'address' => $request->address['formatted_address'],
                'notes' => $request->notes,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]
        );
        return $address;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return($request->address['formatted_address']);
        // return $request->all();
        $address = Address::where('user_id', Auth::id())->first();
        $address->user_id = Auth::id();
        $address->name = $request->name;
        $address->email = $request->email;
        $address->city = $request->address['city'];
        $address->phone = $request->address['phone'];
        $address->additinal_phone = $request->address['additinal_phone'];
        $address->address = $request->address['address'];
        $address->notes = $request->address['notes'];
        $address->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
