<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('expert.dashboard');
    }

    /// PROFILE
    public function editprofile(){
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty(expertinfo()->ccode)){ $ccode = $ccode->where('phonecode',expertinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
            else{
                $ccode = $ccode->where('phonecode',91);
            }
        }
        $ccode = $ccode->first();
        $countries = \App\Models\Country::where('status',1)->get();
        return view('expert.editprofile',compact('countries','ccode'));
    }
    public function account(){
        $expert = \App\Models\Expert::find(expertinfo()->id);
        $currentUserInfo = \Location::get(myipaddress());
        $countries = \App\Models\Country::where('status',1);
        if(!empty(expertinfo()->ccode)){ $countries = $countries->where('phonecode',expertinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $countries = $countries->where('sortname',$currentUserInfo->countryCode); }
            else{
                $countries = $countries->where('phonecode',91);
            }
        }
        $countries = $countries->first();
        return view('expert.account',compact('expert','countries'));
    }
    public function addwhatexpect(){
        return view('expert.whatexpect');
    }
    public function otherinformation(){
        $qualifications = \App\Models\Qualification::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $workings = \App\Models\Working::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $expertise = \App\Models\Expertise::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $languages = \App\Models\Language::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        return view('expert.otherinformation',compact('qualifications','workings','expertise','languages','industries'));
    }

    /// VIDOES
    public function videos(){
        $videos = \App\Models\ExpertVideo::where('expert_id',expertinfo()->id)->orderBy('sequence','DESC')->get();        
        return view('expert.videos',compact('videos'));
    }
    public function addvideo(){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        return view('expert.addvideos',compact('industries'));
    }
    public function editvideo(Request $r){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $videos = \App\Models\ExpertVideo::find($r->id);    
        if(empty($videos)){ return "This video is not exists"; }    
        return view('expert.editvideos',compact('industries','videos'));
    }
    public function removevideo($id){
        $videos = \App\Models\ExpertVideo::find($id);
        if(!empty($videos->video)){
            if(file_exists(public_path('uploads/expert/video/'.$videos->video))){
                unlink(public_path('uploads/expert/video/'.$videos->video));
            }
        }
        if(!empty($videos->video_image)){
            if(file_exists(public_path('uploads/expert/video/'.$videos->video_image))){
                unlink(public_path('uploads/expert/video/'.$videos->video_image));
            }
            if(file_exists(public_path('uploads/expert/video/jpg/'.$videos->video_image.'.jpg'))){
                unlink(public_path('uploads/expert/video/jpg/'.$videos->video_image.'.jpg'));
            }
            if(file_exists(public_path('uploads/expert/video/'.$videos->video_image.'.webp'))){
                unlink(public_path('uploads/expert/video/'.$videos->video_image.'.webp'));
            }
        }
        $videos->delete();
        return back()->with('success','Video Removed!');
    }

    ///SLOTS
    public function slots(){
        $times = \App\Models\SlotTime::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $booktimes = \App\Models\SlotCharge::where(['expert_id'=>expertinfo()->id])->get();
        return view('expert.slots',compact('times','booktimes'));
    }
    public function removeavailability($id){
        $videos = \App\Models\SlotAvailability::find($id);
        $videos->delete();
        return back()->with('success','Availability Removed!');
    }

    ///Schedules
    public function schedules(){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id,'reschedule_slot'=>0])->orderBy('id','DESC')->paginate(50);
        $experts = \App\Models\Expert::find(expertinfo()->id);
        $slots = \App\Models\SlotAvailability::where(['is_publish'=>1,'expert_id'=>$experts->id,'day'=>date('l',strtotime('Y-m-d'))])->get();
        return view('expert.schedule',compact('bookings','experts'));
    }
    public function reschedules(){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->where('reschedule_slot','>',0)->orderBy('id','DESC')->paginate(50);
        $experts = \App\Models\Expert::find(expertinfo()->id);
        $slots = \App\Models\SlotAvailability::where(['is_publish'=>1,'expert_id'=>$experts->id,'day'=>date('l',strtotime('Y-m-d'))])->get();
        return view('expert.schedule',compact('bookings','experts'));
    }
    public function bookinginformation($bookingid){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id,'booking_id'=>$bookingid])->first();
        if(empty($bookings)){
            return 'This slot is not available in our records.';
        }else{
            $html='';
            $html .='<h6 class="title" style="font-size: 13px;font-weight: bold;"><u>BOOKING INFORMATION</u></h6>';
            $html .='<table class="table">';
                $html .='<tr>';
                    $html .='<td style="width: 145px;">Booking No: </td>';
                    $html .='<td>#'.$bookings->booking_id.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Booking Date: </td>';
                    $html .='<td>'.dateformat($bookings->booking_date).'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Booking Time: </td>';
                    $html .='<td>'.substr($bookings->booking_start_time,0,-3).' to '.substr($bookings->booking_end_time,0,-3).'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Booking Amount: </td>';
                    $html .='<td>&#8377; '.$bookings->booking_amount.'</td>';
                $html .='</tr>';
                if($bookings->coupon_discount>0):
                $html .='<tr>';
                    $html .='<td>Booking Discount: </td>';
                    $html .='<td>&#8377; '.$bookings->coupon_discount.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Paid Amount: </td>';
                    $html .='<td>&#8377; '.$bookings->paid_amount.'</td>';
                $html .='</tr>';                
                endif;
                $html .='<tr>';
                    $html .='<td>Payment: </td>';
                    $html .='<td>';
                        if($bookings->payment==0): $html .='<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small>'; endif;
                        if($bookings->payment==1): $html .='<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid</small>'; endif;
                        if($bookings->payment==2): $html .='<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Failed</small>'; endif;
                    $html .='</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Status: </td>';
                    $html .='<td>';
                        if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime($bookings->booking_date.' '.$bookings->booking_start_time))):
                            if($bookings->reschedule_slot==0): 
                                if($bookings->status==0): $html .='<small class="text-secondary">New</small>'; endif;
                                if($bookings->status==1): $html .='<small class="text-success">Confirm</small>'; endif;
                                if($bookings->status==2): $html .='<small class="text-danger">Rejected</small>'; endif;
                            else: 
                            $html.='<small class="text-danger">Reschedule</small> ';
                            if($bookings->reschedule_slot>0): 
                                $html.='<small class="text-success">(New booking #'.($bookings->reschedule->booking_id ?? 0).')</small>';
                            endif;
                            endif;
                            if($bookings->refund>0):
                                $html .='<small class="text-success ms-3">(Refunded &#8377; '.($bookings->refund ?? 0).')</small>';
                            endif;
                        endif;
                    $html .='</td>';
                $html .='</tr>';
                if($bookings->status==2):
                    $html .='<tr>';
                        $html .='<td>Reject Date: </td>';
                        $html .='<td>'.datetimeformat($bookings->reject_date).'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                        $html .='<td>Reject Reason: </td>';
                        $html .='<td>'.$bookings->reject_reason.'</td>';
                    $html .='</tr>';
                endif;
            $html .='</table>';
            $html .='<h6 class="title" style="font-size: 13px;font-weight: bold;"><u>USER INFORMATION</u></h6>';
            $html .='<table class="table">';
                $html .='<tr>';
                    $html .='<td style="width: 105px;">User Name: </td>';
                    $html .='<td>'.$bookings->user_name.'(#'.$bookings->user->user_id.')</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>User Email: </td>';
                    $html .='<td>'.$bookings->user_email.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Contact No: </td>';
                    $html .='<td>'.$bookings->user_number.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>User Query: </td>';
                    $html .='<td>'.$bookings->query.'</td>';
                $html .='</tr>';
                
            $html .='</table>';
            return $html;
        }
    }
    public function scheduleconfirm($confirm,$schedule){
        $data = \App\Models\SlotBook::find($schedule);
        if(empty($data)){ return back()->with('error','This schedule is not registered in our records.please choose correct schedule slot.'); }
        $data->status=$confirm;
        if($confirm==2){
            $data->reject_date=date('Y-m-d H:i:s');
            $data->reject_reason=request('reason');
        }
        $data->save();

        
        if($data->status==2){
            $html = '<b>Hi '.$data->user_name.'</b><br>';
            $html .= 'I just wanted to drop you a quick note to let you know that your booked schedule #'.$data->booking_id.' has been rejected by the '.ucwords(expertinfo()->name).'.<br>';
            // $html .= 'Don`t worry, we will soon assign your schedule to another expert And you will be informed about the same by email.';
            $html .= 'Don`t worry, we will refund you money in your expertbells wallet with in 1 hours.';
            $body = ['message'=>$html,'subject'=>'Schedules #'.$data->booking_id.' has been rejected' ];
            \Mail::to($data->user_email)->send(new \App\Mail\PaymentReceived($body));

            $user = \App\Models\User::find($data->user_id)->increment('wallet',$data->paid_amount);
            $refund = new \App\Models\UserWalletHistory();
            $refund->user_id = $data->user_id;
            $refund->amount = $data->paid_amount;
            $refund->type = 'refund';
            $refund->amounttype = 'c';
            $data->is_publish = 1;
            $data->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
            $refund->save();

            \App\Models\SlotBook::find($schedule)->increment('refund',$data->paid_amount);
            /// ADMIN
            $html = '<b>Hi<br>';
            $html .= 'I just wanted to drop you a quick note to let you know that booked schedule #'.$data->booking_id.' has been rejected by the '.ucwords(expertinfo()->name).'.<br>';
            $body = ['message'=>$html,'subject'=>'Schedules #'.$data->booking_id.' has been rejected' ];
            \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\PaymentReceived($body));
            return back()->with('success','This schedule has been rejected.');
        }
        
    }
}
