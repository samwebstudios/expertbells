<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userregister2(){
        $lists = \App\Models\Role::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-second',compact('lists'));
    }
    public function savestep2(Request $r){
        $r->validate([
            'role' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->role = $r->role ?? 0;
        $user->save();
        return redirect()->route('user.userregister3');
    }
    public function userregister3(){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-third',compact('industries'));
    }    
    public function savestep3(Request $r){
        $r->validate([
            'industry' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->industry = $r->industry ?? 0;
        $user->save();
        return redirect()->route('user.userregister4');
    }
    public function userregister4(){
        $lists = \App\Models\GetBetter::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-fourth',compact('lists'));
    }    
    public function savestep4(Request $r){
        $r->validate([
            'get_better' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->get_better = json_encode($r->get_better) ?? 0;
        $user->save();  
        return redirect()->route('user.userregister5');
    }
    public function userregister5(){
        $lists = \App\Models\HearAbout::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-fifth',compact('lists'));
    }    
    public function savestep5(Request $r){
        $r->validate([
            'hear_about_us' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->hear_about_us = json_encode($r->hear_about_us) ?? 0;
        $user->save();  
        return redirect()->route('user.userregister6');
    }
    public function userregister6(){
        return view('auth.user.user-register-sixth');
    }    
    public function savestep6(Request $r){
        $r->validate([
            'growth_challenge' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->growth_challenge = $r->growth_challenge ?? '';
        $user->complete_profile = 1;
        $user->save();

        $body = ['user'=>$user ];
        \Mail::to($user->email)->send(new \App\Mail\User\Completeprofile($body));

        return redirect()->route('user.dashboard');
    }
    public function userlogout(){
        \Session::flush('success','Thanyou for coming.');        
        \Auth::logout();
        return redirect()->route('login');
    }


    public function bookingrescheduleprocess(Request $r){
        $bookingid = $r->bookingid;
        $booking = \App\Models\SlotBook::find($bookingid)->toArray();
        $oldbooking = \App\Models\SlotBook::find($bookingid);
        $newbooking = \App\Models\SlotBook::create($booking);

        $data = \App\Models\SlotBook::find($newbooking->id);
        $data->booking_id = generatebookingno();
        $data->status = 1;
        $data->reject_date = Null;
        $data->reject_reason = Null;
        $data->booking_time = $r->booking_date.' '.explode('-',$r->timing)[1];
        $data->booking_start_time = explode('-',$r->timing)[0] ?? '';
        $data->booking_end_time = explode('-',$r->timing)[1] ?? '';
        $data->booking_date = $r->booking_date;
        $data->created_at = date('Y-m-d H:i:s');
        $data->updated_at = date('Y-m-d H:i:s');
        $data->reschedule_by = 2;
        $data->save();

        $predata = \App\Models\SlotBook::find($bookingid);
        $predata->reschedule_slot = $data->id;
        $predata->save();

        $body = ['booking' => $data,'oldbooking'=>$oldbooking,'schedule'=> $data->user->name ?? 'Customer' ];
        \Mail::to($data->expert->email)->send(new \App\Mail\Expert\Reschedule($body));
        \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\Reschedule($body));

        return response()->json([
            'success' => 'Booking has been reschedule with booking #'.$data->booking_id.'.'
        ]);
    }
    public function countrystates(Request $r){
        $states = \App\Models\State::where(['status'=>1,'country_id'=>$r->country])->get();
        $Html='<option value="">Choose State</option>';
        foreach($states as $state){
            $Html .='<option value="'.$state->id.'" '.(userinfo()->state==$state->id?'selected':'').' >'.$state->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function statecities(Request $r){
        $cities = \App\Models\City::where(['status'=>1,'state_id'=>$r->state])->get();
        $Html='<option value="">Choose City</option>';
        foreach($cities as $city){
            $Html .='<option value="'.$city->id.'" '.(userinfo()->city==$city->id?'selected':'').' >'.$city->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function emailnotification(Request $r){
        $data = \App\Models\User::find(userinfo()->id);
        $data->email_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function mobilenotification(Request $r){
        $data = \App\Models\User::find(userinfo()->id);
        $data->mobile_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function deleteaccount(Request $r){
        $data = \App\Models\User::find(userinfo()->id);
        $data->delete();
        if($r->permission==0){ $message='Account Restore Deleted';}
        if($r->permission==1){ $message='Account Deleted';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function updateotherinformation(Request $r){
        $r->validate([
            'role' => 'required',
            'industry' => 'required',
            'get_better' => 'required',
            'hear_about' => 'required',
            'challenge' => 'required'
        ]); 
        $data = \App\Models\User::find(userinfo()->id);
        $data->role = $r->role ;
        $data->industry = $r->industry ;
        $data->get_better = json_encode($r->get_better) ;
        $data->hear_about_us = json_encode($r->hear_about) ;
        $data->growth_challenge = $r->challenge ;
        $data->save();
        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    public function updateprofile(Request $r){
        $r->validate([
            'profile_name' => 'required|max:255|string',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.userinfo()->id,
            'mobile' => 'required|min:8|unique:users,mobile,'.userinfo()->id,
            'gender' => 'required',
            'dob' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ],[
            'profile_name.required'=>'profile name is required.',
            'email.required'=>'email address is required.',
            'mobile.required'=>'mobile number is required.',
            'gender.required'=>'gender is required.',
            'dob.required'=>'dob is required.',
            'country.required'=>'country is required.',
            'state.required'=>'state is required.',
            'city.required'=>'city is required.',
            'email.unique' => 'this email address already exists.',
            'mobile.unique' => 'this mobile number already exists.',
        ]);

        $data = \App\Models\User::find(userinfo()->id); 
        $data->name = $r->profile_name;
        $data->email = $r->email;
        $data->mobile = $r->mobile;
        $data->ccode = $r->ccode;
        $data->country = $r->country;
        $data->state = $r->state;
        $data->city = $r->city;
        $data->gender = $r->gender;
        $data->dob = (!empty($r->dob) ? date('Y-m-d',strtotime($r->dob)) : NULL);
        if(!empty($r->profile)){
            $extension =  $r->profile->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/user/',$r->profile);
            }else{
                $FileName = autoheight('uploads/user/',476,$r->profile);
            }
            if(!empty(userinfo()->profile)){
                if(file_exists(public_path('uploads/user/'.userinfo()->profile))){
                    unlink(public_path('uploads/user/'.userinfo()->profile));
                }
                if(file_exists(public_path('uploads/user/jpg/'.userinfo()->profile.'.jpg'))){
                    unlink(public_path('uploads/user/jpg/'.userinfo()->profile.'.jpg'));
                }
                if(file_exists(public_path('uploads/user/'.userinfo()->profile.'.webp'))){
                    unlink(public_path('uploads/user/'.userinfo()->profile.'.webp'));
                }
            }
            $data->profile = $FileName;
            
        }
        $data->save();
        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    
}
