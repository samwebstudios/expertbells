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
        return redirect()->route('user.dashboard');
    }
    public function userlogout(){
        \Session::flush('success','Thanyou for coming.');        
        \Auth::logout();
        return redirect()->route('login');
    }
}