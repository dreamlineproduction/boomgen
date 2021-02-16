<?php

namespace App\Http\Controllers;
use App\User;
use App\Coupon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
        $usercount = User::where('type','=','user')->count();   
        $couponCount = Coupon::count();  
        $redeemedCouponCount = Coupon::where('status','=','1')->count();
        $coupons = Coupon::orderBy('created_at', 'desc')->get()->take(5);
        $users = User::where('type','=','user')->orderBy('created_at', 'desc')->get()->take(5);
        return view('home',['users'=>$users, 'coupons'=>$coupons, 'usercount'=>$usercount, 'couponCount'=>$couponCount, 'redeemedCouponCount'=>$redeemedCouponCount]);
    }

}
