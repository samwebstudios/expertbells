<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ScheduleController extends Controller{
    public function index($type){
        $lists = \App\Models\SlotBook::latest();
        if($type=='booked'){ $lists = $lists->whereIn('status',[0,1])->where('booking_date','>=',date('Y-m-d')); }
        if($type=='rejected'){ $lists = $lists->whereIn('status',[2])->where('booking_date','>=',date('Y-m-d')); }
        if($type=='previous'){ $lists = $lists->where('booking_date','<',date('Y-m-d'))->where('booking_end_time','<',date('H:i:s')); }
        $lists = $lists->paginate(10);
        return view('admin.schedules.list',compact('lists'));
    }
    public function information(Request $r){
        $lists = \App\Models\SlotBook::find($r->id);
        if(empty($lists)){ return 'This schedules is not available in our records.'; }
        return view('admin.schedules.information',compact('lists'));
    }
    public function assignexpert(Request $r){
        $lists = \App\Models\SlotBook::find($r->id);
        if(empty($lists)){ return 'This schedules is not available in our records.'; }
        return view('admin.schedules.assignexpert',compact('lists'));
    }
}
