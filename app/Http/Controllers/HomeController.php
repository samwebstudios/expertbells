<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{    
    public function index(){
        return view('home');
    }
    public function experts($experid=null){
        $experts = \App\Models\Expert::where('is_publish',1);
        $experts = $experts->orderBy('sequence','ASC');
        if(!empty($experid)){
            $experts = $experts->where('user_id',$experid);
            $experts = $experts->first();
            if(empty($experts)){ abort(404); }
            $requestsection = \App\Models\Cms::find(1);
            $giftsection = \App\Models\Cms::find(2);
            $notesection = \App\Models\Cms::find(3);
            return view('expert-intro',compact('experts','requestsection','giftsection','notesection'));
        }else{
            $experts = $experts->paginate(40);
            return view('experts',compact('experts'));
        }
    }
}
