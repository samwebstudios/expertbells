<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function expertlogout(){
        \Session::flush('success','Thanyou for coming.');        
        \Auth::guard('expert')->logout();
        return redirect()->route('login');
    }
    public function removewhatexpect(Request $r){
        $whatexpects = \App\Models\WhatExpect::find($r->removeid);
        $whatexpects->delete();
        return response()->json([
            'success' => 'Data removed!'
        ]);
    }
    public function getwhatexpect(){
        $whatexpects = \App\Models\WhatExpect::where(['is_publish'=>1,'expert_id'=>expertinfo()->id])->orderBy('sequence','ASC')->get(); 
        $Html ='<ul class="prolist AllDetail">';
        foreach($whatexpects as $key => $whatexpect):
            $Html .='<li class="d-block listbox">';
                $Html .='<strong>'.($key + 1).'. '.$whatexpect->description.'</strong>';
                $Html .='<a href="javascript:void(0)" class="ms-3 p-2 py-1 rounded removeexpect" data-bs-removeid="'.$whatexpect->id.'"><i class="fal fa-trash-alt"></i></a>';
            $Html .='</li>';
        endforeach;
        $Html .='</ul>';
        return response()->json([
            'html' => $Html
        ]);
    }
    public function countrystates(Request $r){
        $states = \App\Models\State::where(['status'=>1,'country_id'=>$r->country])->get();
        $Html='<option value="">Choose State</option>';
        foreach($states as $state){
            $Html .='<option value="'.$state->id.'" '.(expertinfo()->state==$state->id?'selected':'').' >'.$state->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function statecities(Request $r){
        $cities = \App\Models\City::where(['status'=>1,'state_id'=>$r->state])->get();
        $Html='<option value="">Choose City</option>';
        foreach($cities as $city){
            $Html .='<option value="'.$city->id.'" '.(expertinfo()->city==$city->id?'selected':'').' >'.$city->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function savewhatexpect(Request $r){
        foreach($r->description as $description):
            $data = new \App\Models\WhatExpect();
            $data->description = $description;
            $data->expert_id = expertinfo()->id;
            $data->is_publish = 1;
            $data->sequence = (\App\Models\WhatExpect::max('sequence') + 1);
            $data->save();
        endforeach;
        return response()->json([
            'success'=>'Data Saved!'
        ]);
    }
    public function emailnotification(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->email_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function mobilenotification(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->mobile_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function profilevisibility(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->profile_visibility = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function videovisibility(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->video_visibility = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function deleteaccount(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->delete();
        if($r->permission==0){ $message='Account Restore Deleted';}
        if($r->permission==1){ $message='Account Deleted';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function updateotherinformation(Request $r){
        $r->validate([
            'qualification' => 'required',
            'currently_working' => 'required',
            'expertises' => 'required',
            'languages' => 'required',
            'industries' => 'required',
            'bio' => 'required',
            'strengths' => 'required',
        ]); 
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->linkedin = $r->linkedin ;
        $data->highest_qualification = $r->qualification ;
        $data->your_expertise = $r->expertises ;
        $data->fluent_language = json_encode($r->languages) ;
        $data->suitable_industry = json_encode($r->industries) ;
        $data->your_strength = $r->strengths ;
        $data->bio = $r->bio ;
        $data->currently_working_as = $r->currently_working ;
        $data->save();
        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    public function updateprofile(Request $r){
        $r->validate([
            'profile_name' => 'required|max:255|string',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:experts,email,'.expertinfo()->id,
            'mobile' => 'required|min:8|unique:experts,mobile,'.expertinfo()->id,
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        $data = \App\Models\Expert::find(expertinfo()->id); 
        $data->name = $r->profile_name;
        $data->email = $r->email;
        $data->mobile = $r->mobile;
        $data->ccode = $r->ccode;
        $data->country = $r->country;
        $data->state = $r->state;
        $data->city = $r->city;
        if(!empty($r->profile)){
            $extension =  $r->profile->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/expert/',$r->profile);
            }else{
                $FileName = autoheight('uploads/expert/',476,$r->profile);
            }
            $data->profile = $FileName;
            if(!empty(expertinfo()->profile)){
                if(file_exists(public_path('uploads/expert/'.expertinfo()->profile))){
                    unlink(public_path('uploads/expert/'.expertinfo()->profile));
                }
                if(file_exists(public_path('uploads/expert/jpg/'.expertinfo()->profile.'.jpg'))){
                    unlink(public_path('uploads/expert/jpg/'.expertinfo()->profile.'.jpg'));
                }
                if(file_exists(public_path('uploads/expert/'.expertinfo()->profile.'.webp'))){
                    unlink(public_path('uploads/expert/'.expertinfo()->profile.'.webp'));
                }
            }
        }
        $data->save();
        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    public function savevideo(Request $r){
        $r->validate([
            'title' => 'required',
            'video_type' => 'required',
            'video_url' => 'required_if:video_type,==,1',
            'video' => 'required_if:video_type,==,2',
            'video_image' => 'required_if:video_type,==,2',
            'industries' => 'required',
            'description' => 'required',
        ],[
            'video_url.required_if' => 'The video url field is required.',
            'video.required_if' => 'The video field is required.',
            'video_image.required_if' => 'The video image field is required.'
        ]);

        if(!empty($r->video_image)){
            $extension =  $r->video_image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/expert/video/',$r->video_image);
            }else{
                $FileName = autoheight('uploads/expert/video/',480,$r->video_image);
            }
        }
        if(!empty($r->video)){
            $VideoName = directFile('uploads/expert/video/',$r->video);
        }

        $data = new \App\Models\ExpertVideo();
        $data->title = $r->title;
        $data->expert_id = expertinfo()->id;
        $data->video_type = $r->video_type;
        $data->video_url = $r->video_url ?? '';
        $data->video = $VideoName ?? '';
        $data->video_image = $FileName ?? '';
        $data->industries = (!empty($r->industries) ? json_encode($r->industries) : '' );
        $data->description = $r->description;
        $data->is_publish = 1;
        $data->sequence = (\App\Models\ExpertVideo::max('sequence') + 1);
        $data->save();
        return response()->json([
            'success'=>'Video Uploaded!'
        ]);
    }
    public function updatevideo(Request $r){
        $r->validate([
            'title' => 'required',
            'video_type' => 'required',
            'video_url' => 'required_if:video_type,==,1',
            'industries' => 'required',
            'description' => 'required',
        ],[
            'video_url.required_if' => 'The video url field is required.',
            'video.required_if' => 'The video field is required.',
            'video_image.required_if' => 'The video image field is required.'
        ]);

        if(!empty($r->video_image)){
            $extension =  $r->video_image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/expert/video/',$r->video_image);
            }else{
                $FileName = autoheight('uploads/expert/video/',480,$r->video_image);
            }
        }
        if(!empty($r->video)){
            $VideoName = directFile('uploads/expert/video/',$r->video);
        }

        $data = \App\Models\ExpertVideo::find($r->preid);
        $data->title = $r->title;
        $data->video_type = $r->video_type;
        $data->video_url = $r->video_url ?? '';
        if(!empty($r->video)){
            $data->video = $VideoName ?? '';
        }
        if(!empty($r->video_image)){
            $data->video_image = $FileName ?? '';
        }
        $data->industries = (!empty($r->industries) ? json_encode($r->industries) : '' );
        $data->description = $r->description;
        $data->save();
        return response()->json([
            'success'=>'Video Updated!'
        ]);
    }
}
