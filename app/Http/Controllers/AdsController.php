<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads;
use App\User;
class AdsController extends Controller
{
    public function createadspage()
    {
        $users = User::where('type','=','user')->get();
        return view('createad',['users'=>$users]);
    }

    public function createads()
    {
        $request = request();
        $data = $request->all();
        if($request->hasFile('logo')){
            $allowedExtensions = ["jpg" , "jpeg", "png"]; 
            $adsImage = $request->file('logo');
            $uploadFileExtension =  $adsImage->getClientOriginalExtension();
            if (in_array($uploadFileExtension , $allowedExtensions)){
                $adsImageSaveAsName = time() .  $data['title'] . "-ads." . $uploadFileExtension;
                $upload_path = 'ads_images/';
                $adsImage_url = $upload_path . $adsImageSaveAsName;
                $success = $adsImage->move($upload_path, $adsImageSaveAsName);
            }else{
                return redirect()->back()->with("error","Please upload a valid image with extensions JPEG, JPG & PNG.")->withInput();
            }
        }else{
            return redirect()->back()->with("error","Please upload an image.")->withInput();
        }

        if(isset($data['userlist'])){
            $userlist =implode(",",$request->input('userlist'));
        }else{
            $userlist = "all";
        }

        Ads::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'logo' => $adsImage_url,
            'selecteduser' => $userlist,
        ]);
        return redirect()->back()->with("success","Advertisement Created Successfully.");
    }

    public function adslist()
    {
        $ads = Ads::all();
        return view('adlist',['ads'=>$ads]);
    }

    public function getads(Request $request)
    {
        $req = $request->all();
        $id = $req["id"];
        $ads = Ads::all();
        
        foreach ($ads as $ad ){
            $ad["selected"] = "0";
            $selectedusers = explode(',', $ad->selecteduser);
            foreach ($selectedusers as $selecteduser ){
                if($selecteduser == $id || $selecteduser == "all"){
                    $ad["selected"] = "1";
                }
            }
            
            $ad["path"] = url("/".$ad['logo']);
        }  
        
        foreach($ads as $ad)
        {
            if($ad["selected"] == "1"){
                $filtered[] = $ad->toArray();
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

    public function viewad($id)
    {   
        $ad = Ads::find($id);
        return view('viewad',['ad'=>$ad]);
    }

    public function editad($id)
    {   
        $ad = Ads::find($id);
        $user = User::where('type','=','user')->get();
        return view('editad',['ad'=>$ad, 'user'=>$user]);
    }
   

    protected function updatead(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('logo')){
            $allowedExtensions = ["jpg" , "jpeg", "png"]; 
            $adsImage = $request->file('logo');
            $uploadFileExtension =  $adsImage->getClientOriginalExtension();
            if (in_array($uploadFileExtension , $allowedExtensions)){
                $adsImageSaveAsName = time() .  $data['title'] . "-ads." . $uploadFileExtension;
                $upload_path = 'ads_images/';
                $adsImage_url = $upload_path . $adsImageSaveAsName;
                $success = $adsImage->move($upload_path, $adsImageSaveAsName);
            }else{
                return redirect()->back()->with("error","Please upload a valid image with extensions JPEG, JPG & PNG.")->withInput();
            }
        }


        if(isset($data['userlist'])){
            $userlist =implode(",",$request->input('userlist'));
        }else{
            $userlist = "all";
        }
        
        $id = $data['id'];

        $ad = Ads::find($id);

        if ($ad->count() == 0) {
            return redirect()->back()->with("error","Something went wrong.")->withInput();
        }

        if($request->hasFile('logo')){
            $ad->title = $data['title'];
            $ad->description = $data['description'];
            $ad->selecteduser = $userlist;
            $ad->logo = $adsImage_url;
            $ad->save();
        }else{
            $ad->title = $data['title'];
            $ad->description = $data['description'];
            $ad->selecteduser = $userlist;
            $ad->save();
        }

        return redirect()->back()->with("success","Ad Updated Successfully.");
    }

    public function deletead(Request $request)
    {   
        $request = request();
        $data = $request->all();
        $id = $data['deleteid'];
        Ads::destroy($id);
        return redirect()->back()->with("success", "Ad Deleted Successfully.");
    }


}

