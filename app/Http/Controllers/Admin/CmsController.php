<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
   
    public function cmsmodal($id){
        $lists = \App\Models\Cms::find($id);
        return view('admin.cms.cms-modal',compact('lists'));
    }
    public function about(){
        $lists = \App\Models\Cms::find(4);
        return view('admin.cms.edit',compact('lists'));
    }
    public function mission(){
        $lists = \App\Models\Cms::find(5);
        return view('admin.cms.edit',compact('lists'));
    }
    public function vission(){
        $lists = \App\Models\Cms::find(6);
        return view('admin.cms.edit',compact('lists'));
    }
    public function teamcms(){
        $lists = \App\Models\Cms::find(7);
        return view('admin.cms.edit',compact('lists'));
    }   
    public function privacypolicy(){
        $lists = \App\Models\Cms::find(8);
        return view('admin.cms.edit',compact('lists'));
    }
    public function termscondition(){
        $lists = \App\Models\Cms::find(9);
        return view('admin.cms.edit',compact('lists'));
    }
    public function blogcms(){
        $lists = \App\Models\Cms::find(10);
        return view('admin.cms.edit',compact('lists'));
    }
    public function updatecms(Request $request)
    {
      if(!empty($request->image)){
          $extension =  $request->image->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName = directFile('uploads/cms/',$request->image);
          }else{
              $FileName = autoheight('uploads/cms/',600,$request->image);
          }
      }
      if(!empty($request->image2)){
          $extension =  $request->image2->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName2 = directFile('uploads/cms/',$request->image2);
          }else{
              $FileName2 = autoheight('uploads/cms/',246,$request->image2);
          }
      }

        $lists = \App\Models\Cms::find($request->id);
        $lists->title = $request->title;
        $lists->heading = $request->heading;
        $lists->description = $request->description;
        if(!empty($request->image)){ $lists->image = $FileName; }
        if(!empty($request->image2)){ $lists->image_2 = $FileName2; }
        $lists->save();
       return back()->with('success','Data Updated!');
    }
    public function updatecmsmodal(Request $request)
    {
      if(!empty($request->image)){
          $extension =  $request->image->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName = directFile('uploads/cms/',$request->image);
          }else{
              $FileName = autoheight('uploads/cms/',600,$request->image);
          }
      }
      if(!empty($request->image2)){
          $extension =  $request->image2->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName2 = directFile('uploads/cms/',$request->image2);
          }else{
              $FileName2 = autoheight('uploads/cms/',246,$request->image2);
          }
      }

        $lists = \App\Models\Cms::find($request->id);
        $lists->title = $request->title;
        $lists->heading = $request->heading;
        $lists->description = $request->description;
        if(!empty($request->image)){ $lists->image = $FileName; }
        if(!empty($request->image2)){ $lists->image_2 = $FileName2; }
        $lists->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }


    public function editorimage(){
        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
              $name = md5(rand(100, 200));
              $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
              $filename = $name.
              '.'.$ext;
              $destination = public_path('/uploads/editor/'.$filename); //change this directory
              $location = $_FILES["file"]["tmp_name"];
              move_uploaded_file($location, $destination);
              $message = asset('uploads/editor/'.$filename); //change this URL
              return response()->json([
                'url' => $message
              ]);
            } else {
              echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
            }
          }
    }
}
