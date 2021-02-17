<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userlist;
use App\User;
use App\Coupon;
class UserlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userlist = Userlist::all();
        return view('redeemeduserlist',['userlist'=>$userlist]);
    }

    public static function getCustomerName($id){
        $user = User::find($id);
        $username = $user->firstname . " " . $user->lastname;
        return $username;
    }

    public static function getCouponSeller($id){
        $coupon = Coupon::find($id);
        if(isset($coupon->logo)){
            $couponseller = $coupon->logo;
        }else{
            $couponseller = "";
        }
        return $couponseller;
    }

    public static function getCouponCode($id){
        $coupon = Coupon::find($id);
        $couponcode = $coupon->couponcode;
        return $couponcode;
    }

    public function edituserlist($id)
    {
        $userlist = Userlist::find($id);
        $coupon = Coupon::find($userlist->couponid);
        $user = User::find($userlist->customerid);
        return view('edituserlist',['userlist'=>$userlist, 'user'=>$user, 'coupon'=>$coupon]);
    }

    public function viewuser($id)
    {
        $userlist = Userlist::find($id);
        $coupon = Coupon::find($userlist->couponid);
        $user = User::find($userlist->customerid);
        return view('viewuser',['userlist'=>$userlist, 'user'=>$user, 'coupon'=>$coupon]);
    }
    
    public function redeemcoupon(Request $request)
    {   
        $req = $request->all();
        $id = $req["id"];
        $uid = $req["uid"];
        $date = $req["date"];

        $user = User::find($uid);

        if( $user['status'] == "0"){
            $user = array(
                "error" => "Your account has been blocked, please contact admin"
            );
            return response()->json($user, 200);
        }

        $coupon = Coupon::find($id);
        // $coupon->status = "1";
        // $coupon->save();

        Userlist::create([
            'purchasedon' => $date,
            'customerid' => $uid,
            'couponid' => $id
        ]);
      
        return $coupon;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
