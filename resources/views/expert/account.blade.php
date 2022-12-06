@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('expert.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Settings</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="card UserBox mb-4">
                        <div class="card-body">
                            <a class="EditText text-primary sws-top sws-bounce" data-title="Edit" id="edit"><i class="far fa-edit"></i> </a>
                            <a class="EditText thm me-4 sws-top sws-bounce" data-title="Save" id="save" style="display:none"><i class="far fa-check"></i></a>
                            <a class="EditText text-danger sws-top sws-bounce" data-title="Cancel" id="cancel" style="display:none"><i class="far fa-times"></i></a>
                            <div class="d-md-flex edittextbox">
                                <div class="PhotoBox me-4">
                                    <label>
                                        <input type="text" class="d-none">
                                        <span>
                                            <x-image-box>
                                                <x-slot:image>{{expertinfo()->profile}}</x-slot:image>
                                                <x-slot:path>/upload/storage/expert/</x-slot:image>
                                                <x-slot:alt>{{expertinfo()->name ?? ''}}</x-slot:image>
                                            </x-image-box>
                                        </span>
                                    </label>Profile Picture
                                </div>
                                <div class="w-100">
                                    <h3 class="h5 thm">Expert Information</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <ul class="prolist AllDetail">
                                                <li><span>Name</span>
                                                    <input type="text" name="age" value="{{expertinfo()->name ?? ''}}" placeholder="Name" class="inputtext noeditt" contenteditable="false" readonly="readonly">
                                                </li>
                                                <li><span>Date of Birth</span>
                                                    <input type="text" name="date" value="February 11, 2022" placeholder="Date of Birth" class="inputtext flatpickr noeditt" contenteditable="false" disabled="disabled" readonly="readonly">
                                                    <!-- <input type="date" name="date" placeholder="dd-mm-yyyy" data-date-format="DD MMMM YYYY" min="1970-01-01" max="2021-12-31" class="inputtext noeditt" contenteditable="false" readonly="readonly"> -->
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <ul class="prolist AllDetail">
                                                <li><span>Email ID <i class="fal fa-badge-check text-success ms-2"></i></span>
                                                    <input type="text" name="age" value="{{expertinfo()->email ?? ''}}" placeholder="Email" class="inputtext noeditt" contenteditable="false" readonly="readonly">
                                                </li>
                                                <li><span>Phone No. <i class="fal fa-badge-check text-success ms-2"></i></span>
                                                    <div class="CountryCode">
                                                        <a class="btn dropdown-toggle inputtext noeditt" contenteditable="false" readonly="readonly" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+91</span></a>
                                                        <ul class="dropdown-menu countrylist">
                                                            
                                                        </ul>
                                                        <input type="number" class="inputtext noeditt" contenteditable="false" readonly="readonly" maxlength="10" oninput="maxLengthCheck(this)" name="mobile" value="{{expertinfo()->mobile ?? ''}}" placeholder="Enter Your Phone No.">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <ul class="prolist AllDetail">
                                                <li><span>Gender</span>
                                                    <div class="radiob">
                                                        <div class="form-check">
                                                            <input type="radio" name="iam" id="Male" class="inputtext" contenteditable="false" readonly="readonly" disabled="disabled">
                                                            <label for="Male">Male</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" name="iam" id="Female" class="inputtext" checked="" contenteditable="false" readonly="readonly" disabled="disabled">
                                                            <label for="Female">Female</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" name="iam" id="Thirdg" class="inputtext" contenteditable="false" readonly="readonly" disabled="disabled">
                                                            <label for="Thirdg">Third Gender</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><hr class="border-secondary m-0 mb-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <ul class="prolist AllDetail">
                                                <li><span>City / District</span>
                                                    <select class="inputtext noeditt" contenteditable="false" readonly="readonly"><option></option></select></li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <ul class="prolist AllDetail">
                                                <li><span>Country</span>
                                                    <select class="inputtext noeditt" contenteditable="false" readonly="readonly"><option></option></select></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="card UserBox mb-4">
                        <div class="card-body">
                            <a href="#updatemodal" data-bs-type="othermodal" data-bs-toggle="modal" class="EditText text-primary sws-top sws-bounce" data-title="Edit" id="edit"><i class="far fa-edit"></i> </a>
                            <div class="d-flex edittextbox w-100">
                                <div class="w-100">
                                    <h3 class="h5 thm m-0">Other Information</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Bio</span>
                                                    {!! expertinfo()->bio ?? '' !!}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Strengths</span>
                                                    {!! expertinfo()->your_strength ?? '' !!}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6 col-lg-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Qualification</span>
                                                    <div class="radiob">
                                                        <div class="form-check mb-2">
                                                            <input type="radio" class="inputtext"  name="Qual" id="Qual1" autocomplete="off" contenteditable="false" readonly="readonly" disabled="disabled">
                                                            <label for="Qual1">{{expertinfo()->qualification->title ?? ''}}</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Currently Working as</span>
                                                    <div class="radiob">
                                                        <div class="form-check mb-2">
                                                            <input type="radio" class="inputtext" name="curr" id="curr1" autocomplete="off" contenteditable="false" readonly="readonly" disabled="disabled">
                                                            <label for="curr1">{{expertinfo()->workingas->title}}</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6 col-lg-6 mt-3">
                                            <!-- <p class="mb-1"><strong>What is your Domain/Area of Expertise?</strong></p> -->
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Area of Expertise</span>
                                                    {{expertinfo()->expertise->title ?? ''}}
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        @if(!empty(expertinfo()->fluent_language))
                                        <div class="col-6 mt-3">
                                            <!-- <p class="mb-1"><strong>In which language you are most Fluent?</strong></p> -->
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Language</span>
                                                    <div class="radiob">
                                                        @foreach(json_decode(expertinfo()->fluent_language) as $language)
                                                        @php $language = \App\Models\Language::find($language); @endphp
                                                        <div class="form-check mb-2">
                                                            <input type="checkbox" class="inputtext" name="lang" id="lang1" autocomplete="off" contenteditable="false" readonly="readonly" disabled="disabled">
                                                            <label for="lang1">{{$language->title ?? ''}}{{!$loop->last?', ':''}}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif

                                        @if(!empty(expertinfo()->suitable_industry))
                                        <div class="col-12 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Industries</span>
                                                    <div class="radiob">
                                                        @foreach(json_decode(expertinfo()->suitable_industry) as $industry)
                                                        @php $industry = \App\Models\Industry::find($industry); @endphp
                                                        <div class="form-check mb-2">
                                                            <input type="checkbox" class="inputtext" name="ind" id="ind2" autocomplete="off" contenteditable="false" readonly="readonly" disabled="disabled">
                                                            <label for="ind2">{{$industry->title ?? ''}}{{!$loop->last?', ':''}}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="card UserBox mb-4">
                        <div class="card-body">
                            <a class="EditText text-primary sws-top sws-bounce" data-title="Edit" id="edit"><i class="far fa-edit"></i> </a>
                            <a class="EditText thm me-4 sws-top sws-bounce" data-title="Save" id="save" style="display:none"><i class="far fa-check"></i></a>
                            <a class="EditText text-danger sws-top sws-bounce" data-title="Cancel" id="cancel" style="display:none"><i class="far fa-times"></i></a>
                            <div class="d-flex edittextbox w-100">
                                <div class="w-100">
                                    <h3 class="h5 thm m-0">Firm Details</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Company Name</span>
                                                    <input type="text" name="cname" value="" placeholder="Enter Company Name" class="inputtext noeditt" contenteditable="false" readonly="readonly">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>Business Structure</span>
                                                    <select class="form-control form-select inputtext noeditt" class="inputtext noeditt" contenteditable="false" readonly="readonly">
                                                        <option disabled="" selected="">Select your answer</option>
                                                        <option>Marketing Strategy</option>
                                                        <option>Business Strategy</option>
                                                        <option>Social Media Marketing</option>
                                                        <option>Digital Marketing</option>
                                                        <option>Business Development</option>
                                                        <option>Start-ups</option>
                                                        <option>Online Marketing</option>
                                                        <option>Strategic Planning</option>
                                                        <option>New Business Development</option>
                                                    </select></li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>PAN Number</span>
                                                    <input type="text" name="cname" value="" placeholder="Enter PAN No." class="inputtext noeditt" contenteditable="false" readonly="readonly">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-3">
                                            <ul class="prolist AllDetail">
                                                <li class="d-block"><span>TAN Number</span>
                                                    <input type="text" name="gstno" value="" placeholder="Enter TAN No." class="inputtext noeditt" contenteditable="false" readonly="readonly">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="card UserBox mb-4">
                        <div class="card-body">
                            <div class="d-flex edittextbox w-100">
                                <div class="w-100">
                                    <h3 class="h5 thm">Notifications</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-check d-flex justify-content-between align-items-center h4 form-switch border border rounded p-3">
                                                <label class="form-check-label order-first" for="emailn"><h3 class="h6 thm m-0">Email Notification</h3>
                                                <p class="lh-n m-0 h6 text-secondary fw-light"><small>Turn on email notification to get updates through email id</small></p></label>
                                                <input class="form-check-input m-0" type="checkbox" role="switch" id="emailn">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-check d-flex justify-content-between align-items-center h4 form-switch border border rounded p-3">
                                                <label class="form-check-label order-first" for="mobilen"><h3 class="h6 thm m-0">Mobile Notification</h3>
                                                <p class="lh-n m-0 h6 text-secondary fw-light"><small>Turn on Mobile notification to get updates through Mobile</small></p></label>
                                                <input class="form-check-input m-0" type="checkbox" role="switch" id="mobilen">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="card UserBox">
                        <div class="card-body">
                            <div class="d-flex edittextbox w-100">
                                <div class="w-100">
                                    <h3 class="h5 thm">Profile Setting</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-check d-flex justify-content-between align-items-center h4 form-switch border border rounded p-3">
                                                <label class="form-check-label order-first" for="prov"><h3 class="h6 thm m-0">Profile Visibility</h3>
                                                <p class="lh-n m-0 h6 text-secondary fw-light"><small>Turn On/Off your profile</small></p></label>
                                                <input class="form-check-input m-0" type="checkbox" role="switch" id="emailn">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-check d-flex justify-content-between align-items-center h4 form-switch border border rounded p-3">
                                                <label class="form-check-label order-first" for="deletea"><h3 class="h6 thm m-0">Delete My Account</h3>
                                                <p class="lh-n m-0 h6 text-secondary fw-light"><small>My account delete permanently</small></p></label>
                                                <input class="form-check-input m-0" type="checkbox" role="switch" id="mobilen">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-3">
                                            <div class="form-check d-flex justify-content-between align-items-center h4 form-switch border border rounded p-3">
                                                <label class="form-check-label order-first" for="deletea"><h3 class="h6 thm m-0">Videos Visibility</h3>
                                                <p class="lh-n m-0 h6 text-secondary fw-light"><small>Turn On/Off your videos</small></p></label>
                                                <input class="form-check-input m-0" type="checkbox" role="switch" id="mobilen">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>My Account : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<style type="text/css">
.prolist{padding:0;margin-bottom:0;width:100%;font-size:15px;/*align-items:flex-start;display:flex;justify-content:flex-start;flex-wrap:wrap;*/}
.prolist>li,.prolist>li>label{position:relative;padding:0;font-size:14px;display:flex;align-items:center;justify-content:flex-start;color:#222;margin-bottom:9px}
.prolist>li>i{width:32px;color:rgb(var(--blackrgb)/.5);display:flex;align-items:center;position:absolute;right:0;top:0;bottom:0;margin:auto}
.EditText{font-size:15px;position:absolute!important;cursor:pointer;right:0;top:0;font-weight:600;border:none;background:none}
.AllDetail>li>span:first-child,.AllDetail li>label>span:first-child{min-width:128px;color:#666;font-weight:600;justify-content:flex-start;display:flex;align-items:baseline;margin-right:10px}
.AllDetail>li>span:first-child:after,.AllDetail li>label>span:first-child:after{content:':';margin-left:5px}
.AllDetail>li.d-block>span:first-child{justify-content:flex-start}
.AllDetail>li.d-block>span:first-child:after{margin-left:5px}
.AllDetail>li>span:empty:first-child:after{display:none}
.AllDetail>li>span>span{width:15px}
.AllDetail>li>span i{font-size:15px}
.AllDetail>li .noeditt~.chosen-container .chosen-single,.AllDetail>li .noeditt~.chosen-container-multi .chosen-choices{border:none!important;padding-left:0!important;cursor:text!important}
.AllDetail>li .noeditt~.chosen-container .chosen-single div b,.AllDetail>li .noeditt~.chosen-container-multi .chosen-choices li a{background:none!important}
.AllDetail>li .noeditt~.chosen-container .chosen-drop,.AllDetail>li .noeditt~.chosen-container-multi .chosen-choices li:last-child:after,.edittextbox .inputtext[contenteditable="false"]~.ck-editor .ck-reset_all{display:none!important}
.AllDetail>li .noeditt~.chosen-container-multi .chosen-choices li{box-shadow:none!important}
.AllDetail>li .noeditt~.chosen-container-multi .chosen-choices li:after{content:','}
.AllDetail>li .noeditt~.chosen-container-multi .chosen-choices li span{background:none!important;padding:3px 0!important;font-size:14px!important;color:var(--black)!important;cursor:text!important}
.AllDetail>li>span~.inputtext,.AllDetail .inputtext{/*width:calc(100% - 170px)!important;*/min-width:15%!important;min-height:24px}
.edittextbox .inputtext[contenteditable="false"]~.ck-editor .ck-content{border:none!important;padding:0!important;box-shadow:none!important}
.edittextbox .inputtext[contenteditable="false"]~.ck-editor .ck-content p{margin:0!important}
.AllDetail .inputtext{width:100%!important;border-radius:.25rem!important}
/*.AllDetail .inputtext~.inputtext{margin-left:15px}*/
.AllDetail .inputtext.flatpickr~.inputtext,.AllDetail .inputtext[type="text"]~.inputtext[type="number"]{margin-left:0}
.AllDetail .inputtext.ConCode{max-width:50px!important;min-width:50px!important}
.AllDetail .inputtext.flatpickr.inputtext[readonly="readonly"]~.inputtext.inputtext[readonly="readonly"]{background:none!important;font-size:14px}
.inputtext[readonly="readonly"],.inputtext[readonly=""],select.inputtext[contenteditable="false"],.inputtext[contenteditable="false"]{border:none;width:100%;resize:none;overflow:hidden;padding:2px 0;background-color:transparent;background-image:none;}
.radiob .inputtext[disabled="disabled"]+label:before{height:0;min-width:0;margin:0;border:none}
.inputtext[readonly="readonly"] ~ i,.inputtext[readonly=""] ~ i{display:none}
.inputtext[type="password"][readonly="readonly"]{min-height:2px!important;max-height:26px!important}
select.inputtext.noeditt{pointer-events:none;border:none;width:100%;overflow:hidden;padding:2px 0;-moz-appearance:none;-webkit-appearance:none;appearance:none}
.inputtext[contenteditable="true"],select.inputtext[contenteditable="true"],.radiob .inputtext[contenteditable="true"]~label{border:1px solid #ddd;min-width:80%;padding:2px 5px;min-height:36px!important}
textarea.inputtext{width:100%;/*height:120px*/}

.PhotoBox{font-size:13px;text-align:center}
.PhotoBox label{display:block;margin-bottom:9px}
.PhotoBox label>span{border-radius:50%;height:99px;width:99px;display:inline-block;border:1px solid rgb(var(--blackrgb)/.2);position:relative;padding:2px;overflow:hidden}
.PhotoBox label>span:after{position:absolute;height:100%;width:100%;left:0;top:0;color:var(--thm1);display:flex;align-items:center;justify-content:center;font-size:33px;border-radius:50%;background:rgb(var(--whitergb)/.8);content:'\f030';font-family:"Font Awesome 5 Pro";opacity:0;visibility:hidden;transition:all .5s}
.PhotoBox input[type=file] ~ span{cursor:pointer}
.PhotoBox input[type=file] ~ span:hover:after{opacity:1;visibility:visible}
.PhotoBox img{border-radius:50%;width:100%;height:100%;object-fit:contain}

.form-check-input:disabled{overflow:inherit}
.radiob,.checkb{display:inline-flex;flex-wrap:wrap;overflow:hidden}
.radiob label,.checkb label{width:100%;margin:0;/*padding:9px!important;*/background:var(--white);font-size:14px;font-weight:500;transition:all .5s}
.checkb .form-check-input{padding:0;min-width:1em!important;;width:auto!important;min-height:1em!important;border-radius:2px!important}
.checkb .form-check-input.inputtext[readonly="readonly"]{border:1px solid rgb(var(--blackrgb)/.25)}
.checkb .form-check-input:disabled{opacity:1!important;background-color:rgb(var(--blackrgb)/.08)}
.checkb .form-check-input.inputtext[contenteditable="true"]{border-color:var(--thm)}
.radiob label:after{height:100%;width:100%;z-index:-1}
.radiob label:before{content:'';height:16px;min-width:16px;background-color:rgb(var(--blackrgb)/.08);border:1px solid rgb(var(--blackrgb)/.2);background-position:center;background-repeat:no-repeat;background-size:0!important;background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%231b4d64' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 9l4 4l11-12'/%3e%3c/svg%3e");margin-right:5px;border-radius:2px;transition:all .3s}
.radiob label i{margin-right:6px;font-size:18px;vertical-align:top;color:#d10908;transition:all .5s}
.radiob input[type="radio"]:empty,.radiob input[type="checkbox"]:empty{display:none}
.radiob input[type="radio"]:empty~label,.radiob input[type="checkbox"]:empty~label{position:relative;cursor:pointer;display:flex;font-size:13px;justify-content:start;align-items:center;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;padding:.2rem .6rem;width:100%}

.radiob input[type="radio"]:empty~label:after,.radiob input[type="checkbox"]:empty~label:after{position:absolute;display:block;top:0;bottom:0;left:0;content:''}
.radiob input[type="radio"]:disabled~label,.radiob input[type="checkbox"]:disabled~label{border:none!important;padding-left:0;padding-right:.2rem}
.radiob input[type="radio"]:checked~label,.radiob input[type="checkbox"]:checked~label{color:var(--white);padding-left:.6rem;padding-right:.6rem;z-index:1}
/*.radiob input[type="radio"]:checked:disabled~label,.radiob input[type="checkbox"]:checked:disabled~label{color:var(--black)}*/
.radiob input[type="radio"]:checked~label:before,.radiob input[type="radio"]:checked:disabled~label:before,.radiob input[type="checkbox"]:checked~label:before,.radiob input[type="checkbox"]:checked:disabled~label:before{background-color:rgb(var(--whitergb)/.4);background-size:100%!important;background-position:center;border:none;background-repeat:no-repeat;background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 19 19'%3e%3cpath fill='none' stroke='%231b4d64' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 9l4 4l11-12'/%3e%3c/svg%3e")}
/*.radiob input[type="radio"]:checked:disabled~label:before,.radiob input[type="checkbox"]:checked:disabled~label:before{background-color:rgb(var(--blackrgb)/.08);border:1px solid rgb(var(--blackrgb)/.2)}*/
.radiob input[type="radio"]:focus~label:after,.radiob input[type="checkbox"]:focus~label:after{box-shadow:0 0 0 3px #999}
.checkb input[type="checkbox"]:empty~label{padding:0 1rem 1rem 0}
.radiob .inputtext[contenteditable="true"]~label{border:none;padding:0 9px!important}
.radiob .form-check,.checkb .form-check{min-width:20px;padding:0;margin:0;margin-right:8px}
.radiob .form-check:last-child,.checkb .form-check:last-child{margin:0!important}
.radiob .form-check input[type="radio"]:checked~label:after,.radiob .form-check input[type="checkbox"]:checked~label:after{color:var(--white);background-color:var(--thm);border-radius:4px}
/*.radiob .form-check input[type="radio"]:disabled~label:after,.radiob .form-check input[type="checkbox"]:disabled~label:after{background-color:transparent}*/
.radiob .form-check input[type="radio"]:checked~label i,.radiob .form-check input[type="checkbox"]:checked~label i{color:var(--white)}

.form-check.form-switch .form-check-input:checked{background-color:var(--thm);border-color:var(--thm)}

.CountryCode{display:flex;width:100%}
.CountryCode a.inputtext{display:flex;align-items:center;line-height:normal!important;font-size:14px;min-width:40px!important;width:auto!important;padding-right:5px;border-radius:.25rem 0 0 .25rem!important}
.CountryCode a.inputtext span:after,.CountryCode a:after{display:none!important}
.CountryCode a.inputtext~.inputtext{border-radius:0 .25rem .25rem 0!important;border-left:none!important}
.CountryCode a.inputtext[contenteditable="true"]:after{display:block}
.CountryCode a.inputtext[contenteditable="true"]{width:80px}
.CountryCode>.countrylist{padding:0;max-height:200px;overflow:auto;background:var(--white);right:auto!important;left:0!important}
.CountryCode a span{font-size:14px!important}
.countrylist li{padding:5px 12px;cursor:pointer;font-size:14px;padding-right:70px;white-space:nowrap}
.countrylist li i{margin-right:5px;position:static!important}
.countrylist li span{font-size:12px;color:rgb(var(--blackrgb)/.5);position:absolute;right:12px}
.countrylist li:hover{background:rgb(var(--blackrgb)/.08)}

@media only screen and (max-width:991px){.Profile .container,.PhotoBox{width:100%}
.Profile .card>div .d-flex.edittextbox{flex-wrap:wrap}}
@media only screen and (max-width:767px){.Profile>.container>.row:last-child>div:first-child,.Profile>.container>.row:last-child>div:last-child{width:100%}
.AllDetail>li>span:first-child,.AllDetail li>label>span:first-child{font-size:13px;min-width:120px;display:inline-block}
.AllDetail>li>span~.inputtext, .AllDetail .inputtext{font-size:13px}
.prolist li,.prolist li>label{flex-wrap:wrap}
.prolist li>span,.prolist li>label>span{width:100%;display:block}
.AllDetail>li>span~.inputtext,.AllDetail .inputtext{width:100%}}
</style>
@endpush
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        if ($(window).width() < 991){
            $("#AccMenuBar").removeClass('d-none');
            $("#AccountMenu").addClass('collapse');
        };
        $('.CountryCode .dropdown-menu').find('li').click(function(e) {
            e.preventDefault();
            var spa = $(this).data('text');
            $('.CountryCode #CountryName').text(spa);
        });
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>flatpickr(".flatpickr",{altInput:true, altFormat:"F j, Y", dateFormat:"Y-m-d"});</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#edit').click(function(){
            $(".edittextbox .inputtext").attr("contenteditable", true);
            $(".edittextbox .inputtext").attr("readonly", false);
            $(".edittextbox .inputtext.flatpickr").attr("disabled", false);
            $(".edittextbox .form-check input.inputtext").attr("disabled", false);
            $(".edittextbox .inputtext.date").attr("type", 'date');
            $(".edittextbox .PhotoBox input").attr("type", 'file');
            $(".edittextbox select.inputtext").removeClass('noeditt');
            $(".edittextbox .AllDetail>li>small").show();
            $("#edit").hide();
            $("#save").show();
            $("#cancel").show();
        });
        $('#save').click(function(){
            $(".edittextbox .inputtext").attr("contenteditable", false);
            $(".edittextbox .inputtext").attr("readonly", true);
            $(".edittextbox .inputtext.flatpickr").attr("disabled", true);
            $(".edittextbox .form-check input.inputtext").attr("disabled", true);
            $(".edittextbox .inputtext.date").attr("type", 'text');
            $(".edittextbox .PhotoBox input").attr("type", 'text');
            $(".edittextbox select.inputtext").addClass('noeditt');
            $(".edittextbox .AllDetail>li>small").hide();
            $("#save").hide();
            $("#cancel").hide();
            $("#edit").show();
        });
        $('#cancel').click(function(){
            $(".edittextbox .inputtext").attr("contenteditable", false);
            $(".edittextbox .inputtext").attr("readonly", true);
            $(".edittextbox .inputtext.flatpickr").attr("disabled", true);
            $(".edittextbox .form-check input.inputtext").attr("disabled", true);
            $(".edittextbox .inputtext.date").attr("type", 'text');
            $(".edittextbox .PhotoBox input").attr("type", 'text');
            $(".edittextbox select.inputtext").addClass('noeditt');
            $(".edittextbox .AllDetail>li>small").hide();
            $("#save").hide();
            $("#cancel").hide();
            $("#edit").show();
        });
    });
    $('[data-bs-type]').on('click',function(e){
        if($(this).attr('data-bs-type')=='othermodal'){
            $('.modal-content').html('<div class="text-center p-4"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>');
            $('.modal-content').load(@json(route('expert.otherinformation')));
        }
    })
</script>
<link rel="preload" as="style" href="{{asset('frontend/css/flag-icons.min.css')}}" onload="this.rel='stylesheet'">
<div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center p-4">
                <i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i>
            </div>
        </div>
    </div>
</div>
@endpush