<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index(){
        $lists = \App\Models\Expert::latest()->paginate(10);
        return view('admin.experts.lists',compact('lists'));
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\Expert::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function status(Request $request){
        $data =  \App\Models\Expert::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\Expert::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\Expert::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
    public function topstatus(Request $request){
        $data =  \App\Models\Expert::find($request->id);
        $data->top_expert = $request->status;
        $data->save();
    }
}
