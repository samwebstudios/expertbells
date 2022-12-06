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
}
