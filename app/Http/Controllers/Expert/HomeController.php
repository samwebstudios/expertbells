<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('expert.dashboard');
    }
    public function editprofile(){
        $countries = \App\Models\Country::where('status',1)->get();
        return view('expert.editprofile',compact('countries'));
    }
    public function account(){
        $expert = \App\Models\Expert::find(expertinfo()->id);
        return view('expert.account',compact('expert'));
    }
    public function addwhatexpect(){
        return view('expert.whatexpect');
    }
    public function otherinformation(){
        $qualifications = \App\Models\Qualification::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $workings = \App\Models\Working::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $expertise = \App\Models\Expertise::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $languages = \App\Models\Language::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        return view('expert.otherinformation',compact('qualifications','workings','expertise','languages','industries'));
    }
}
