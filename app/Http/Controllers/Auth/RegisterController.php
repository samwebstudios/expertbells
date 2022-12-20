<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller{    
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
        $this->middleware('guest');
        $this->middleware('guest:expert');
    }
    public function sendemailotp(Request $request){
        $request->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users',
        ]);
        $otp = generateotp(4);
        $body = ['otp'=>$otp ];
        \Mail::to($request->email)->send(new \App\Mail\SendEmailOtp($body));
        return response()->json([
            'success' => 'OTP sended on you email address. please check your inbox.',
            'otp'=>$otp
        ]);
    }
    public function sendmobileotp(Request $request){
        $request->validate([
            'mobile' => 'required|min:8|unique:users',
        ]);
        $otp = generateotp(4);
        $html = '';
        $html .= '<p>Your email verification code is '.$otp.'. please don`t share this otp to others.</p>';
        return response()->json([
            'success' => 'OTP sended on you mobile.',
            'otp'=>$otp
        ]);
    }
    public function userregister(){
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
        else{ $ccode = $ccode->where('phonecode',91); }
        $ccode = $ccode->first();
        return view('auth.user.user-register',compact('ccode'));
    }
    public function usersavestep1(Request $request){
        $request->validate([
            'first_name' => 'required|max:255|string',
            'mobileverify' => 'required',
            'emailverify' => 'required',
            'mobile' => 'required|min:8|unique:users',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users',
            // 'password' => 'required|same:confirm_password|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ],[
            'mobileverify.required' => 'Your mobile number is not verify.',
            'emailverify.required' => 'Your email address is not verify.',
            // 'password.regex' => "Your password should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 Special Character.",
        ]);

        $data = new \App\Models\User();
        $data->name = $request->first_name.' '.$request->last_name;
        $data->mobile = $request->mobile;
        $data->ccode = $request->ccode;
        $data->email = $request->email;
        $data->password_text = $request->password;
        $data->password = Hash::make($request->password);
        $data->email_verify = 1;
        $data->mobile_verify = 1;
        // $data->user_id = generateuserno();
        $data->last_login = date('Y-m-d H:i:s');
        $data->save();
        \Auth::login($data);
        return response()->json([
            'success' => 'Basic details saved!',
            'redirect' => route('user.userregister2')
        ]);
    }

    //// Expert
    public function expertregister(){
        $qualifications = \App\Models\Qualification::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $expertises = \App\Models\Expertise::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $languages = \App\Models\Language::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $Industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $workings = \App\Models\Working::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
        else{ $ccode = $ccode->where('phonecode',91); }
        $ccode = $ccode->first();
        return view('auth.expert.register',compact('ccode','qualifications','expertises','languages','Industries','workings'));
    }
    public function saveexpertregister(Request $request){        
        if(empty($request->name)){
            return redirect(url('expert-register').'#s1')->withErrors(['name'=>'Name filed is required.']);
        }
        if(empty($request->email)){
            return redirect(url('expert-register').'#s1')->withErrors(['email'=>'Email filed is required.']);
        }
        if(!empty($request->email)){
            $checkexpert = \App\Models\Expert::where('email',$request->email)->count();
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return redirect(url('expert-register').'#s1')->withErrors(['email'=>'Invalid email format.']);
            }elseif(!empty($checkexpert)){ 
                return redirect(url('expert-register').'#s1')->withErrors(['email'=>'This Email address is already exists in our record.']);
            }
        }
        if(empty($request->mobile)){
            return redirect(url('expert-register').'#s1')->withErrors(['mobile'=>'Mobile filed is required.']);
        }
        if(!empty($request->mobile)){
            $checkexpert = \App\Models\Expert::where('mobile',$request->mobile)->count();
            if(!empty($checkexpert)){ 
                return redirect(url('expert-register').'#s2')->withErrors(['mobile'=>'This mobile number is already exists in our record.']);
            }
        }
        if(empty($request->qualification)){
            return redirect(url('expert-register').'#s1')->withErrors(['qualification'=>'Qualification filed is required.']);
        }
        if(empty($request->expertise)){
            return redirect(url('expert-register').'#s1')->withErrors(['expertise'=>'Expertise filed is required.']);
        }
        if(empty($request->language)){
            return redirect(url('expert-register').'#s1')->withErrors(['language'=>'Fluent language filed is required.']);
        }
        if(empty($request->industry)){
            return redirect(url('expert-register').'#s1')->withErrors(['industry'=>'Industry filed is required.']);
        }
        if(empty($request->strength)){
            return redirect(url('expert-register').'#s1')->withErrors(['strength'=>'Strength filed is required.']);
        }
        if(empty($request->bio)){
            return redirect(url('expert-register').'#s1')->withErrors(['bio'=>'Bio filed is required.']);
        }
        if(empty($request->working)){
            return redirect(url('expert-register').'#s1')->withErrors(['working'=>'Currently working filed is required.']);
        }
        $password = generateexpertno();
        $data = new \App\Models\Expert();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->linkedin = $request->linkedin;
        $data->highest_qualification = $request->qualification;
        $data->your_expertise = $request->expertise;
        $data->fluent_language = (!empty($request->language) ? json_encode($request->language) : '');
        $data->suitable_industry = (!empty($request->industry) ? json_encode($request->industry) : '');
        $data->your_strength = $request->strength;
        $data->bio = $request->bio;
        $data->password = \Hash::make($password);
        $data->password_text = $password;
        $data->currently_working_as = $request->working;
        $data->sequence = (\App\Models\Expert::max('sequence') + 1);
        $data->last_login = date('Y-m-d H:i:s');
        $data->save();
        return redirect(url('login'))->with('success','Thank you for registered in our expert list.we will notified your when your account is approved by administrator.');         
    }
}
