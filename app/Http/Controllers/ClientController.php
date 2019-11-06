<?php

namespace App\Http\Controllers;

use App\models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\AutoGenerate;
use App\models\Product;
use App\models\Product_warehouse;
use App\models\Saleorder;
use App\User;
use Spatie\Permission\Models\Permission;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::paginate(500);
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
        $client = new Client;
        $client_id = new AutoGenerate;
        $client->client_id = $client_id->randomClientId();
        $client->address = $request->address;
        $client->address_2 = $request->address_2;
        $client->city = $request->city;
        $client->email = $request->email;
        $client->name = $request->name;
        $client->phone = $request->phone;
        // $client->salutat = $request->salutat;
        $client->work_phone = $request->work_phone;
        $client->save();
        return $client;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Client  $client
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
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $client = User::find($id);
        $client->address = $request->address;
        // $client->address_2 = $request->address_2;
        $client->city = $request->city;
        $client->email = $request->email;
        $client->name = $request->name;
        $client->phone = $request->phone;
        // $client->salutat = $request->salutat;
        // $client->work_phone = $request->work_phone;
        $client->save();
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
    }

    public function searchClient($search)
    {
        // return $search;
        // return Client::all();
        return Client::where('display_name', 'LIKE', "%{$search}%")->orWhere('name', 'LIKE', "%{$search}%")->get();
    }

    public function client_products($id)
    {
        $products = Product::where('client_id', $id)->paginate(200);
        $products->transform(function ($product) {
            if ($product->has_variants) {
                $product_val = Product_variants::where('product_id', $product->id)->get();
                // dd($product_val);
                $product_val->transform(function ($pro_val) {
                    $pro_val->variants = Variants::setEagerLoads([])->select('id', 'title')->where('id', $pro_val->variant_id)->get();
                    $pro_val->subvariants = SubVariant::select('id', 'title')->where('id', $pro_val->subvariant_id)->get();
                    // dd($pro_val->subvariant_id);
                    return $pro_val;
                });
                $product->variants = $product_val;
            }
            $onhand = Product_warehouse::where('product_id', $product->id)->sum('onhand');
            // dd($onhand);
            $product->onhand = $onhand;
            $product->dangerous = ($product->dangerous == 1) ? true : false;
            $product->lot = ($product->lot == 1) ? true : false;
            $product->digital = ($product->digital == 1) ? true : false;
            $product->has_serial = ($product->has_serial == 1) ? true : false;
            $product->active = ($product->active == 1) ? true : false;
            $onhand = Product_warehouse::where('product_id', $product->id)->sum('onhand');
            // dd($onhand);
            $product->onhand = ($onhand) ? $onhand : 0;
            // $product->onhand = $onhand;
            return $product;
        });
        return $products;
    }

    public function client_show($id)
    {
        return Client::select('name')->setEagerLoads([])->first();
    }

    public function client_home()
    {

        $permissions = [];
        foreach (Permission::where('guard_name', 'clients')->get() as $permission) {
            if (Auth::user()->can($permission->name)) {
                $permissions[$permission->name] = true;
            } else {
                $permissions[$permission->name] = false;
            }
        }
        $user = auth()->guard('clients')->user();
        $user = $user->setAppends(['is_client', 'is_admin'])->toArray();
        $auth_user = array_prepend($user, $permissions, 'can');
        return view('client.welcome', compact('auth_user'));
    }

    public function restor_client($id)
    {
        Client::withTrashed()->find($id)->restore();
    }

    public function force_delete($id)
    {
        Client::withTrashed()->find($id)->forceDelete();
    }

    public function deleted_clients()
    {
        $client = Client::onlyTrashed()->paginate(200);

        return $client;
    }
}
