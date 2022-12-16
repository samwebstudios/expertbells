<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }

    /// PROFILE
    public function editprofile(){
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty(expertinfo()->ccode)){ $ccode = $ccode->where('phonecode',userinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
            else{
                $ccode = $ccode->where('phonecode',91);
            }
        }
        $ccode = $ccode->first();
        $countries = \App\Models\Country::where('status',1)->get();
        return view('user.editprofile',compact('countries','ccode'));
    }
    public function account(){
        $user = \App\Models\User::find(userinfo()->id);
        $currentUserInfo = \Location::get(myipaddress());
        $countries = \App\Models\Country::where('status',1);
        if(!empty(userinfo()->ccode)){ $countries = $countries->where('phonecode',userinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $countries = $countries->where('sortname',$currentUserInfo->countryCode); }
            else{
                $countries = $countries->where('phonecode',91);
            }
        }
        $countries = $countries->first();
        return view('user.account',compact('user','countries'));
    }

    public function schedules(){
        $bookings = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'reschedule_slot'=>0])->orderBy('id','DESC')->paginate(50);
        $user = \App\Models\User::find(userinfo()->id);
        return view('user.schedule',compact('bookings','user'));
    }
    public function reschedules(){
        $bookings = \App\Models\SlotBook::where(['user_id'=>userinfo()->id])->where('reschedule_slot','>',0)->orderBy('id','DESC')->paginate(50);
        $user = \App\Models\Expert::find(userinfo()->id);
        return view('user.schedule',compact('bookings','user'));
    }
    public function bookinginformation($bookingid){
        $bookings = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'booking_id'=>$bookingid])->first();
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
    
}
