<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Auth;
use Helper;
use Image;
class BlogController extends Controller{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $lists = Blog::with('category')->latest()->paginate(20);
        return view('admin.blog.list',compact('lists'));
    }

    public function New(){
        $categories = BlogCategory::where('status',1)->get();
        return view('admin.blog.add',compact('categories'));
    }

    public function Edit($Id){
        $lists = Blog::find($Id);
        $categories = BlogCategory::where('status',1)->get();
        return view('admin.blog.edit',compact('lists','categories'));
    }

    public function Remove(Request $r){
        $Data = Blog::find($r->removeId)->delete();
        return back()->with('success_msg', 'Data have been remove successfully.');
    }

    public function Status($Status,$Id){
        $Data = Blog::find($Id);
        $Data->status = $Status;
        $Data->save();
        return back()->with('success_msg', 'Status have been updated successfully.');
    }

    public function Popular($Status,$Id){
        $Data = Blog::find($Id);
        $Data->popular = $Status;
        $Data->save();
        return back()->with('success_msg', 'Popular status have been updated successfully.');
    }

    public function Top($Status,$Id){
        if(Blog::where('top',1)->count()==5){
            return back()->with('error_msg', 'You have already set 5 blogs in top blogs!');
        }
        $Data = Blog::find($Id);
        $Data->top = $Status;
        $Data->save();
        return back()->with('success_msg', 'Top Status have been updated successfully.');
    }

   
    public function Save(Request $r){
            $validated = $r->validate([
                'title' => 'required',
                'category' => 'required',
                'post_date' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,mp4|max:2024',
                'banner' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,mp4|max:2024',
                'description' => 'required'
            ]);
        if(empty($r->image)){
            $FileName = '';
        }else{
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('up/bg/',$r->image);
            }else{
                $FileName = autoheight('up/bg/',600,$r->image);
            }
        }
        
        if(empty($r->banner)){
            $BannerName = '';
        }else{
            $extension =  $r->banner->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $BannerName = directFile('up/bg/bn/',$r->banner);
            }else{
                $BannerName = autoheight('up/bg/bn/',928,$r->banner);
            }
        }
        $Data = new Blog();
        $Data->title = $r->title;
        $Data->category_id = $r->category;

        if(!empty($r->image)){
            $Data->image_name = !empty($FileName[0]) ? $FileName[0] : '' ;
            $Data->image = !empty($FileName[1]) ? $FileName[1] : '' ;        
            $Data->webp_image = !empty($FileName[2]) ? $FileName[2] : '' ;         
            $Data->jpg_image = !empty($FileName[3]) ? $FileName[3] : '' ; 
        }
        if(!empty($r->banner)){
            $Data->banner_name = !empty($BannerName[0]) ? $BannerName[0] : '' ;
            $Data->banner = !empty($BannerName[1]) ? $BannerName[1] : '' ;        
            $Data->webp_banner = !empty($BannerName[2]) ? $BannerName[2] : '' ;         
            $Data->jpg_banner = !empty($BannerName[3]) ? $BannerName[3] : '' ; 
        }
        
        $Data->post_date = date("Y-m-d",strtotime($r->post_date));
        $Data->description = $r->description;
        $Data->short_description = $r->sort_description;
        $Data->meta_title = $r->meta_title;
        $Data->meta_keywords = $r->meta_keywords;
        $Data->meta_description = $r->meta_description;

        $Data->alias = alias('blogs','alias',$r->title);
        $Data->save();
        return back()->with('success_msg', 'Data have been saved successfully.');
    }

    public function Update(Request $r){
        $validated = $r->validate([
            'title' => 'required',
            'category' => 'required',
            'post_date' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,svg,webp,mp4|max:2024',
            'banner' => 'mimes:jpeg,jpg,png,gif,svg,webp,mp4|max:2024',
            'description' => 'required'
        ]);

        if(empty($r->image)){
            $FileName = $r->preimage;
        }else{
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('up/bg/',$r->image);
            }else{
                $FileName = autoheight('up/bg/',600,$r->image);
            }
        }
        
        if(empty($r->banner)){
            $BannerName = $r->prebanner;
        }else{
            $extension =  $r->banner->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $BannerName = directFile('up/bg/bn/',$r->banner);
            }else{
                $BannerName = autoheight('up/bg/bn/',928,$r->banner);
            }
        }

        $Data = Blog::find($r->preId);
        $Data->title = $r->title;
        $Data->category_id = $r->category;
        if(!empty($r->image)){
            $Data->image_name = !empty($FileName[0]) ? $FileName[0] : '' ;
            $Data->image = !empty($FileName[1]) ? $FileName[1] : '' ;        
            $Data->webp_image = !empty($FileName[2]) ? $FileName[2] : '' ;         
            $Data->jpg_image = !empty($FileName[3]) ? $FileName[3] : '' ; 
        }
        if(!empty($r->banner)){
            $Data->banner_name = !empty($BannerName[0]) ? $BannerName[0] : '' ;
            $Data->banner = !empty($BannerName[1]) ? $BannerName[1] : '' ;        
            $Data->webp_banner = !empty($BannerName[2]) ? $BannerName[2] : '' ;         
            $Data->jpg_banner = !empty($BannerName[3]) ? $BannerName[3] : '' ; 
        }
        $Data->post_date = date("Y-m-d",strtotime($r->post_date));
        $Data->description = $r->description;
        $Data->short_description = $r->sort_description;
        $Data->meta_title = $r->meta_title;
        $Data->meta_keywords = $r->meta_keywords;
        $Data->meta_description = $r->meta_description;
        $Alias=$r->alias;
        if(empty($r->alias)){$Alias = $r->prealias;}
        $Data->alias = $Alias;
        $Data->save();
        return back()->with('success_msg', 'Data have been updated successfully.');
    }

    public function Comments($Id=null,$comment=null){
        if(!empty($Id)){
            $lists = BlogComment::where(['blog_id'=>$Id,'parent'=>($comment??0)])->orderBy('id','DESC')->paginate(20);  
            return view('admin.blog.comments',compact('lists'));  
        }
        if(empty($Id)){
            $lists = BlogComment::where(['parent'=>($comment??0)])->orderBy('id','DESC')->paginate(20);
            return view('admin.blog.comments',compact('lists'));    
        }
    }      


    public function CommentStatus($Status,$Id){
        $Data = BlogComment::find($Id);
        $Data->status = $Status;
        $Data->save();
        return back()->with('success_msg', 'Status have been updated successfully.');
    }



    public function Remove_Comments(Request $r){
        $Data = BlogComment::find($r->removeId)->delete();
        return back()->with('success_msg', 'Data have been remove successfully.');
    }
    
}
