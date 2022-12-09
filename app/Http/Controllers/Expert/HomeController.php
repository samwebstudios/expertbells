<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('expert.dashboard');
    }

    /// PROFILE
    public function editprofile(){
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty(expertinfo()->ccode)){ $ccode = $ccode->where('phonecode',expertinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
            else{
                $ccode = $ccode->where('phonecode',91);
            }
        }
        $ccode = $ccode->first();
        $countries = \App\Models\Country::where('status',1)->get();
        return view('expert.editprofile',compact('countries','ccode'));
    }
    public function account(){
        $expert = \App\Models\Expert::find(expertinfo()->id);
        $currentUserInfo = \Location::get(myipaddress());
        $countries = \App\Models\Country::where('status',1);
        if(!empty(expertinfo()->ccode)){ $countries = $countries->where('phonecode',expertinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $countries = $countries->where('sortname',$currentUserInfo->countryCode); }
            else{
                $countries = $countries->where('phonecode',91);
            }
        }
        $countries = $countries->first();
        return view('expert.account',compact('expert','countries'));
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

    /// VIDOES
    public function videos(){
        $videos = \App\Models\ExpertVideo::where('expert_id',expertinfo()->id)->orderBy('sequence','DESC')->get();        
        return view('expert.videos',compact('videos'));
    }
    public function addvideo(){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        return view('expert.addvideos',compact('industries'));
    }
    public function editvideo(Request $r){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $videos = \App\Models\ExpertVideo::find($r->id);    
        if(empty($videos)){ return "This video is not exists"; }    
        return view('expert.editvideos',compact('industries','videos'));
    }
    public function removevideo($id){
        $videos = \App\Models\ExpertVideo::find($id);
        if(!empty($videos->video)){
            if(file_exists(public_path('uploads/expert/video/'.$videos->video))){
                unlink(public_path('uploads/expert/video/'.$videos->video));
            }
        }
        if(!empty($videos->video_image)){
            if(file_exists(public_path('uploads/expert/video/'.$videos->video_image))){
                unlink(public_path('uploads/expert/video/'.$videos->video_image));
            }
            if(file_exists(public_path('uploads/expert/video/jpg/'.$videos->video_image.'.jpg'))){
                unlink(public_path('uploads/expert/video/jpg/'.$videos->video_image.'.jpg'));
            }
            if(file_exists(public_path('uploads/expert/video/'.$videos->video_image.'.webp'))){
                unlink(public_path('uploads/expert/video/'.$videos->video_image.'.webp'));
            }
        }
        $videos->delete();
        return back()->with('success','Video Removed!');
    }

    ///SLOTS
    public function slots(){
        $times = \App\Models\SlotTime::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $booktimes = \App\Models\SlotCharge::where(['expert_id'=>expertinfo()->id])->get();
        return view('expert.slots',compact('times','booktimes'));
    }
    public function removeavailability($id){
        $videos = \App\Models\SlotAvailability::find($id);
        $videos->delete();
        return back()->with('success','Availability Removed!');
    }
}
