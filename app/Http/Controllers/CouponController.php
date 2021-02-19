<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Userlist;
use App\Coupon;
use Auth;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createcoupon()
    {
        $request = request();
        $data = $request->all();
        $datestring = $data['expirydate'];
        list($month, $day, $year) = explode('/', $datestring);
        $date = \DateTime::createFromFormat('Ymd', $year . $month . $day);
        // echo $date->format('y/m/d');
        // exit();

        if($request->hasFile('logo')){
            $allowedExtensions = ["jpg" , "jpeg", "png"]; 
            $couponImage = $request->file('logo');
            $uploadFileExtension =  $couponImage->getClientOriginalExtension();
            if (in_array($uploadFileExtension , $allowedExtensions)){
                $couponImageSaveAsName = time() . Auth::id() . "-profile." . $uploadFileExtension;
                $upload_path = 'coupon_images/';
                $couponImage_url = $upload_path . $couponImageSaveAsName;
                $success = $couponImage->move($upload_path, $couponImageSaveAsName);
            }else{
                return redirect()->back()->with("error","Please upload a valid image with extensions JPEG, JPG & PNG.")->withInput();
            }
        }else{
            return redirect()->back()->with("error","Please upload an image.")->withInput();
        }
        
        // $rules = [
        //     // 'logo' => 'required|string|max:255',
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string|max:255',
        //     'percentage' => 'required|string|max:255',
        //     'amount' => 'required|string|max:255',
        //     'expirydate' => 'required|string|max:255'
        // ];
        // $data = $request->all();
        
        if ($request->has('percentageoff')) {
            $percentValue =  $data['percentageoff'] . "%";
            $fixedvalue = "";
        }else{
            $percentValue = "" ;
            $fixedvalue = "$" . $data['fixedoff'];
        }

        if(isset($data['userlist'])){
            $userlist =implode(",",$request->input('userlist'));
        }else{
            $userlist = "all";
        }
        // $input     = $request->only( 'title', 'description', 'percentage', 'amount', 'expirydate');
        // $validator = Validator::make($input, $rules);
        
        
        // if ($validator->fails()) {
        //     return Redirect::back()->withErrors([ "Please fill all the details"])->withInput();
        // }
        

            
        $couponcode = $this->genUserCode();

        Coupon::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'percentage' => $percentValue,
            'fixed' => $fixedvalue,
            'amount' => "0",
            'expirydate' => $date,
            'logo' => $couponImage_url,
            'couponcode' => $couponcode,
            'status' => '0',
            'selecteduser' => $userlist,
        ]);
        return redirect()->back()->with("success","Coupon Created Successfully.");
    }

    private function genUserCode(){
        $this->user_code = [
            'user_code' => mt_rand(1000000000,9999999999)
        ];
    
        $rules = ['couponcode' => 'unique:coupons'];
    
        $validate = Validator::make($this->user_code, $rules)->passes();
    
        return $validate ? $this->user_code['user_code'] : $this->genUserCode();
    }
    
    public function couponpage()
    {
        $users = User::where('type','=','user')->get();
        return view('createcoupon',['users'=>$users]);
    }
    
    public function couponlist()
    {
        $coupons = Coupon::all();
        return view('coupon',['coupons'=>$coupons]);
    }

    public function getcoupons(Request $request)
    {   
        $req = $request->all();
        $id = $req["id"];
        $coupons = Coupon::all();
        $userlists = Userlist::where('customerid','=', $id)->get();
        foreach ($coupons as $coupon ){
            $coupon["selected"] = "0";
            $coupon["expired"] = "0";
            if(\Carbon\Carbon::now()->addDays(1) ->gt($coupon->expirydate)){
                $coupon["expired"] = "1";
            }
            $selectedusers = explode(',', $coupon->selecteduser);
            foreach ($selectedusers as $selecteduser ){
                if($selecteduser == $id || $selecteduser == "all"){
                    $coupon["selected"] = "1";
                    foreach($userlists as $userlist)
                    {
                        if($coupon["id"] == $userlist['couponid']){
                            $coupon["newcouponid"] = $userlist['couponid'];
                            $coupon["newCouponid"] = $coupon["id"];
                            $coupon["selected"] = "0";
                        }
                    }
                }
            }
            
            $coupon["path"] = url("/".$coupon['logo']);
        }  
        
        foreach($coupons as $coupon)
        {
            if($coupon["selected"] == "1" && $coupon["expired"] == "0"){
                $filtered[] = $coupon->toArray();
            }
        }

        if(isset($filtered)){
            return $filtered;
        }else{
            $coupon = array(
                "error" => "No more coupon available for you"
            );
            return response()->json($coupon, 200);
        }
    }

    public function getredeemedcoupons(Request $request)
    {   
        $req = $request->all();
        $id = $req["id"];
        $coupons = Coupon::all();
        $userlists = Userlist::where('customerid','=', $id)->get();
        foreach ($coupons as $coupon ){
            $coupon["selected"] = "";
            $selectedusers = explode(',', $coupon->selecteduser);
            foreach ($selectedusers as $selecteduser ){
                if($selecteduser == $id || $selecteduser == "all"){
                    $coupon["selected"] = "1";
                    foreach($userlists as $userlist)
                    {
                        if($coupon["id"] == $userlist['couponid']){
                            $coupon["newcouponid"] = $userlist['couponid'];
                            $coupon["newCouponid"] = $coupon["id"];
                            $coupon["selected"] = "0";
                        }
                    }
                }
            }
            
            $coupon["path"] = url("/".$coupon['logo']);
        }  
        
        foreach($coupons as $coupon)
        {
            if($coupon["selected"] == "0"){
                $filtered[] = $coupon->toArray();
            }
        }

        if(isset($filtered)){
            return $filtered;
        }else{
            $coupon = array(
                "error" => "You have not redeemed any coupon"
            );
            return response()->json($coupon, 200);
        }
    }

    public function getcoupondetails(Request $request)
    {   
        $req = $request->all();
        $id = $req["id"];

        $coupon = Coupon::find($id);

        if ($coupon->count() == 0) {
            $coupon = array(
                "error" => "Something went wrong"
            );
            return response()->json($coupon, 200);
        }

        $coupon["path"] = url("/".$coupon['logo']);
        return $coupon;
    }

    public function getredeemedcoupondetails(Request $request)
    {   
        $req = $request->all();
        $id = $req["id"];

        $coupon = Coupon::find($id);

        if ($coupon->count() == 0) {
            $coupon = array(
                "error" => "Something went wrong"
            );
            return response()->json($coupon, 200);
        }

        $coupon["path"] = url("/".$coupon['logo']);
        $redeemed = Userlist::where('couponid','=',$id)->get();
        $purchased = $redeemed[0]->purchasedon;
        $coupon["purchased"] = $purchased;

        return $coupon;
    }

    public function viewcoupon($id)
    {
        $coupon = Coupon::find($id);
        return view('viewcoupon',['coupon'=>$coupon]);
    }

    public function index()
    {
        //
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
