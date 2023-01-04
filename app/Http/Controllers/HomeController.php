<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{    
    public function index(){
        return view('home');
    }
    public function contact(){
        $cms = \App\Models\Cms::find(11);
        $contact = \App\Models\Cms::find(12);
        return view('contact',compact('contact','cms'));
    }
    public function termsandconditions(){
        $cms = \App\Models\Cms::find(9);
        return view('cms',compact('cms'));
    }
    public function privacypolicy(){
        $cms = \App\Models\Cms::find(8);
        return view('cms',compact('cms'));
    }
    public function about(){
        $banner = \App\Models\Cms::find(4);
        $mission = \App\Models\Cms::find(5);
        $vission = \App\Models\Cms::find(6);
        $teams = \App\Models\Team::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('about',compact('banner','mission','vission','teams'));
    }
    public function teamdetails(){
        $teams = \App\Models\Team::where(['is_publish'=>1,'id'=>request('member')])->first();
        return view('team-detail',compact('teams'));
    }
    public function blogcategory($alias){
        $categories = \App\Models\BlogCategory::where(['is_publish'=>1,'alias'=>$alias])->first();
        if(empty($categories)){ abort(404); }  
        $lists = \App\Models\Blog::where(['is_publish'=>1,'category_id'=>$categories->id])->orderBy('sequence','ASC')->paginate(20);
        $cms = \App\Models\Cms::find(10);
        return view('blog',compact('lists','cms'));
    }
    public function blogarchive($alias){
        $explode = explode('-',$alias);
        $lists = \App\Models\Blog::where(['is_publish'=>1])->whereYear('post_date',$explode[0] ?? 0)->whereMonth('post_date',$explode[1] ?? 0)->orderBy('sequence','ASC')->paginate(20);
        $cms = \App\Models\Cms::find(10);
        return view('blog',compact('lists','cms'));
    }
    public function blog($alias=null){
        if(!empty($alias)){
            $list = \App\Models\Blog::where(['is_publish'=>1,'alias'=>$alias])->first();
            if(empty($list)){ abort(404); }  
            $archives = \App\Models\Blog::where(['is_publish'=>1]);
            $archives = $archives->selectRaw('year(post_date) year,month(post_date) month');
            $archives = $archives->groupBy('year','month')->orderBy('sequence','ASC')->get(); 
            $categories = \App\Models\BlogCategory::where(['is_publish'=>1])->orderBy('sequence','ASC')->get();     
            $populars = \App\Models\Blog::where(['is_publish'=>1,'latest'=>1])->whereNotIn('id',[$list->id])->orderBy('sequence','ASC')->paginate(5);
            $next_record = \App\Models\Blog::where('id', '>', $list->id)->orderBy('id')->first();
            $previous_record = \App\Models\Blog::where('id', '<', $list->id)->orderBy('id','desc')->first();
            $relateds =  \App\Models\Blog::where(['is_publish'=>1,'category_id'=>$list->category_id])->whereNotIn('id',[$list->id])->orderBy('sequence','ASC')->paginate(5);
            return view('blog-detail',compact('list','archives','relateds','next_record','previous_record','populars','categories'));
        }else{
            $cms = \App\Models\Cms::find(10);
            $lists = \App\Models\Blog::where(['is_publish'=>1])->orderBy('sequence','ASC')->paginate(20);
            return view('blog',compact('lists','cms'));
        }
    }
    public function careers($alias=null){
        if(!empty($alias)){
            $list = \App\Models\Career::where(['is_publish'=>1,'alias'=>$alias])->orderBy('sequence','ASC')->first();
            if(empty($list)){ abort(404); }  
            return view('careers-detail',compact('list'));
        }else{
            $cms = \App\Models\Cms::find(19);
            $lists = \App\Models\Career::where('is_publish',1)->orderBy('sequence','ASC')->get();
            return view('careers',compact('lists','cms'));
        }
    }
    public function faq($catgeory=null,$child=null){
        $cms = \App\Models\Cms::find(20);
        $category = \App\Models\FaqCategory::where(['is_publish'=>1,'parent'=>0])->orderBy('sequence','ASC')->get();
        $activecategory = \App\Models\FaqCategory::where(['is_publish'=>1,'parent'=>0]);
        if(!empty($catgeory)){ $activecategory = $activecategory->where('alias',$catgeory); }
        $activecategory = $activecategory->orderBy('sequence','ASC')->first();

        $categoryId = [];
        if(count($activecategory->child) > 0){
            foreach($activecategory->child as $activchild):
                $categoryId[] = $activchild->id ;
            endforeach;
        }else{
            $categoryId[] = $activecategory->id ;
        }
                
        
        if(!empty($child)){  
            $categoryId = [];
            $activechild = \App\Models\FaqCategory::where(['is_publish'=>1]);
            $activechild = $activechild->where('alias',$child);
            $activechild = $activechild->orderBy('sequence','ASC')->first(); 
            $categoryId[] =  $activechild->id;    
        }

        $lists = \App\Models\Faq::where(['is_publish'=>1]);
        $lists = $lists->whereIn('category_id',$categoryId);
        if(!empty(request('search'))){
            $lists = $lists->where('title','LIKE','%'.request('search').'%');
        }
        $lists = $lists->orderBy('sequence','ASC')->paginate(10);

        return view('faqs',compact('lists','cms','category','activecategory'));
    }

    public function becomeanexpert(){
        $banner = \App\Models\Cms::find(13);
        $section2 = \App\Models\Cms::find(14);
        $threeicons = \App\Models\ThreeIcon::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $section4 = \App\Models\Cms::find(16);
        $mentors  = \App\Models\Mentor::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $section5 = \App\Models\Cms::find(15);
        $callingcms = \App\Models\Cms::find(17);
        $callingprocess  = \App\Models\CallingProcess::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $testimonialscms = \App\Models\Cms::find(18);
        $testimonials  = \App\Models\Testimonial::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('become-an-expert',compact('banner','testimonialscms','testimonials','callingcms','callingprocess','section2','threeicons','section5','section4','mentors'));
    }
    public function experts($experid=null,$type=null){        
        $experts = \App\Models\Expert::where(['is_publish'=>1,'profile_visibility'=>1]);
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
            $experts = $experts->whereNotIn('id',[expertinfo()->id ?? 0]);
            $experts = $experts->paginate(40);
            $expertise = \App\Models\Expertise::where(['is_publish'=>1])->get();
            $industries = \App\Models\Industry::where(['is_publish'=>1])->get();
            $roles = \App\Models\Role::where(['is_publish'=>1])->get();
            $categories = \App\Models\ExpertCategory::where(['is_publish'=>1])->get();
            return view('experts',compact('experts','expertise','categories','industries','roles'));
        }
    }
    public function expertvideos($experid){
        if(!empty(request('v'))){
            $experts = \App\Models\Expert::where(['is_publish'=>1,'profile_visibility'=>1,'video_visibility'=>1]);
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



    //// Booking
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
                        <h6>'.$expert->name.' is not available for '.date('l d M, Y',strtotime($r->date)).'.</h6>
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
        $data->status = 0;
        $data->save();


        if(!empty(\Auth::user())){ $redirect = route('payment',['booking'=>$data->booking_id]); }
        else{ $redirect = route('expertbooking',['booking'=>$data->booking_id]); }

        return response()->json([
            'redirect' => $redirect
        ]);
    } 

    /// Auto Search
    public function autosearch(Request $r){
        $search = $r->search;
        $experts = \App\Models\Expert::where('is_publish',1);
        if(!empty($search)){
            $experts = $experts->where(function($q) use($search){
                $expertise = [];
                $qualification = [];
                $category = [];
                $industry = array();

                $expertiseArr = \App\Models\Expertise::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                $categoryArr = \App\Models\ExpertCategory::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                $qualificationArr = \App\Models\Qualification::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                $industryArr = \App\Models\Industry::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                foreach($expertiseArr as $exparr){
                    $expertise[] = $exparr->id;
                }
                foreach($qualificationArr as $qualArr){
                    $qualification[] = $qualArr->id;
                }
                foreach($categoryArr as $catArr){
                    $category[] = $catArr->id;
                }
                
                $q->where('name','LIKE','%'.$search.'%');
                $q->orwhere('user_id','LIKE','%'.$search.'%');
                $q->orwhere('email','LIKE','%'.$search.'%');
                $q->orwhereIn('highest_qualification',$qualification);
                $q->orwhereIn('your_expertise',$expertise);
                $q->orwhereIn('category',$category);
                foreach($industryArr as $indArr){
                    $q->orwhereRaw('json_contains(suitable_industry, \'["'.$indArr->id.'"]\')');
                }
                
            });
        }
        $experts = $experts->paginate(20);
        $Html='';
        $Html .='<ul>';
        if($experts->count()==0){ $Html .='<li class="text-center">Sorry! No Data Found...</li>';}
        foreach($experts as $expert):
            $Html .='<li><a href="'.route('experts',['alias'=>$expert->user_id]).'" class="d-flex align-items-center img">';
            if (in_array(checkimagetype($expert->image), ['SVG','WEB','AVIF']) && file_exists(public_path('uploads/expert/'. $expert->image))):
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('uploads/expert/'.$expert->image).'"> ';
            elseif(file_exists(public_path('uploads/expert/'.$expert->image . '.webp'))):
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('uploads/expert/'.$expert->image. '.webp').'"> ';
            elseif(file_exists(public_path('uploads/expert/jpg/'.$expert->image . '.jpg'))):
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('uploads/expert/jpg/'.$expert->image. '.jpg').'">' ;
            else:
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('frontend/image/no-img.jpg').'"> ';
            endif;
                $Html .= '<div class="ms-2"><span>';
                $Html .= $expert->name;
                $Html .= !empty($expert->expertise->title) ? ' ('.$expert->expertise->title.')' : '';
                $Html .= '<span><small class="d-block lh-n">';
                foreach(json_decode($expert->suitable_industry) as $k=> $industry):
                    $industry = \App\Models\Industry::find($industry);
                    $Html .= $industry->title ?? '';
                    if(($k + 1) < count(json_decode($expert->suitable_industry))){ $Html .= ' + '; }                    
                endforeach;
                $Html .= '</small></div>';
            $Html .='</a></li>';
        endforeach;            
        $Html .='</ul>';
        return response()->json([
            'html' => $Html
        ]);
    }
}