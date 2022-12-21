@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a aria-current="page">{{ucwords(request()->segment(2))}} Calls</a></li>
                    </ol>
                </div>
                <x-user.wallet-show/>
            </div>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-user.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="" method="post" class="card UserBox">
                        <div class="card-body">
                            <div class="table-responsive w-100 mt-2 mb-1">
                                <table class="DataTable table table-striped w-100">
                                    <colgroup>
                                        <col width="7%">
                                        <col width="25%">
                                        <col width="23%">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="40%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Expert Detail</th>
                                            <th>Booking</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                        <tr>
                                            <td></td>
                                            <td>
                                                <a href="{{route('experts',['alias'=>$booking->expert->user_id])}}" target="_blank" class="ProTable">
                                                    <div class="img">
                                                        <x-image-box>
                                                            <x-slot:image>{{$booking->expert->profile}}</x-slot>
                                                            <x-slot:path>/uploads/expert/</x-slot>
                                                            <x-slot:alt>{{$booking->expert->name ?? ''}} {{!empty($booking->expert->expertise->title) ? '('.$booking->expert->expertise->title.')' : ''}} </x-slot>
                                                            <x-slot:width>380</x-slot>
                                                            <x-slot:height>480</x-slot>
                                                        </x-image-box>
                                                    </div>
                                                    <div class="">
                                                        <h3>{{$booking->expert->name ?? ''}}</h3>
                                                        @if(!empty($booking->expert->suitable_industry))
                                                        <p>
                                                            @foreach(json_decode($booking->expert->suitable_industry) as $industry)
                                                                @php $industry = \App\Models\Industry::find($industry); @endphp
                                                                {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                                            @endforeach
                                                        </p>
                                                        @endif
                                                        <span class="star" title="star" data-title="4"></span>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#bookinginfo" data-bs-toggle="modal" data-bs-type="bookinginfo" data-bs-id="{{$booking->booking_id}}">
                                                    <small class="d-block">Booking No: <b>#{{$booking->booking_id}}</b></small>
                                                    <small class="d-block">Date: <b>{{date('D, d M Y',strtotime($booking->booking_date))}}</b></small>
                                                    <small class="d-block">Time: <b>{{substr($booking->booking_start_time,0,-3)}} To {{substr($booking->booking_end_time,0,-3)}}</b></small>
                                                </a>
                                                <small class="d-block">Amount: <b>&#8377; {{$booking->booking_amount}}</b></small>
                                                @if($booking->coupon_discount>0)
                                                <small class="d-block">Discount: <b>&#8377; {{$booking->coupon_discount ?? '00'}}</b></small>
                                                <small class="d-block">Paid: <b>&#8377; {{$booking->paid_amount}}</b></small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($booking->payment==0)<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small> @endif
                                                @if($booking->payment==1)<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid</small>@endif
                                                @if($booking->payment==2)<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Failed</small>@endif
                                            </td>
                                            <td class="text-center">
                                                @if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime($booking->booking_date.' '.$booking->booking_start_time)))
                                                    @if($booking->reschedule_slot==0)
                                                        <small class="text-secondary">{{$booking->status==0?'New':''}}</small>
                                                        <small class="text-success">{{$booking->status==1?'Confirm':''}}</small>
                                                        <small class="text-danger">{{$booking->status==2?'Rejected':''}}</small>
                                                    @else
                                                    <small class="text-danger">Reschedule</small> 
                                                    @endif
                                                @else
                                                    @if($booking->reschedule_slot>0) 
                                                        <small class="text-danger">Reschedule</small> 
                                                    @elseif($booking->status==2)
                                                    <small class="text-danger">Rejected</small>
                                                    @else
                                                    <small class="text-danger">Not Attended</small>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime($booking->booking_date.' '.$booking->booking_start_time)))
                                                    @if($booking->status==1 && $booking->reschedule_slot==0)
                                                        @php 
                                                            $Start = date('Y-m-d H:i',strtotime('-60 minutes'.$booking->booking_date.' '.$booking->booking_start_time));
                                                            $End = $booking->booking_date.' '.$booking->booking_start_time;
                                                        @endphp  
                                                        @if($booking->send_invitation==1 && date('Y-m-d H:i') <= date('Y-m-d H:i',strtotime('+10 minutes'.$End)))
                                                            <a href="#" class="btn btni btn-success disable"><i class="fal fa-clock"></i> <span class="ms-md-1">Receive Invitation</span></a>
                                                        @endif
                                                        <button class="SendMessage btn btni btn-warning sws-top sws-bounce" type="button" data-title="Message"><i class="fal fa-comment-alt-lines"></i> <!-- <span class="ms-md-1">Message</span> --></button>
                                                        <a href="#ChangeSchedulCall" onclick="changeexpertshlot({{$booking->id}},{{$booking->expert_id}})" class="btn btni btn-primary sws-top sws-bounce" data-bs-toggle="modal" data-title="Change Scheduled Call"><i class="fal fa-pencil"></i> <!-- <span class="ms-md-1">Change Scheduled Call</span> --></a>
                                                    @endif
                                                @elseif($booking->reschedule_slot == 0 && $booking->refund == 0)
                                                <small class="text-dark">Not attended by both.</small>
                                                @endif
                                                @if($booking->reschedule_slot > 0)
                                                    <small class="text-danger">New booking (#{{$booking->reschedule->booking_id ?? 0}})</small>
                                                @endif
                                                @if($booking->refund>0)
                                                    <small class="text-success">Refunded &#8377; {{$booking->refund ?? 0}}</small>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p><small><b>NOTE:</b> If you miss any slot by mistake, then you can talk to the administrator on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>.</small></p>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Schedules : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<link rel="preload" as="style" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" onload="this.rel='stylesheet'" integrity="sha512-160haaGB7fVnCfk/LJAEsACLe6gMQMNCM3Le1vF867rwJa2hcIOgx34Q1ah10RWeLVzpVFokcSmcint/lFUZlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
.DataTable{font-size:15px}
table.dataTable{margin:0!important}
.dataTables_wrapper>.row:first-child{margin-bottom:9px!important}
.DataTable>:not(caption)>*>*{padding:.6rem 1rem!important;vertical-align:middle}
.DataTable>thead>tr>th:not(.sorting_disabled),.DataTable>thead>tr>td:not(.sorting_disabled){padding-right:25px!important}
.DataTable>thead>tr>th:first-child{padding-right:1rem!important}
.DataTable>thead>tr>th:first-child:after,.DataTable>thead>tr>th:first-child:before{display:none}
.DataTable>thead .sorting:before,.DataTable>thead .sorting:after{bottom:.7em!important}
.DataTable thead{background:var(--thm);color:var(--white)}
.DataTable thead th{font-weight:500!important}
.DataTable thead .form-check-input[type=checkbox]:after{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 9l4 4l11-12'/%3e%3c/svg%3e")}
.DataTable thead .form-check{align-items:center}
.DataTable .form-check input{margin:0!important}
.DataTable tbody tr{counter-increment:slides-num}
.DataTable tbody tr td:first-child:after,.DataTable tbody tr th:first-child:after{content:" "counter(slides-num)"."}
.badge{font-weight:400!important;font-size:12px!important;line-height:14px!important;border-radius:15px!important}
.btni{height:32px;min-width:32px;padding:0 12px!important; margin:0 0 5px;display:inline-flex!important;justify-content:center;align-items:center;border-radius:20px!important;background:none!important;border-color:transparent!important;color:rgb(var(--blackrgb)/.7)!important;}
.btni:hover,.btni.btn-success{border-color:var(--bs-btn-border-color)!important;background:var(--bs-btn-bg)!important;color:var(--bs-btn-color)!important;}
.btni i{font-size:18px}
.btni span{font-weight:300;font-size:13px}
.btni.disable{opacity:.6;cursor:no-drop}
.btni.disable.btn-success{border-color:#6c757d!important;background-color:#6c757d!important}
.ProTable{display:flex;justify-content:space-between}
.ProTable .img{max-width:45px;height:45px;border-radius:50%;overflow:hidden}
.ProTable .img img{height:100%;width:100%;object-fit:cover}
.ProTable>div:last-child{width:calc(100% - 60px)}
.ProTable h3{font-size:14px;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:2;margin-bottom:3px;line-height:150%!important;font-weight:600!important}
.ProTable p{font-size:13px!important;margin:0;line-height:normal!important;color:rgb(var(--blackrgb)/.6)!important}
.star{margin:0!important;font-size:16px!important}
.TimeBox{margin-top:20px;display:flex;flex-wrap:wrap}
.TimeBox .btn{border-radius:5px;margin-bottom:8px;margin-right:8px;font-weight:500;min-width:35px;padding:5px;color:var(--thm3);background:rgb(var(--thmrgb)/.15)}
.TimeBox>li>:checked[type=radio]+.btn,.TimeBox>li>:checked[type=checkbox]+.btn{background:var(--thm3);color:var(--white);border-color:var(--thm3)}
.btn-check:disabled+.btn,.btn-check[disabled]+.btn{opacity:.5!important}
.btn-back{border:none;border-radius:4px;background:rgb(var(--thmrgb)/.1);padding:3px 9px;font-size:14px}
.modal-dialog.modal-sm{max-width:355px}
@media (max-width:767px){.btni span{display:none}
.UserBox{padding:0!important}
.table-responsive table{white-space:nowrap}
.dataTables_wrapper>.row:first-child>div:first-child{display:none}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div{overflow:auto}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-webkit-scrollbar{width:3px;height:3px;background-color:rgb(var(--blackrgb)/0)}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-webkit-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-moz-scrollbar{width:3px;height:3px;background-color:rgb(var(--blackrgb)/0)}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-moz-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-o-scrollbar{width:3px;height:3px;background-color:rgb(var(--blackrgb)/0)}
.table-responsive .dataTables_wrapper>.row:first-child+.row>div::-o-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}}
</style>

<style>.flatpickr-calendar.inline{margin:0 auto;box-shadow:none}</style>
@endpush
@push('js')
<x-user.footer/>
<div class="Delete modal fade" id="Delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <i class="fal fa-times fa-3x text-danger"></i>
                <h3 class="mb-4">Please confirm to continue</h3>
                <a href="#" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</a>
                <a href="#" class="btn btn-danger">Continue</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade RighSide AddPro" id="ChangeSchedulCall" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ChangeSchedulCallLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form class="modal-content rescheduleform">
            @csrf
            <input type="hidden" name="bookingid">
            <input type="hidden" name="booking_expert">
            <div class="modal-header">
                <h2 class="h5 modal-title" id="ChangeSchedulCallLabel">ReSchedule Call</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body PopupDetail py-3 p-4">
                <div class="sTimeScreen">
                    <div class="ContainBOx">
                        <div class="row justify-content-between">
                            <div class="col-12">
                                {{-- <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Pick the Date</h3> --}}
                                <input type="hidden" onchange="gettimeslots()" class="form-control inlinecal d-none" id="dob" onchange="gettimeslots()" name="booking_date" placeholder="Date of Birth">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h3 class="h4 thm fw-bold timeheadingbox mb-3 justify-content-between align-items-center">Select the Time slot</h3>
                                <div class="SetTimeBox"></div>
                            </div>
                        </div>
                    </div>
                    <div class="position-sticky footerbox border-top">
                        <div class="price m-0 h4">
                            <strong>Price:</strong> 
                            <i class="Ricon">&#8377;</i>
                            <span class="mprice">0</span>/- 
                            <span class="h6">(Per Session)</span>
                        </div>
                        <input type="hidden" name="booking_price" value="0">
                        <button  class="btn btn-thm4 bsbtn m-0">Confirm & Procced <i class="fal fa-chevron-right ms-2"></i></button>
                        <button type="button" class="btn btn-thm4 m-0 bpbtn" style="display: none" disabled><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade RighSide" id="bookinginfo" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ChangeSchedulCallLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            @csrf
            <div class="modal-header">
                <h2 class="h5 modal-title">Schedule Information</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bookinginfobox py-3 p-4">
               <center><i class="fad fa-spinner-third fa-spin" style="font-size: 45px;"></i></center>
            </div>           
        </div>
    </div>
</div>

<script defer type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.11.4/dataTables.bootstrap5.min.js" integrity="sha512-nfoMMJ2SPcUdaoGdaRVA1XZpBVyDGhKQ/DCedW2k93MTRphPVXgaDoYV1M/AJQLCiw/cl2Nbf9pbISGqIEQRmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$(document).ready(function(){
    if ($(window).width() < 991){
        $("#AccMenuBar").removeClass('d-none');
        $("#AccountMenu").addClass('collapse');
    };
    
});
$('.TimeBox.Date .btn-check').click(function() {
    $('.SetTimeBox').show();
    $('.DateBox').hide();
});
$('.SetTimeBox .btn-back').click(function() {
    $('.SetTimeBox').hide();
    $('.DateBox').show();
});
$('[data-bs-type]').on('click',function(){
    let id = $(this).attr('data-bs-id');   
    $('.bookinginfobox').html('<center><i class="fad fa-spinner-third fa-spin" style="font-size: 45px;"></i></center>');
    if($(this).attr('data-bs-type')=='bookinginfo'){
        $('.bookinginfobox').load(@json(url('user/bookinginformation'))+'/'+id);
    }    
});
function changeexpertshlot(bookingid,expertid){
    $('input[name=bookingid]').val(bookingid); 
    $('input[name=booking_expert]').val(expertid);
    gettimeslots(); 
}
function gettimeslots(){
    $('.SetTimeBox').html('<center class="loaderbox my-5"><i class="fad fa-spinner-third fa-spin" style="font-size: 40px;"></i></center>');
    $.ajax({
        data:{_token:$('meta[name=csrf-token]').attr('content'),slot:$('input[name=Sizes]:checked').val(),date:$('input[name=booking_date]').val(),expert:$('input[name=booking_expert]').val()},
        url: @json(route('expertslottimes')),
        method:"Post",
        dataType:"Json",
        success:function(success){
            $('.SetTimeBox').html(success.html);
            $('.mprice').html(success.charges);
            $('input[name=booking_price]').val(success.charges);
            if(success.records==0){ $('.footerbox').hide(); $('.timeheadingbox').hide();}
            if(success.records>0){ $('.footerbox').show(); $('.timeheadingbox').show();}
            flatpickr(".inlinecal",{
                inline:true,
                minDate: "today",
                "disable": [
                    function(date) {
                        return (
                            date.getDay()==success.notavailabile[0] || 
                            date.getDay()==success.notavailabile[1] || 
                            date.getDay()==success.notavailabile[2] || 
                            date.getDay()==success.notavailabile[3] || 
                            date.getDay()==success.notavailabile[4] || 
                            date.getDay()==success.notavailabile[5] || 
                            date.getDay()==success.notavailabile[6]
                        );
                    }
                ]
            });
        }
    });
}

$('.rescheduleform').on('submit',function(e){
        if($('input[name=timing]').is(':checked')==false){ 
            toastr.error('Please select appointment time slot.');
            return false;
        }
        e.preventDefault();
        $('.bsbtn').hide();
        $('.bpbtn').show();
        $.ajax({
            data:new FormData(this),
            url:@json(route('user.bookingrescheduleprocess')),
            method:"Post",
            dataType:"Json",
            contentType:false,
            processData:false,
            success:function(success){
                toastr.success(success.success);
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        });
    });

</script>
@endpush