<?php

namespace App\Http\Controllers;

use App\models\DatabaseStorageModel;
use Illuminate\Http\Request;

class DatabaseStorageController extends Controller
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
     * @param  \App\DatabaseStorageModel  $databaseStorageModel
     * @return \Illuminate\Http\Response
     */
    public function show(DatabaseStorageModel $databaseStorageModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DatabaseStorageModel  $databaseStorageModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatabaseStorageModel $databaseStorageModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DatabaseStorageModel  $databaseStorageModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DatabaseStorageModel $databaseStorageModel)
    {
        //
    }

    public function has($key)
    {
        return DatabaseStorageModel::find($key);
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return new CartCollection(DatabaseStorageModel::find($key)->cart_data);
        } else {
            return [];
        }
    }

    public function put($key, $value)
    {
        if ($row = DatabaseStorageModel::find($key)) {
            // update
            $row->cart_data = $value;
            $row->save();
        } else {
            DatabaseStorageModel::create([
                'id' => $key,
                'cart_data' => $value
            ]);
        }
    }
}
