<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function checkbookingemail(Request $request){
        $request->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.userinfo()->id,
            'name' => 'required',
        ],[
            'email.required' => 'email field is required.',
            'email.regex' => 'invalid email.',
            'email.unique' => 'this email already exists.',
            'name.required' => 'name field is required.'
        ]);
        $otp = generateotp(4);

        $data = \App\Models\User::find(userinfo()->id);
        $data->otp = $otp;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->user_id = generateuserno();
        $data->save();

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
        $bookingslot = \App\Models\SlotBook::where('booking_id',$request->booking)->first();
        if(!empty($bookingslot)){
            $slost = \App\Models\SlotBook::find($bookingslot->id);
            $slost->user_id = $data->id ?? 0;
            $slost->user_number = $data->ccode.$data->mobile ?? '';
            $slost->user_email = $data->email ?? '';
            $slost->user_name = $data->name ?? '';
            $slost->save();  
        }
          
        \Auth::login($data);
        return response()->json([
            'redirect' => $redirect
        ]);
    }
    public function couponapply(Request $request){
        $request->validate([
            'coupon' => 'required',
        ],[
            'coupon.required' => 'coupon field is required.'
        ]);
        $checkcoupon = \App\Models\Coupon::where(['is_publish'=>1,'coupon_code'=>$request->coupon])->first();
        $checkusercoupon = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'coupon_code'=>$request->coupon])->first();
        if(empty($checkcoupon)){
            return back()->withErrors(['coupon'=>'Invalid coupon code']);
        }
        if($checkcoupon->coupon_end < date('Y-m-d')){
            return back()->withErrors(['coupon'=>'Invalid coupon code']);
        }
        if($checkcoupon->coupon_start > date('Y-m-d')){
            return back()->withErrors(['coupon'=>'Invalid coupon code']);
        }
        if(!empty($checkusercoupon)){
            return back()->withErrors(['coupon'=>'You have already use this coupon.']);
        }
        $data = \App\Models\SlotBook::find($request->booking);
        $data->coupon_code = $checkcoupon->coupon_code;
        $data->coupon_discount = '';
        $data->paid_amount = '';
        $data->save();
        return back()->with('success','Coupon Applied!');
    }
    public function couponcancel($booking){
        $checkusercoupon = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'booking_id'=>$booking])->first();
        if(empty($checkusercoupon)){
            return back()->with(['error'=>'Sorry! please try again later.']);
        }
        $data = \App\Models\SlotBook::find($checkusercoupon->id);
        $data->coupon_code = '';
        $data->coupon_discount = '';
        $data->paid_amount = $data->booking_amount;
        $data->save();
        return back()->with('success','Coupon Cancelled!');
    }
    public function paymentresponse($booking){
        $checkusercoupon = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'booking_id'=>$booking])->first();
        if(empty($checkusercoupon)){
            return back()->with(['error'=>'Sorry! please try again later.']);
        }
        $data = \App\Models\SlotBook::find($checkusercoupon->id);
        $data->payment = 1;
        $data->status=1;
        $data->payment_date = date('Y-m-d H:i:s');
        $data->save();        
        
        $body = ['slot'=>$data ];
        if(!empty($data->user->email)){
            \Mail::to($data->user_email)->send(new \App\Mail\User\PaymentReceived($body));
        }
        if(!empty($data->expert->email)){

            \Mail::to($data->expert->email)->send(new \App\Mail\Expert\NewSlotBook($body));
        }
        \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\NewSlotBook($body));

        return redirect(route('paymentquery',['booking'=>$booking]))->with('success','Thank you very much. We really appreciate it.');
    }
    public function bookingquery(Request $request){
        $request->validate([
            'conversation' => 'required',
        ],[
            'conversation.required' => 'conversation query field is required.'
        ]);

        $data = \App\Models\SlotBook::find($request->booking);
        $data->query = $request->conversation;
        $data->save();
        return redirect(route('expert.schedules'))->with(['success'=>'Your query has been submited.']);
    }
}
