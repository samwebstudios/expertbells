<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Auth;
use Helper;
use Image;
class BlogCategoryController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $lists = BlogCategory::latest()->paginate(20);
        return view('admin.blog.blog-category.list',compact('lists'));
    }

    public function New(){
        return view('admin.blog.blog-category.add');
    }

    public function Edit($Id){
        $lists = BlogCategory::find($Id);
        return view('admin.blog.blog-category.edit',compact('lists'));
    }

    public function Remove(Request $r){
        $check = Blog::where('category_id',$r->removeId)->count();
        if($check>0){
            return back()->with('error_msg', 'blogs are mapped in this category.');
        }
        $Data = BlogCategory::find($r->removeId)->delete();
        return back()->with('success_msg', 'Data have been remove successfully.');
    }

    public function Status($Status,$Id){
        $Data = BlogCategory::find($Id);
        $Data->status = $Status;
        $Data->save();
        return back()->with('success_msg', 'Status have been updated successfully.');
    }

   
    public function Save(Request $r){
        $validated = $r->validate([
                'category_name' => 'required',
            ]);
        $Data = new BlogCategory();
        $Data->title = $r->category_name;
        $Data->alias = alias('blog_categories','alias',$r->category_name);
        $Data->meta_title = $r->meta_title;
        $Data->meta_keywords = $r->meta_keywords;
        $Data->meta_description = $r->meta_description;
        $Data->save();
        return back()->with('success_msg', 'Data have been saved successfully.');
    }

    public function Update(Request $r){
        $validated = $r->validate([
            'category_name' => 'required',
            'alias' => 'required',
        ]);

        $Data = BlogCategory::find($r->preId);
        $Data->title = $r->category_name;
        $Data->alias = $r->alias;
        $Data->meta_title = $r->meta_title;
        $Data->meta_keywords = $r->meta_keywords;
        $Data->meta_description = $r->meta_description;
        $Data->save();
        return back()->with('success_msg', 'Data have been updated successfully.');
    }
}
