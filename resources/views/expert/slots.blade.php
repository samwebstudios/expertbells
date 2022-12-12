@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Availability Slots</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="pb-2 d-block d-md-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h3 class="m-0 h4">Availability Slots</h3>
                            {{-- <small>The slots for the next 7 days are given below.</small> --}}
                        </div>
                        <a href="#slotpricing" data-bs-toggle="modal" class="btn btni btn-sm btn-warning"><i class="fas fa-hand-holding-usd"></i> Slot Pricing</a>
                    </div>
                    <div class="card UserBox p-0 EditSlots ">
                        <div class="SlotingDate text-center">
                            @for ($i = 0; $i < 7; $i++)
                            @php $checkav = \App\Models\SlotAvailability::where(['day'=>jddayofweek($i,1)])->get(); @endphp
                            <div class="item">
                                <div class="DateS">{{jddayofweek($i,1)}}</div>                                
                                <ul>
                                    @foreach($checkav as $avai)
                                    <li>
                                        <span>{{date ('H:i',strtotime($avai->from_time))}}-{{date ('H:i',strtotime($avai->to_time))}}
                                            <a href="#AddTime" data-bs-modaltype="editavailability" data-bs-from="{{$avai->from_time}}" data-bs-to="{{$avai->to_time}}" data-bs-id="{{$avai->id}}" data-bs-type="{{jddayofweek($i,1)}}" data-bs-toggle="modal" class="Edit"></a>
                                            <span><i class="far fa-clock"></i> 
                                                @foreach($booktimes as $booktime)
                                                    {{$booktime->time->minute}}{{!$loop->last?', ':'min'}}
                                                @endforeach
                                            </span>
                                        </span>
                                        <a href="#DeleteModal" data-bs-toggle="modal" onclick="$('.removerecord').attr('href','{{route('expert.removeavailability',['id'=>$avai->id])}}');"></a>
                                    </li>
                                    @endforeach
                                    {{-- <li><span>4:00-4:30 PM<span><i class="far fa-clock"></i> 15 min</span></span></li>
                                    <li class="book"><span>4:00-4:30 PM<span><i class="far fa-clock"></i> 15 min</span></span></li> --}}
                                   
                                    <li><a href="#AddTime" data-bs-type="{{jddayofweek($i,1)}}" class="sws-top sws-bounce" data-bs-toggle="modal" data-title="Add Availability"><i class="fal fa-plus-circle"></i></a></li>
                                </ul>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Manage Slots : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<style type="text/css">
.owl-nav{top:20px;bottom:auto!important}
.owl-nav button.owl-prev{left:0!important}
.owl-nav button.owl-next{right:0!important}
.owl-nav button.owl-next, .owl-nav button.owl-prev{width:24px!important;height:36px!important;margin:0!important}
.DateS{border-bottom:1px solid rgb(var(--blackrgb)/.1);border-top:1px solid rgb(var(--blackrgb)/.1);border-left:1px solid rgb(var(--blackrgb)/.1);margin-bottom:9px;padding-bottom:6px;/*margin-top:9px;*/padding-top:6px;font-size:13px;color:rgb(var(--blackrgb)/.5);background:rgb(var(--blackrgb)/.05)}
.DateS>span{margin:0;color:var(--black)}
.UserBox>div{align-items:start}

.SlotingDate>div.item{width:14.285%;}
.SlotingDate ul{margin:0 auto;padding:0;width:calc(100% - 30px)}
.SlotingDate ul li{margin-bottom:6px;position:relative}
.SlotingDate ul li>a,.SlotingDate ul li>span{background:rgb(var(--thmrgb3)/.05);border:1px solid rgb(var(--thmrgb3)/.1);padding:2px 6px;border-radius:3px; overflow: hidden; position: relative; display:inline-block;font-size:13px;cursor:pointer;width:100%;line-height:150%;font-weight:600}
.SlotingDate ul li>a>span,.SlotingDate ul li>span>span{display:block;color:rgb(var(--blackrgb)/.6);font-weight:400;font-size:11px}
.SlotingDate ul li.book>a,.SlotingDate ul li.book>span{background:none;border-color:#ffc107!important;cursor:inherit}
.SlotingDate ul li button,.SlotingDate ul li>span+a{background:var(--thm) url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") no-repeat 4px center/7px auto;border:none;height:15px;width:15px;border-radius:50%;position:absolute;top:-4px;right:-4px;opacity:0; z-index:9; transition:all .5s}
.SlotingDate ul li:hover button,.SlotingDate ul li:hover>span+a{opacity:1}
.EditSlots .SlotingDate ul li:last-child>a,.EditSlots .SlotingDate ul li:last-child>span{background:var(--thm);color:var(--white)}
.Edit{position:absolute;height:100%;width:100%;left:0;top:0;z-index:2;background:rgb(var(--thmrgb)/.5);opacity:0;}
.SlotingDate ul li:hover>span .Edit{opacity:1;}

#AddTime .form-select,.TimeBoxIn input{border-radius:1.5rem;padding:.6rem .75rem;font-size:15px}
.TimeBoxIn{flex-wrap:nowrap!important}
.TimeBoxIn>*{width:50%}
.TimeBoxIn>span:first-child input{border-right:none!important;border-radius:1.5rem 0 0 1.5rem}
.TimeBoxIn>span:last-child input{border-radius:0 1.5rem 1.5rem 0}
</style>
@endpush
@push('js')
<div class="modal fade" id="AddTime" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddTimeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content availabilityform">
            @csrf
            <input type="hidden" name="Available_for">
            <input type="hidden" name="preid">
            <div class="modal-header">
                <h2 class="h5 modal-title" id="Availabilitybox">Set Availability Slot</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3 p-4">
                <div class="input-group TimeBoxIn">
                    <span>
                        <label class="ms-2"><small>From</small></label>
                        <input type="time" class="form-control" name="from_time" placeholder="Time">
                    </span>
                    <span>
                        <label class="ms-2"><small>To</small></label>
                        <input type="time" class="form-control" name="to_time" placeholder="Time">
                    </span>                    
                </div>
                <span class="error fromavailability-error mb-3"></span><br>
                <span class="error toavailability-error mb-3"></span>
                <p class="mt-2"><small><b>NOTE:</b> 
                    @foreach($booktimes as $booktime)
                    {{$booktime->time->minute}} minutes{{!$loop->last?', ':''}}
                    @endforeach
                    slots will be booked by the user.</small></p>
                <div class="text-center mt-3">
                    <button class="btn btn-thm2 asbtn">Set Availability</button>
                    <button class="btn btn-thm2 apbtn" style="display:none" disabled><i class="fad fa-spinner-third me-2 fa-spin"></i> Loading...</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="slotpricing" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddTimeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content saveslottime">
            @csrf
            <div class="modal-header">
                <h2 class="h5 modal-title" id="AddTimeLabel">Slot Pricing</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3 p-4">
                @foreach ($times as $item)
                    @php 
                        $price = \App\Models\SlotCharge::where(['expert_id'=>expertinfo()->id,'slot_time_id'=>$item->id])->first();
                    @endphp
                    <div class="from-group mb-2">
                        <label><small>{{$item->minute}} Minutes Charges ({{defaultcurrency()}})</small></label>
                        <input type="text" class="form-control" name="charges[{{$item->id}}]" value="{{$price->charges ?? ''}}" placeholder="Eg: $240">
                    </div>
                @endforeach   
                <span class="error charges-error mb-3"></span>
                <div class="text-center">                             
                    <button class="btn btn-thm2 sbtn">Confirm & Proceed</button>
                    <button class="btn btn-thm2 pbtn" style="display: none" disabled><i class="fad fa-spinner-third me-2 fa-spin"></i> Loading...</button>
                </div>
            </div>
        </form>
    </div>
</div>
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" onload="this.rel='stylesheet'" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script type="text/javascript">
$('.saveslottime').on('submit',function(e){
    e.preventDefault();
    $('.sbtn').hide();
    $('.pbtn').show();
    $('.error').html('');
    $.ajax({
        data:new FormData(this),
        url:@json(route('expert.addexpertslotprice')),
        method:'POST',
        dataType:'Json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
            toastr.success(data.success);
            setTimeout(() => {
                window.location.reload();
            }, 1000);
            $('.sbtn').show();
            $('.pbtn').hide();            
        },
        error:function(response){            
            if(response.responseJSON.errors.charges!== undefined){
                $('.charges-error').text(response.responseJSON.errors.charges);
            }
            $('.sbtn').show();
            $('.pbtn').hide(); 
        }
    });
});
$('[data-bs-type]').on('click',function(){
    let day = $(this).attr('data-bs-type');
    let type = $(this).attr('data-bs-modaltype');
    if(type=='editavailability'){
        $('input[name=preid]').val($(this).attr('data-bs-id'));
        $('input[name=from_time]').val($(this).attr('data-bs-from'));
        $('input[name=to_time]').val($(this).attr('data-bs-to'));
    }else{
        $('.availabilityform').trigger('reset');
    }
    $('#Availabilitybox').html(day+' Availability');
    $('input[name=Available_for]').val(day);
});

$('.availabilityform').on('submit',function(e){
    e.preventDefault();
    $('.asbtn').hide();
    $('.apbtn').show();
    $('.error').html('');
    $.ajax({
        data:new FormData(this),
        url:@json(route('expert.expertslotavailability')),
        method:'POST',
        dataType:'Json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
            toastr.success(data.success);
            setTimeout(() => {
                window.location.reload();
            }, 1000);
            $('.asbtn').show();
            $('.apbtn').hide();            
        },
        error:function(response){            
            if(response.responseJSON.errors.from_time!== undefined){
                $('.fromavailability-error').text(response.responseJSON.errors.from_time);
            }
            if(response.responseJSON.errors.to_time!== undefined){
                $('.toavailability-error').text(response.responseJSON.errors.to_time);
            }
            $('.asbtn').show();
            $('.apbtn').hide(); 
        }
    });
});
</script>
@endpush