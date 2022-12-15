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
    public function bookinglogin($bookingid){
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }
        $countries = \App\Models\Country::where('status',1);
        if(!empty($currentUserInfo->countryCode)){ $countries = $countries->where('sortname',$currentUserInfo->countryCode); }
        else{ $countries = $countries->where('phonecode',91); }
        $countries = $countries->first();
        return view('booking.booking-login',compact('lists','countries'));
    }
    public function bookingstep2($bookingid){
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }
        return view('booking.expert-booking-step2',compact('lists'));
    }
    public function payment($bookingid){
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }
        return view('booking.payment',compact('lists'));
    }
    public function paymentquery($bookingid){
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }
        return view('booking.payment-query',compact('lists'));
    }
    public function expertslottimes(Request $r){
        $expert = $r->expert;
        $slot = 0;
        $fees = 0;
        $expert = \App\Models\Expert::find($expert);
        $availabiledays = \App\Models\Slotavailability::where(['expert_id'=>$expert->id])->groupBy('day')->get();
        $availability = \App\Models\Slotavailability::where(['expert_id'=>$expert->id,'day'=>date('l',strtotime($r->date))])->get();
        foreach($expert->slotcharges as $key => $charges):
            if($key==0){ 
                $slot = $charges->time->minute;
                $fees = $charges->charges;
            }
            if($r->slot==$charges->time->minute){ $fees = $charges->charges; }
        endforeach;
        if(!empty($r->slot)){ $slot = $r->slot; }
        $Html='';
        if($availability->count() > 0){
        $Html .='<span class="SetInfo thm w-50 '.(empty($availability) ? 'mb-5':'').'"><span><i class="fas fa-info-circle me-2"></i> All times are in UTC+05:30 (IST)</span> <i class="far fa-chevron-right"></i></span>';
            foreach($availability as $availabile){
                $Html .='<ul class="p-0 TimeBox">';        
                $tStart = strtotime($availabile->from_time);
                $tEnd = strtotime($availabile->to_time);
                $tNow = $tStart;
                while($tNow <= $tEnd):
                    $endslot = date("H:i",strtotime('+'.($slot).' minutes',$tNow));
                    $checkbooking = \App\Models\SlotBook::where(['status'=>1,'expert_id'=>$expert->id,'booking_date'=>$r->date,'booking_time'=>date("H:i",$tNow)])->count();
                    $Html .='<li style="cursor:'.($r->date.date(" H:i",$tNow) < date('Y-m-d H:i') || $checkbooking > 0?'not-allowed':'').'"><input type="radio" class="btn-check" '.($r->date.date(" H:i",$tNow) < date('Y-m-d H:i') || $checkbooking > 0?'disabled':'').' name="timing" id="t'.$tNow.'" value="'.date("H:i",$tNow).'-'.$endslot.'"  autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available" for="t'.$tNow.'">'.date("H:i",$tNow).'</label></li>';
                    $tNow = strtotime('+'.($slot).' minutes',$tNow);
                endwhile;
                $Html .='</ul>';        
            } 
        }
        if($availability->count()==0){
            $Html .='<div class="col-12 text-center my-5 text-danger">
                        <h6>'.$expert->name.' is not available for '.date('F, d Y',strtotime($r->date)).'.</h6>
                        <p class="text-danger"><small>You Can found other expert for your query.</small></p>
                    </div>';
        } 
        $daysArr = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; 
        $availdays = [];
        $notavailabile = [];
        foreach($availabiledays as $avai){
            $availdays[] = $avai->day;
        } 
        foreach($daysArr as $key => $Arr){
            if(!in_array($Arr,$availdays)){ $notavailabile[] = $key ; }
        }    
        return response()->json([
            'html' => $Html,
            'charges' => $fees,
            'notavailabile' => $notavailabile,
            'records' => $availability->count()
        ]);
    }
    public function bookingprocess(Request $r){
        $data = new \App\Models\SlotBook();
        $data->booking_time = $r->booking_date.' '.explode('-',$r->timing)[1];
        $data->booking_start_time = explode('-',$r->timing)[0] ?? '';
        $data->booking_end_time = explode('-',$r->timing)[1] ?? '';
        $data->booking_date = $r->booking_date;
        $data->booking_amount = $r->booking_price;
        $data->paid_amount = $r->booking_price;
        $data->expert_id = $r->expert;
        $data->booking_id = generatebookingno();
        $data->user_id = userinfo()->id ?? '';
        $data->user_number = (!empty(userinfo()->id) ? userinfo()->ccode.userinfo()->mobile : '');
        $data->user_email = userinfo()->email ?? '';
        $data->user_name = userinfo()->name ?? '';
        $data->status = 1;
        $data->save();

        if(!empty(\Auth::user())){ $redirect = route('payment',['booking'=>$data->booking_id]); }
        else{ $redirect = route('expertbooking',['booking'=>$data->booking_id]); }

        return response()->json([
            'redirect' => $redirect
        ]);
    }
}