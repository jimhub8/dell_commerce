<?php

namespace App\Http\Controllers;

use App\models\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorMail;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendor_user(Request $request)
    {
        // return($request->all());
        $company = new Company;
        // $company->user_id = (Auth::check()) ? Auth::id() : $user->id;
        $company->user_name = $request->user_name;
        $company->user_email = $request->user_email;
        $company->user_phone = $request->user_phone;
        $company->user_address = $request->user_address;
        $company->company_name = $request->company_name;
        $company->location = $request->location;
        $company->company_email = $request->company_email;
        $company->company_phone = $request->company_phone;
        $company->company_address = $request->company_address;
        $company->company_businessno = $request->company_businessno;
        $company->company_website = $request->company_website;
        $company->account_no = $request->account_no;
        $company->account_name = $request->account_name;
        $company->bank = $request->bank;
        $company->mpesa_name = $request->mpesa_name;
        $company->branch = $request->branch;
        $company->bank_code = $request->bank_code;
        $company->mpesa_phone = $request->mpesa_phone;
        $company->save();
        $user = new User();
        $user->company_id = $company->id;
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        $user->address = $request->user_address;
        $password = $this->generateRandomString();
        $password_hash = Hash::make($password);
        $user->password = $password_hash;
        $user->assignRole('Store Admin');
        Mail::send(new VendorMail($user, $password));
        // $user->notify(new SignupActivate($user, $password));
        $user->save();

        return $company;
        // return  $request->all();
        // $this->Validate($request, [
        //     'user_name' => 'required',
        //     'user_email' => 'required|email|unique:users,email',
        //     'user_phone' => 'required|numeric',
        //     'user_address' => 'required',
        //     'email' => 'required|email',
        //     'company_name' => 'required',
        //     'phone' => 'required|numeric',
        //     'address' => 'required',
        //     // 'phone' => ' numeric',
        //     // 'company' => 'required',
        // ]);

        // $company = new Company;
        // $company->company_name = $request->company_name;
        // $company->email = $request->email;
        // $company->phone = $request->phone;
        // $company->address = $request->address;
        // $company->website = $request->website;
        // $company->active = false;
        // // $company->admin = $request->data['admin']['id'];
        // $company->user_id = 0;
        // if ($company->save()) {
        //     // return $request->all();
        //     $user = new User;
        //     // $password = $request->form['password'];
        //     $password = $this->generateRandomString();
        //     $password_hash = Hash::make($password);
        //     // $user->name = $request->name;
        //     $user->password = $password_hash;
        //     $user->name = $request->user_name;
        //     $user->email = $request->user_email;
        //     $user->phone = $request->user_phone;
        //     $user->address = $request->user_address;
        //     $user->website = $request->user_website;
        //     $user->company_id = $company->id;
        //     $user->save();
        //     $user->assignRole('Store Admin');
        //     // $user->givePermissionTo($request->selected);
        //     // $user->notify(new SignupActivate($user, $password));
        //     // $message = 'a new vendoe';
        //     // Mail::send('mail.vendor', function ($message) {
        //     //     $message->from('jimlaravel@gmail.com', 'Jimmy');
        //     //     $message->sender('jimkiarie8@gmail.com', 'John Doe');
        //     //     $message->to('jimlaravel@gmail.com', 'John Doe');
        //     //     $message->subject('New vendor');
        //     // });
        //     Mail::send(new VendorMail($user, $password));
        //     return $user;
        // }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function vendor_company(Request $request)
    {
        // return $request->all();
        // $this->validate($request, [
        //     'company_name' => 'required',
        //     'email' => 'required|email',
        //     'phone' => 'required|numeric',
        //     'address' => 'required',
        // ]);
        $company = new Company;
        $company->company_name = $request->company_name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->active = false;
        // $company->admin = $request->data['admin']['id'];
        $company->user_id = 0;
        $company->save();
        return $company;
    }

    public function vendor_logo(Request $request, $id)
    {
        $upload = Company::find($request->id);
        if ($request->hasFile('image')) {
            // return('test');
            // $imagename = time() . $request->image->getClientOriginalName();
            // $request->image->storeAs('public/test', $imagename);
            $img = $request->image;
            // $image_path = ;
            if (!empty($upload->logo)) {
                $image_file_arr = explode('/', $upload->logo);
                // dd($image_file_arr);
                $image_file = $image_file_arr[3];

                if (File::exists('storage/logo/' . $image_file)) {
                    $image_path = 'storage/logo/' . $image_file;
                    File::delete($image_path);
                }
                $imagename = Storage::disk('public')->put('logo', $img);
            } else {
                $imagename = Storage::disk('public')->put('logo', $img);
            }

            $imgArr = explode('/', $imagename);
            $image_name = $imgArr[1];
            $upload->logo = env('APP_URL') . '/storage/logo/' . $image_name;
            // $upload->image = '/storage/logo/'.$image_name;
            $upload->save();
            return $upload;
            // $imagename =  Storage::disk('uploads')->put('logo', $img);
        }
        return;
    }
}
