<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads;
class AdsController extends Controller
{
    public function createadspage()
    {
        return view('createad');
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


        Ads::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'logo' => $adsImage_url,
        ]);
        return redirect()->back()->with("success","Advertisement Created Successfully.");
    }

    public function adslist()
    {
        $ads = Ads::all();
        return view('adlist',['ads'=>$ads]);
    }

    public function getads()
    {
        $ads = Ads::all();
        foreach ($ads as $ad ){
            $ad["path"] = url("/".$ad['logo']);
        }
        return response()->json($ads, 200);
    }
}

