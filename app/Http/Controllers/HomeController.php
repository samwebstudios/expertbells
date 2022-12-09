<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{    
    public function index(){
        return view('home');
    }
    public function experts($experid=null,$type=null){        
        $experts = \App\Models\Expert::where('is_publish',1);
        $experts = $experts->orderBy('sequence','ASC');
        if(!empty($experid)){
            if($type=='videos'){ return $this->expertvideos($experid);}
            $experts = $experts->where('user_id',$experid);
            $experts = $experts->first();
            if(empty($experts)){ abort(404); }
            $requestsection = \App\Models\Cms::find(1);
            $giftsection = \App\Models\Cms::find(2);
            $notesection = \App\Models\Cms::find(3);
            $slots = \App\Models\SlotAvailability::where(['is_publish'=>1,'expert_id'=>$experts->id,'day'=>date('l',strtotime('Y-m-d'))])->get();
            return view('expert-intro',compact('experts','slots','requestsection','giftsection','notesection'));
        }else{
            $experts = $experts->paginate(40);
            return view('experts',compact('experts'));
        }
    }
    public function expertvideos($experid){
        if(!empty(request('v'))){
            $experts = \App\Models\Expert::where('is_publish',1);
            $experts = $experts->where('user_id',$experid);
            $experts = $experts->first();
            if(empty($experts)){ abort(404); }
            $info = \App\Models\ExpertVideo::where(['video_id'=>request('v'),'is_publish'=>1])->first();
            if(empty($info)){ abort(404); }
            if(\App\Models\ExpertVideoClick::where(['video_id'=>$info->id,'ip'=>request()->ip()])->count()==0){
                $click = new \App\Models\ExpertVideoClick();
                $click->ip = request()->ip();
                $click->video_id = $info->id;
                $click->save();
            }
            $videos = \App\Models\ExpertVideo::where(['expert_id'=>$experts->id,'is_publish'=>1])->whereNotIn('id',[$info->id])->orderBy('sequence','DESC')->paginate(8);        
            return view('video-intro',compact('experts','videos','info'));
        }
        $experts = \App\Models\Expert::where('is_publish',1);
        $experts = $experts->where('user_id',$experid);
        $experts = $experts->first();
        if(empty($experts)){ abort(404); }
        $videos = \App\Models\ExpertVideo::where('expert_id',$experts->id)->orderBy('sequence','DESC')->paginate(45);        
        return view('expert-videos',compact('experts','videos'));
    }
}
