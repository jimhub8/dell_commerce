<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{

    protected $redirectTo = '/client/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('client.auth:client');
    }

    /**
     * Show the Client dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // return view('client.home');
        if (Auth::check()) {
            $user = Auth::user();
            $permissions = [];
            foreach (Permission::all() as $permission) {
                if ($user->can($permission->name)) {
                    $permissions[$permission->name] = true;
                } else {
                    $permissions[$permission->name] = false;
                }
            }

            $auth_user = array_prepend($user->toArray(), $permissions, 'can');
            $user = Auth::user();
            // dd($user);
            return view('welcome', compact('auth_user'));
        } else {
            return view('welcome');
        }
    }

}
