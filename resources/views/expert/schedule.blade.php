@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('expert.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Scheduled Calls</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="" method="post" class="card UserBox">
                        <div class="card-body">
                            @if($bookings->count()==0)
                            <div class="mt-0 mb-4 text-center w-100"> <x-data-not-found data="Schedules"/> </div>
                            @endif

                            @if($bookings->count() > 0)
                            <div class="table-responsive w-100 mt-2 mb-1">
                                <table class="DataTable table table-striped w-100">
                                    <colgroup>
                                        <col width="7%">
                                        <col width="30%">
                                        <col width="20%">
                                        <col width="7%">
                                        <col width="7%">
                                        <col width="30%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Information</th>
                                            <th>Schedule</th>
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
                                                <div class="ProTable">
                                                    <div class="">
                                                        <h3>{{$booking->user_name ?? ''}}</h3>
                                                        <p><b>Email:</b> {{$booking->user_email ?? ''}}</p>
                                                        <p><b>Contact:</b> {{$booking->user_number ?? ''}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <small>Booking No: <b>#{{$booking->booking_id}}</b></small>
                                                <small>Date: <b>{{date('l, d M Y',strtotime($booking->booking_date))}}</b></small>
                                                <small>Time: <b>{{substr($booking->booking_start_time,0,-3)}} To {{substr($booking->booking_end_time,0,-3)}}</b></small>
                                            </td>
                                            <td>
                                                <small class="text-secondary">{{$booking->payment==0?'Incomplete Process':''}}</small>
                                                <small class="text-success">{{$booking->payment==1?'Paid':''}}</small>
                                                <small class="text-danger">{{$booking->payment==2?'Failed':''}}</small>
                                            </td>
                                            <td>
                                                <small class="text-secondary">{{$booking->status==0?'New':''}}</small>
                                                <small class="text-success">{{$booking->status==1?'Confirm':''}}</small>
                                            </td>
                                            <td class="text-end">
                                                <!-- <a href="experts-intro.php" class="btn btni btn-info sws-top sws-bounce" data-title="View Expert Detail"><i class="fal fa-file-search"></i> <span class="ms-md-1">Expert Detail</span></a> -->
                                                <a href="#" class="btn btni btn-success sws-top sws-bounce" data-title="Invite Call"><i class="fal fa-clock"></i> <span class="ms-md-1"></span></a>
                                                <button class="SendMessage btn btni btn-warning sws-top sws-bounce" type="button" data-title="Message"><i class="fal fa-comment-alt-lines"></i> <!-- <span class="ms-md-1">Message</span> --></button>
                                                <a href="#ChangeSchedulCall" class="btn btni btn-primary sws-top sws-bounce" data-bs-toggle="modal" data-title="Change Scheduled Call"><i class="fal fa-pencil"></i> <!-- <span class="ms-md-1">Change Scheduled Call</span> --></a>
                                                <a href="#Delete" data-bs-toggle="modal" class="btn btni btn-danger sws-top sws-bounce" data-title="Cancel Call"><i class="fal fa-times"></i> <!-- <span class="ms-md-1">Cancel Call</span> --></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Scheduled Calls : {{project()}}</title>
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
@endpush
@push('js')
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
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content">
            <div class="modal-header">
                <h2 class="h5 modal-title" id="ChangeSchedulCallLabel">ReSchedule Call</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body PopupDetail py-3 p-4">
                <div class="DateBox">
                    <h3 class="h4 text-center thm">Select Date</h3>
                    <h4 class="h6 mt-2 d-flex justify-content-between"><strong>August</strong> <a href="" class="text-primary"><small>Deselect</small></a></h4>
                    <ul class="p-0 mb-0 TimeBox Date">
                        <li><input type="radio" class="btn-check" name="dates" id="sd1"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 1" for="sd1">1</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd2"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 2" for="sd2">2</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd3" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 3" for="sd3">3</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd4"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 4" for="sd4">4</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd5"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 5" for="sd5">5</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd6"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 6" for="sd6">6</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd7"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 7" for="sd7">7</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd8" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 8" for="sd8">8</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd9"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 9" for="sd9">9</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd10"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 10" for="sd10">10</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd11" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 11" for="sd11">11</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd12" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 12" for="sd12">12</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd13"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 13" for="sd13">13</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd14"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 14" for="sd14">14</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd15"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 15" for="sd15">15</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd16"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 16" for="sd16">16</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd17"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 17" for="sd17">17</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd18"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 18" for="sd18">18</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd19"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 19" for="sd19">19</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd20" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 20" for="sd20">20</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd21"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 21" for="sd21">21</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd22" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 22" for="sd22">22</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd23"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 23" for="sd23">23</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd24"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 24" for="sd24">24</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd25"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 25" for="sd25">25</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd26" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 26" for="sd26">26</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd27"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 27" for="sd27">27</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd28"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 28" for="sd28">28</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd29" disabled><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 29" for="sd29">29</label></li>
                        <li><input type="radio" class="btn-check" name="dates" id="sd30"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Wednesday, Aug 30" for="sd30">30</label></li>
                    </ul>
                </div>
                <div class="SetTimeBox" style="display:none">
                    <div class="text-end"><button type="button" class="btn-back"><i class="fal fa-angle-left"></i> Back</button></div>
                    <h4 class="h6 mt-1 d-flex justify-content-between">Wednesday, Aug 23 <a href="" class="text-primary"><small>Deselect</small></a></h4>
                    <ul class="p-0 TimeBox">
                        <li><input type="radio" class="btn-check" name="timing" id="t1"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t1">8-9 PM</label></li>
                        <li><input type="radio" class="btn-check" name="timing" id="t2" disabled><label class="btn" for="t2">9-10 PM</label></li>
                        <li><input type="radio" class="btn-check" name="timing" id="t3"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t3">10-11 PM</label></li>
                        <li><input type="radio" class="btn-check" name="timing" id="t4"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t4">11-12 PM</label></li>
                    </ul>
                </div>
            </div>
        </form>
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
</script>
@endpush