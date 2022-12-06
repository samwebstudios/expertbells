<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsmodal($id){
        $lists = \App\Models\Cms::find($id);
        return view('admin.cms.cms-modal',compact('lists'));
    }

    public function updatecmsmodal(Request $request)
    {
        $lists = \App\Models\Cms::find($request->id);
        $lists->title = $request->title;
        $lists->description = $request->description;
        $lists->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
