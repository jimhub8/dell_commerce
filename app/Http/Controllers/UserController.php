<?php

namespace App\Http\Controllers;

use App\Notifications\SignupActivate;
// use App\models\Role_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        return User::with(['roles'])->get();
    }

    public function getUsersCount()
    {
        return User::count();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $this->generateRandomString();
        // return $request->all();
        $this->Validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
            // 'phone' => ' numeric',
            'company' => 'required',
        ]);
        // return $request->all();
        $user = new User;
        // $password = $request->form['password'];
        $password = $this->generateRandomString();
        $password_hash = Hash::make($password);
        // $user->name = $request->name;
        $user->password = $password_hash;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->company_id = $request->company;
        $user->save();
        $user->assignRole($request->role_id);
        $user->givePermissionTo($request->selected);
        $user->notify(new SignupActivate($user, $password));
        return $user;
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $this->Validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        // ]);
        $user = User::find($request->id);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->address = $request->address;
        // dd($request->company_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->company_id = $request->company_id;
        // dd($request->role_name);
        $user->save();
        // foreach ($request->role_name as $role) {
        $role_name = $request->role_name;
        // }
        $user->syncRoles($role_name);

        return $user;
    }

    public function AuthUserUp(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->branch_id = $request->branch_id;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::find($user->id)->delete();
    }

    public function getLogedinUsers()
    {
        return Auth::user();
    }

    public function profile(Request $request, User $user, $id)
    {
        // return $request->all();
        $upload = User::find($request->id);
        if ($request->hasFile('image')) {
            // return $request->all();
            $imagename = time() . $request->image->getClientOriginalName();
            $request->image->storeAs('public/profile', $imagename);
            // return response();
        }
        $image_name = '/storage/profile/' . $imagename;
        $upload->profile = $image_name;
        $upload->save();
    }

    public function getDrivers()
    {
        $users = User::all();
        $userArr = [];
        foreach ($users as $user) {
            if ($user->hasRole('Rider')) {
                $userArr[] = $user;
            }
        }
        return $userArr;
    }

    public function getCustomer()
    {
        $users = User::all();
        $userArr = [];
        foreach ($users as $user) {
            if ($user->hasRole('Client')) {
                $userArr[] = $user;
            }
        }
        return $userArr;
    }

    public function getSorted(Request $request)
    {
        // return $request->all();
        $roles = User::all();
        $users_id = [];
        $users = User::all();
        $userArr = [];
        foreach ($users as $user) {
            if ($user->hasRole($request->name)) {
                $userArr[] = $user;
            }
        }
        return $userArr;
    }

    public function getUserPro(Request $request, $id)
    {
        return Shipment::where('client_id', $id)->paginate(10);
    }

    public function getUserPerm(Request $request, $id)
    {
        $user = User::find($id);
        $permissions = $user->getAllPermissions();
        $can = [];
        foreach ($permissions as $perm) {
            $can[] = $perm->name;
        }
        return $can;
    }

    public function password(Request $request)
    {
        $this->Validate($request, [
            'password' => 'required|string|min:6',
            // 'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }

    public function UserShip()
    {
        return Shipment::where('client_id', $id)->orWhere('driver', $id)->paginate(10);
    }
    public function send_sms($phone, $message)
    {
        // dd($phone . '   ' . $message);
        $phone = '254731090832';
        $sms = 'Test messange';
        $senderID = 'SPEEDBALL';

        $login = 'SPEEDBALL';
        $password = 's12345';

        $clientsmsID = rand(1000, 9999);

        $xml_data = '<?xml version="1.0"?><smslist><sms><user>' . $login . '</user><password>' . $password . '</password><message>' . $sms . '</message><mobiles>' . $phone . '</mobiles><senderid>' . $senderID . '</senderid><clientsmsid>' . $clientsmsID . '</clientsmsid></sms></smslist>';

        $URL = "http://messaging.advantasms.com/bulksms/sendsms.jsp?";

        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        // return $output;
    }

    public function logoutOther()
    {
        return view('auth.Logout');
    }

    public function logOtherDevices(Request $request)
    {
        Auth::logoutOtherDevices($request->password);
        return redirect('/admin/#/profile');
    }

    public function permisions(Request $request, $id)
    {
        // return $request->all();
        $user = User::find($id);
        $user->syncPermissions($request->selected);
        return $user;
    }
}
