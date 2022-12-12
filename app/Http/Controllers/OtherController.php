<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function sendemailotp(Request $request){
        $request->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users',
        ],[
            'email.required' => 'email field is required.'
        ]);
        $otp = generateotp(4);
        $html = '';
        $html .= '<p>Your email verification code is '.$otp.'. please don`t share this otp to others.</p>';
        $body = ['message'=>$html ];
        \Mail::to($request->email)->send(new \App\Mail\SendEmailOtp($body));
        return response()->json([
            'success' => 'OTP sended on you email address. please check your inbox.',
            'otp'=>$otp
        ]);
    }
    public function checkbookingmobile(Request $request){
        $request->validate([
            'mobile' => 'required|min:8',
        ],[
            'mobile.required' => 'mobile field is required.'
        ]);
        $html = '';
        $otp = generateotp(4);
        $html .= '<p>Your email verification code is '.$otp.'. please don`t share this otp to others.</p>';
        return response()->json([
            'success' => 'OTP sended on you mobile.',
            'otp'=>$otp
        ]);
    }
    public function bookingloginprocess(Request $request){
        $data = \App\Models\User::where('mobile',$request->mobile)->first();
        $redirect = route('payment',['booking'=>$request->booking]);
        if(empty($data)){
            $data = new \App\Models\User();
            $data->mobile = $request->mobile;
            $data->ccode = $request->ccode;
            $data->mobile_verify = 1;
            $data->last_login = date('Y-m-d H:i:s');
            $data->save();
            $redirect = route('expertbooking2',['booking'=>$request->booking]);
        }        
        \Auth::login($data);
        return response()->json([
            'redirect' => $redirect
        ]);
    }
}
