<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\User;
use Response;
use \App\Mail\Enquiry;
use Auth;
use Mail;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {   
        $users = User::where("type", "user")->get();
        return view('userlist',['users'=>$users]);
    }
    
    public function manageaccountpage(Request $request)
    {   
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('manageaccount',['user'=>$user]);
    }

    public function edituser($id)
    {   
        $user = User::find($id);
        return view('edituser',['user'=>$user]);
    }
    
    public function blockuser(Request $request)
    {   
        $request = request();
        $data = $request->all();
        $id = $data['blockid'];
        $user = User::find($id);
        if($user->status == "1"){
            $user->status = "0";
            $message = "User Blocked Successfully.";
        }else{
            $user->status = "1";
            $message = "User Unblocked Successfully.";
        }
        $user->save();
        return redirect()->back()->with("success",$message);
    }

    public function deleteuser(Request $request)
    {   
        $request = request();
        $data = $request->all();
        $id = $data['deleteid'];
        User::destroy($id);
        return redirect()->back()->with("success", "User Deleted Successfully.");
    }

    public function createuserpage()
    {   
        return view('createuser');
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phonenumber' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'string|max:255',
            'state' => 'required|string|max:255',
        ]);
    }

    protected function createuser(Request $request)
    {
        $request = request();
        if($request->hasFile('profilepicture')){
            $allowedExtensions = ["jpg" , "jpeg", "png"]; 
            $couponImage = $request->file('profilepicture');
            $uploadFileExtension =  $couponImage->getClientOriginalExtension();
            if (in_array($uploadFileExtension , $allowedExtensions)){
                $couponImageSaveAsName = time() . Auth::id() . "-profile." . $uploadFileExtension;
                $upload_path = 'profile_images/';
                $couponImage_url = $upload_path . $couponImageSaveAsName;
                $success = $couponImage->move($upload_path, $couponImageSaveAsName);
            }else{
                return redirect()->back()->with("error","Please upload a valid image with extensions JPEG, JPG & PNG.")->withInput();
            }
        }else{
            $upload_path = 'profile_images/';
            $couponImage_url = $upload_path . "default_user.jpeg";
        }

        $rules = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phonenumber' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'type' => 'string|max:100',
        ];
        
        $data = $request->all();
         
        $input     = $request->only('firstname', 'lastname', 'username', 'email', 'password', 'phonenumber', 'address1', 'state', 'zip');
        $validator = Validator::make($input, $rules);
        
        
        if(strlen($data['password']) < 6){
            return redirect()->back()->with("error","Password length should be minimum 6 characters.")->withInput();
        }
        
        if ($validator->fails()) {
            return redirect()->back()->with("error","Email already registered.")->withInput();
        }
        
       
        User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'image' => $couponImage_url,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phonenumber' => $data['phonenumber'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'type' => $data['type'],
            'status' => "1",
            'otp' => ""

        ]);
        return redirect()->back()->with("success","User Created Successfully.");
    }
    
    protected function updateuser(Request $request)
    {
        if($request->hasFile('profilepicture')){
            $allowedExtensions = ["jpg" , "jpeg", "png"]; 
            $couponImage = $request->file('profilepicture');
            $uploadFileExtension =  $couponImage->getClientOriginalExtension();
            if (in_array($uploadFileExtension , $allowedExtensions)){
                $couponImageSaveAsName = time() . Auth::id() . "-profile." . $uploadFileExtension;
                $upload_path = 'profile_images/';
                $couponImage_url = $upload_path . $couponImageSaveAsName;
                $success = $couponImage->move($upload_path, $couponImageSaveAsName);
            }else{
                return redirect()->back()->with("error","Please upload a valid image with extensions JPEG, JPG & PNG.")->withInput();
            }
        }

        $rules = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
        ];
        
        $data = $request->all();
        
        $id = $data['id'];

        $user = User::find($id);

        if($data['email'] != $user->email){
            $rules1 = [
                'email' => 'required|string|email|max:255|unique:users',
            ];
            $input1     = $request->only('email');
            $validator1 = Validator::make($input1, $rules1);
            if ($validator1->fails()) {
                return redirect()->back()->with("error","Email already exist.")->withInput();
            }
        }
        
        $input     = $request->only('firstname', 'lastname', 'username', 'phonenumber', 'address1', 'address2', 'state', 'zip');
        $validator = Validator::make($input, $rules);
        
        

        if ($validator->fails()) {
            return redirect()->back()->with("error","Something went wrong.")->withInput();
        }

        if ($user->count() == 0) {
            $user = array(
                "error" => "User not found"
            );
            return redirect()->back()->with("error","Something went wrong.")->withInput();
        }

        if($request->hasFile('profilepicture')){
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->phonenumber = $data['phonenumber'];
            $user->address1 = $data['address1'];
            $user->address2 = $data['address2'];
            $user->state = $data['state'];
            $user->zip = $data['zip'];
            $user->email = $data['email'];
            $user->image = $couponImage_url;
            $user->save();
        }else{
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->phonenumber = $data['phonenumber'];
            $user->address1 = $data['address1'];
            $user->address2 = $data['address2'];
            $user->state = $data['state'];
            $user->zip = $data['zip'];
            $user->email = $data['email'];
            $user->save();
        }

        return redirect()->back()->with("success","User Updated Successfully.");
    }

    protected function updateadmin(Request $request)
    {
        if($request->hasFile('profilepicture')){
            $allowedExtensions = ["jpg" , "jpeg", "png"]; 
            $couponImage = $request->file('profilepicture');
            $uploadFileExtension =  $couponImage->getClientOriginalExtension();
            if (in_array($uploadFileExtension , $allowedExtensions)){
                $couponImageSaveAsName = time() . Auth::id() . "-profile." . $uploadFileExtension;
                $upload_path = 'profile_images/';
                $couponImage_url = $upload_path . $couponImageSaveAsName;
                $success = $couponImage->move($upload_path, $couponImageSaveAsName);
            }else{
                return redirect()->back()->with("error","Please upload a valid image with extensions JPEG, JPG & PNG.")->withInput();
            }
        }

        $rules = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ];
        
        $data = $request->all();
        
        $id = $data['id'];
        
        $input     = $request->only('firstname', 'lastname', 'email');
        $validator = Validator::make($input, $rules);
        
        $user = User::find($id);

        if ($validator->fails()) {
            return redirect()->back()->with("error","Something went wrong.")->withInput();
        }

        if ($user->count() == 0) {
            $user = array(
                "error" => "User not found"
            );
            return redirect()->back()->with("error","Something went wrong.")->withInput();
        }

        if($request->hasFile('profilepicture')){
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->image = $couponImage_url;
            $user->save();
        }else{
            $user->firstname = $data['firstname'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->save();
        }

        return redirect()->back()->with("success","User Updated Successfully.");
    }


    public function loginpage()
    {   
        $users = User::all();
        return view('login',['users'=>$users]);
    }

    public function changepasswordpage()
    {   
        return view('changepassword');
    }
    
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('currentPassword'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('currentPassword'), $request->get('newPassword')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        if($request->get('newPassword') != $request->get('confirmPassword')){
            return redirect()->back()->with("error","New Password and confirmed password are not same.");
        }

        $rules = [
            'currentPassword' => 'required',
            'newPassword' => 'required|string|min:6',
        ];

        $input     = $request->only('currentPassword', 'newPassword');
        $validator = Validator::make($input, $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->with("error","Please enter a valid password with minimum 6 characters.");
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('newPassword'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }
    
    public function loginWeb(Request $request)
    {   
        
        $req = $request->all();
        $email = $req["email"];
        $password = $req["password"];

        if($email == "" || $password == ""){
           return view('login');
        }

        $user = User::where("email",$email)->get();
        if ($user->count() == 0) {
           return view('login');
        }
        if (\Hash::check($password, $user[0]->password)) {
             return view('home');
        } else {
            return view('login');
        }
        
        
//         $username = $request->input('username');
// 		$password = $request->input('password');
//         if (auth()->guard('admin')->attempt(['username' => $username, 'password' => $password]))
// 		{
// 			return Redirect::to('admin'.'/home')->with('message', 'Welcome ! Your are logged in now.');
// 		}
// 		else
// 		{
// 			return Redirect::to('admin'.'/login')->with('error', 'Username password not match')->withInput();
// 		}
    }
    
    
    public function login(Request $request) {
        // $this->assignHeaders();
        $req = $request->all();
        $email = $req["email"];
        $password = $req["password"];
        
        if($email == "" || $password == ""){
            $user = array(
                "error" => "credentials are wrong"
            );
            return response()->json($user, 200);
        }

        $user = User::where("email",$email)->get();

        if ($user->count() == 0) {
            $user = array(
                "error" => "credentials are wrong"
            );
            return response()->json($user, 200);
        }
        
        if($user[0]->type == "admin"){
            $user = array(
                "error" => "User not registered"
            );
            return response()->json($user, 200);
        }
        
        if (\Hash::check($password, $user[0]->password)) {
            $user[0]->path = url("/".$user[0]->image);
            return response()->json($user, 200);
        } else {
            $user = array(
                "error" => "credentials are wrong"
            );
            return response()->json($user, 200);
        }
    }

    public function forgotpassword(Request $request) {
        // $this->assignHeaders();
        $req = $request->all();
        $email = $req["email"];

        $user = User::where("email",$email)->get();

        $id = $user[0]->id;

        if ($user->count() == 0) {
            $user = array(
                "error" => "Email doesn't exist, Please enter a valid email or contact admin to register"
            );
            return response()->json($user, 200);
        }
        
        if($user[0]->type == "admin"){
            $user = array(
                "error" => "User not registered"
            );
            return response()->json($user, 200);
        }

        if( $user[0]->status == "0"){
            $user = array(
                "error" => "Your account has been blocked, please contact admin"
            );
            return response()->json($user, 200);
        }

        $otp = [
            'user_code' => mt_rand(100000,999999)
        ];

        $user = User::find($id);
        $user->otp = $otp['user_code'];
        $user->save();

        Mail::send('email', ['otp' => $otp['user_code']], function($message) use ($email){
            $message->to($email)->subject('Reset Password');
            $message->from(config('mail.username'), 'Admin');
        });
    
        if (Mail::failures()) {
            $error = array(
                "error" => "Something went wrong, please try again later"
            );
            return response()->json($error, 200);
        }

        return response()->json([ 'message' => "Email Sent Successfully" ]);
        // $this->validateEmail($request);

        // // We will send the password reset link to this user. Once we have attempted
        // // to send the link, we will examine the response then see the message we
        // // need to show to the user. Finally, we'll send out a proper response.
        // $response = $this->broker()->sendResetLink(
        //     $request->only('email')
        // );

        // return $response == Password::RESET_LINK_SENT
        //     ? response()->json(['status' => 'Success','message' => 'Reset Password Link Sent'],201)
        //     : response()->json(['status' => 'Fail','message' => 'Reset Link Could Not Be Sent'],401);
        
    }

    public function verifyotp(Request $request) {
        $req = $request->all();
        $otp = $req["otp"];
        $email = $req["email"];
        $users = User::where("email", $email)->get();

        $id = $users[0]->id;

        $user = User::find($id);
        
        if( $users[0]->status == "0"){
            $user = array(
                "error" => "Your account has been blocked, please contact admin"
            );
            return response()->json($user, 200);
        }

        if($otp['verificationcode'] != $users[0]->otp){
                $user = array(
                    "error" => "Enter valid OTP"
                );
                return response()->json($user, 200);
        }

        return response()->json("Successfully verified", 200);
    }

    public function changepasswordafterverified(Request $request) {
        $req = $request->all();
        $data = $req["password"];
        $password = $data['password'];
        $email = $req["email"];
        $users = User::where("email", $email)->get();

        $id = $users[0]->id;

        $user = User::find($id);
        
        if( $users[0]->status == "0"){
            $user = array(
                "error" => "Your account has been blocked, please contact admin"
            );
            return response()->json($user, 200);
        }
       
        $user->password = bcrypt($password);
        $user->save();

        return response()->json("Password Successfully Changed", 200);
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    public function updateprofile(Request $request) {
        $req = $request->all();
        $userid = $req["userid"];
        $email = $req["email"];
        $firstname = $req["firstname"];
        $lastname = $req["lastname"];
        $address1 = $req["address1"];
        $address2 = $req["address2"];
        $phone = $req["phone"];
        $zip = $req["zip"];
        $state = $req["state"];
        
        if($userid == "" || $email == "" || $firstname == "" || $lastname == "" || $address1  == "" || $phone == "" || $zip == "" || $state == ""){
            $user = array(
                "error" => "Fields should not be empty"
            );
            return response()->json($user, 200);
        }

        $user = User::find($userid);
        
        if( $user['status'] == "0"){
            $user = array(
                "error" => "Your account has been blocked, please contact admin"
            );
            return response()->json($user, 200);
        }
        
        if ($user->count() == 0) {
            $user = array(
                "error" => "User not found"
            );
            return response()->json($user, 200);
        }

        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->phonenumber = $phone;
        $user->address1 = $address1;
        $user->address2 = $address2;
        $user->state = $state;
        $user->zip = $zip;
        $user->save();
        return response()->json($user, 200);
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
