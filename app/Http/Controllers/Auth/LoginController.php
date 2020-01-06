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
use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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


	/**
	 * Redirect the user to the Social media authentication page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function redirectToProvider($service) {
		return Socialite::driver($service)->redirect();
	}

	/**
	 * Obtain the user information from Social media.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function handleProviderCallback($service) {
		$userSocialite = Socialite::driver($service)->user();
		$findUser = User::where('email', $userSocialite->email)->first();
		if ($findUser) {
			// return $findUser;
			// Auth::login($findUser);
			return redirect('/');
		} else {
			$user = new User;
			$user->name = $userSocialite->name;
			$user->email = $userSocialite->email;
			// $user->profile = $userSocialite->avatar;
			// return $user;
			// $user->status = '0';
			$user->password = Hash::make('password');
			$user->save();
			Auth::login($userSocialite->email);
			return redirect('/');
		}
	}
}
