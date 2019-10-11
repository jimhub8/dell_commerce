<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\models\Cart;
use Illuminate\Support\Facades\Auth;
use App\models\Wish;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
        $wishes = $this->getWish();
        // dd($wishes);
        if ($wishes) {
            foreach ($wishes as $wish) {
                foreach ($wish as $list) {
                    // return $list->id;
                    $wish = new Wish;
                    $wish->user_id = Auth::id();
                    $wish->product_id = $list->id;
                    $wish->save();
                }
            }
        }
        // dd($wishes);
    }


    public function getWish()
    {
        return Session::has('wish') ? Session::get('wish') : null;
    }
}
