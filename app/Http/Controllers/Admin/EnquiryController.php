<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function enquiry($type){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ return $this->BlogComment(); }
            if($type=='jobs'){  return $this->Jobs(); }
            if($type=='newsletter'){  return $this->Newsletter(); }
            if($type=='contact'){  return $this->Contact(); }
            abort(404);
        }
    }
    public function enquiryinfo($type){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ 
                $lists = \App\Models\BlogComment::find(request('id'));
                return view('admin.enquiry.commentinfo',compact('lists'));
            }
            if($type=='jobs'){
                $lists = \App\Models\JobApply::find(request('id'));
                return view('admin.enquiry.jobinfo',compact('lists'));
            }
            abort(404);
        }
    }
    public function publish($type,Request $request){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ 
                \App\Models\BlogComment::where('id',$request->id)->update(['is_publish'=>$request->status]);
            }
            if($type=='jobs'){  
                \App\Models\JobApply::where('id',$request->id)->update(['is_publish'=>$request->status]);
            }
            return response()->json([
                'success_msg' => 'Status have been updated!'
            ]);
        }
    }
    public function sequence($type,Request $request){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ 
                foreach($request->sequence as $id => $sequence){
                    $data = \App\Models\BlogComment::find($id);
                    $data->sequence = $sequence;
                    $data->save();
                }
            }
            if($type=='jobs'){ 
                foreach($request->sequence as $id => $sequence){
                    $data = \App\Models\JobApply::find($id);
                    $data->sequence = $sequence;
                    $data->save();
                }
            }
            return back()->with(['success'=>'Sequence have been updated!']);
        }
    }
    public function bulkdestory($type,Request $request){
        if(empty($type)){ abort(404); }
        else{
            if(empty($request->check)){ return back()->with(['error' => 'Please choose at least one data.']); }
            if($type=='comments'){ 
                foreach($request->check as $removeId){
                    $data = \App\Models\BlogComment::find($removeId);
                    $data->delete();
                }
            }
            if($type=='jobs'){ 
                foreach($request->check as $removeId){
                    $data = \App\Models\JobApply::find($removeId);
                    $data->delete();
                }
             }
            if($type=='contact'){ 
                foreach($request->check as $removeId){
                    $data = \App\Models\ContactInquiry::find($removeId);
                    $data->delete();
                }
             }
            if($type=='newsletter'){  
                foreach($request->check as $removeId){
                    $data = \App\Models\Newsletter::find($removeId);
                    $data->delete();
                }
            }
            return back()->with(['success'=>'Data have been removed!']);
        }
    }
    public function BlogComment(){
        $lists = \App\Models\BlogComment::latest()->paginate(20);
        return view('admin.enquiry.comments',compact('lists'));
    }
    
    public function Jobs(){
        $lists = \App\Models\JobApply::latest()->paginate(20);
        return view('admin.enquiry.job',compact('lists'));
    }
    public function Contact(){
        $lists = \App\Models\ContactInquiry::latest()->paginate(20);
        return view('admin.enquiry.contact',compact('lists'));
    }
    public function Newsletter(){
        $lists = \App\Models\Newsletter::latest()->paginate(20);
        return view('admin.enquiry.newsletter',compact('lists'));
    }
}