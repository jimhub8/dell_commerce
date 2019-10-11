<?php

namespace App\Http\Controllers;

use App\models\Coupon;
use App\models\CouponSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::take(500)->get();
        $coupons->transform(function ($coupon, $key) {
            $coupon->model = unserialize($coupon->products);
            return $coupon;
        });
        return $coupons;
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
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required|numeric',
            'disc_type' => 'required',
            'expiry_date' => 'required|date',
        ]);
        $coupon = new Coupon;
        $coupon->user_id = Auth::id();
        $coupon->company_id = Auth::user()->company_id;
        $coupon->amount = $request->amount;
        $coupon->name = $request->name;
        $coupon->disc_type = $request->disc_type;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->min_spend = $request->min_spend;
        $coupon->max_spend = $request->max_spend;
        $coupon->limit_user = $request->limit_user;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->item_limit = $request->item_limit;
        $coupon->categories = $request->categories;
        $coupon->categoriesx = $request->categoriesx;
        $coupon->ind_use = $request->ind_use;
        $coupon->products = serialize($request->model);
        $coupon->productsx = $request->productsx;
        $coupon->description = $request->description;
        $coupon->save();
        return $coupon;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return Coupon::find($coupon->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        // return $request->all();
        $coupon = Coupon::find($coupon->id);
        $coupon->name = $request->name;
        $coupon->amount = $request->amount;
        $coupon->disc_type = $request->disc_type;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->min_spend = $request->min_spend;
        $coupon->max_spend = $request->max_spend;
        $coupon->limit_user = $request->limit_user;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->item_limit = $request->item_limit;
        $coupon->categories = $request->categories;
        $coupon->categoriesx = $request->categoriesx;
        $coupon->ind_use = $request->ind_use;
        $coupon->products = serialize($request->model);
        $coupon->productsx = $request->productsx;
        $coupon->description = $request->description;
        $coupon->save();
        return $coupon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        Coupon::find($coupon->id)->delete();
    }

    public function couponApply(Request $request)
    {

        // $request->session()->forget('coupon');
        // return;
        $coupon = $request->c_value;
        $coupon_id = Coupon::where('name', $coupon)->first();
        if (empty($coupon_id)) {
            // return response()->json(['error'=>'Required Parameter Missing', 'status' => '400'], 400);
            return response()->json(['errors' => "Coupon doesn't exist", 'status' => '200'], '200');
        }
        $id = $coupon_id->id;
        $oldCoupon = Session::has('coupon') ? Session::get('coupon') : null;
        // dd($oldCoupon);
        $coupon = new CouponSession($oldCoupon);
        // return($coupon_id);
        if ($oldCoupon) {
            $coupons_av = $coupon->getCoupon();
            $cop_arr = [];
            foreach ($coupons_av as $av_coupons) {
                $cop_arr[] = $av_coupons->name;
            }
            if (in_array($coupon_id->name, $cop_arr)) {
                // return response()->json(['error'=>'Required Parameter Missing', 'status' => '400'], 400);
                return response()->json(['errors' => 'Coupon already applied', 'status' => '200'], '200');
            }
        }
        $coupon->add($coupon_id, $id);
        // dd($coupon);
        $couponA = [];
        foreach ($coupon->items as $itemsC) {
            $couponA[] = $itemsC;
        }
        $request->session()->put('coupon', $coupon);
        // dd($couponA);
        return $couponA;
        $request->session()->put('coupon', $coupon);
        // var_dump($coupon);die;
    }
}
