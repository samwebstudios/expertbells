<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function create(){
        return view('admin.dashboard');
    }
    function Change_Password(){
        return view('admin.change-password');
    }
    public function Update_Password(Request $r){
        $validated = $r->validate([
            'email_address' => 'required|email',
        ]);
        $check = \App\Models\Admin::where('email',$r->email_address)->where('id','!=',admininfo()->id)->count();
        if($check>0){ return back()->with('error', 'Sorry! this email address already taken!'); }
        if($r->password!=$r->confirm_password){
            return back()->with('error', 'Sorry! confirm password does`t match!');
        }
        $data = \App\Models\Admin::find(admininfo()->id);
        $data->name = $r->name;
        $data->email = $r->email_address;
        if(!empty($r->password)){ $data->password = bcrypt($r->password); }
        $data->save();
        return back()->with('success', 'Detail have been updated!');
    }
    public function footersection(){
        $lists = \App\Models\Setting::find(1);
        return view('admin.footer-section',compact('lists'));
    }
    public function savefooter(Request $r){
        $data = \App\Models\Setting::find($r->id);
        $data->footer_about = $r->about;
        $data->footer_support = $r->support;
        $data->save();
        return back()->with('success', 'Detail have been updated!');
    }
}
