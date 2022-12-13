@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Expert Booking</a></li>
            </ol>
            <div class="row">
                <div class="col-12">
                    <h1 class="h3 text-center thm">Request a time</h1>
                    <div class="card ExpertBOx rounded-3 bg-light border">
                        <div class="card-body">
                            <div class="img rounded-circle border">
                                <x-image-box>
                                    <x-slot:image>{{$lists->expert->profile}}</x-slot:image>
                                    <x-slot:path>/uploads/expert/</x-slot:image>
                                    <x-slot:alt>{{$lists->expert->name ?? ''}} {{!empty($lists->expert->expertise->title) ? '('.$lists->expert->expertise->title.')' : ''}} </x-slot:image>
                                    <x-slot:width>380</x-slot:image>
                                    <x-slot:height>480</x-slot:image>
                                </x-image-box>
                            </div>
                            <div class="text">
                                <h3 class="h5 text-black verify">{{$lists->expert->name ?? ''}}</h3>
                                @if(!empty($lists->expert->suitable_industry))
                                <span class="text-secondary">
                                    @foreach(json_decode($lists->expert->suitable_industry) as $industry)
                                        @php $industry = \App\Models\Industry::find($industry); @endphp
                                        {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                    @endforeach     
                                </span>
                                @endif
                                <div class="thm"><span class="star" data-title="4"></span> 5.0 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7">
                    <div class="CustomerInfo">
                        <h2 class="mt-5 h4 text-center">Fill Your Information</h2>
                        <p class="text-secondary">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <input type="text" class="form-control inputTextBox" name="name" value="{{userinfo()->name ?? ''}}" placeholder="Your Name.">
                        <span class="name-error error"></span>
                        <div class="input-group mt-3">
                            <input type="email" class="form-control" name="email" value="{{userinfo()->email ?? ''}}" placeholder="Enter Email.">
                        </div>
                        <span class="email-error error"></span>
                        <button class="btn btn-sm formbtn m-auto mt-3 mvsbtn bookingemailformbtn" type="button">Next <i class="fal fa-arrow-right ms-2"></i></button>
                        <button class="btn btn-sm formbtn m-auto mt-3 mvpbtn" disabled style="display: none" type="button"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                    </div>
                    <div class="OTPbox" style="display:none;">
                        <h3 class="mt-5 h5 text-center">OTP Verification</h3>
                        {{-- <div class="text-center mt-4"><i><small>Sent to <strong>avd******.com</strong></small></i></div> --}}
                        <div class="text-center">
                            <div id="otp" class="input-group justify-content-center">
                                <input type="hidden" name="oldemailotp">
                                <input class="m-1 text-center form-control otpn" type="text" name="bookemailotp1" onkeypress="return isNumber(event)" maxlength="1">
                                <input class="m-1 text-center form-control otpn" type="text" name="bookemailotp2" onkeypress="return isNumber(event)" maxlength="1">
                                <input class="m-1 text-center form-control otpn" type="text" name="bookemailotp3" onkeypress="return isNumber(event)" maxlength="1">
                                <input class="m-1 text-center form-control otpn" type="text" name="bookemailotp4" onkeypress="return isNumber(event)" maxlength="1">
                            </div>
                            <small class="otp-error error"></small>
                            <div class="m-resendcounter"><small>Resend OTP in <strong id="m-seconds-counter">30s</strong></small></div>
                            <div class="m-resendemail" style="display: none;"><small><a href="javascript:void();" class="bookingresendemailformbtn">Resend OTP</a></small></div>
                            <button class="btn btn-sm formbtn mvcsbtn m-auto mt-2"  type="button">Verify <i class="fal fa-arrow-right ms-2"></i></button>
                            <button class="btn btn-sm formbtn mvcpbtn m-auto mt-2 disabled" style="display:none;" type="button"><i class="fad fa-spinner-third fa-spin me-1"></i> verifing...</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-img">
            <img src="{{asset('frontend/img/bg-img-l.svg')}}" width="450" height="500">
            <img src="{{asset('frontend/img/bg-img-r.svg')}}" width="450" height="500">
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Expert Booking : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
.ExpertBOx{width:450px;margin:20px auto 0;}
.ExpertBOx>div{display:flex;justify-content:center;}
.ExpertBOx .img{height:90px; min-width:90px;overflow:hidden;}
.ExpertBOx .img img{height:100%;width:100%;object-fit:contain;}
.ExpertBOx .text{width:calc(100% - 90px);margin-left:20px;}
.ExpertBOx .text .star{font-size:18px!important;}
.CountryCode a{border:1px solid #e1e1e1;display:flex;align-items:center;line-height:normal!important;background:var(--white)!important;padding:9px 25px;border-radius:30px;}
.CountryCode a:after{font-size:18px}
.CountryCode a span{max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;font-size:18px!important;text-transform:uppercase}
.CountryCode a span:after{display:none}
.CountryCode .CountryCode{max-width:66px;text-align:center;padding:0!important}
.CountryCode>.form-control,.CustomerInfo .form-control{height:calc(3rem + 2px);border-radius:0 30px 30px 0!important;font-size:18px;padding:0 20px;}
.CustomerInfo .form-control{border-radius:30px!important;}
.CountryCode>.countrylist{padding:0;max-height:200px;overflow:auto;background:var(--white);right:auto!important;left:0!important}
.formbtn{height:50px;min-width:50px!important;max-width:130px;width:auto!important;display:flex;align-items:center;border-radius:35px!important;border:1px solid var(--thm)!important;font-size:22px!important;color:var(--thm)!important}
.formbtn.btn-sm{font-size:16px!important;padding:0 15px;height:36px}
.otpn{height:50px;max-width:50px!important;border-radius:9px!important;padding:0!important;font-size:18px!important}
.formbtn:hover{background:var(--thm)!important;color:var(--white)!important;}
section.grey>div{z-index:2;position:relative;}
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:-9%;width:100%;height:auto;z-index:1;}
</style>
@endpush
@push('js')
<script type="text/javascript">
    // $('.CustomerInfo .formbtn').click(function() {
    //     $('.CustomerInfo').hide();
    //     $('.OTPbox').show();
    // });
    $(".otpn").bind("input", function() {
        var $this = $(this);
        setTimeout(function() {
            if ( $this.val().length >= parseInt($this.attr("maxlength"),6))
                $this.next("input").focus();
        },0);
    });

    $('.bookingemailformbtn').on('click',function(){   
        sendBookingEmailVerificationotp();   
    });
    $('.bookingresendemailformbtn').on('click',function(){
        sendBookingEmailVerificationotp();
    });
    function sendBookingEmailVerificationotp(){
        let email = $('input[name=email]').val();
        let name = $('input[name=name]').val();
        $('.error').html('');
        $('.mvsbtn').hide();
        $('.mvpbtn').show();
        $.ajax({
            data:{email:email,name:name,_token:$('meta[name=csrf-token]').attr('content')},
            dataType:'Json',
            method:'POST',
            url:@json(route('checkbookingemail')),
            success:function(success){
                toastr.success(success.success);
                $(this).hide();
                $('.OTPbox').show();
                $('.CustomerInfo').hide();
                $('input[name=oldemailotp]').val(success.otp);            
                $('.m-resendcounter').show(); 
                $('.m-resendemail').hide();
                $('.mvsbtn').show();
                $('.mvpbtn').hide();
                var cancel = setInterval(incrementSeconds, 1000); 
                var seconds = 30;
                var el = document.getElementById('m-seconds-counter');
                function incrementSeconds() {
                    seconds = Number(seconds) - 1;
                    el.innerText = seconds + "s";
                    if(seconds==0){ clearInterval(cancel); $('#m-seconds-counter').html('30s'); $('.m-resendcounter').hide(); $('.m-resendemail').show(); }
                }                  
            },
            error:function(error){
                if(error.responseJSON.errors.email!==undefined){
                    $('.email-error').text(error.responseJSON.errors.email);
                }
                if(error.responseJSON.errors.name!==undefined){
                    $('.name-error').text(error.responseJSON.errors.name);
                }
                $('.mvsbtn').show();
                $('.mvpbtn').hide();
            }
        });
    }
    $('.mvcsbtn').on('click',function(){
        let O1 = $('input[name=bookemailotp1]').val();
        let O2 = $('input[name=bookemailotp2]').val();
        let O3 = $('input[name=bookemailotp3]').val();
        let O4 = $('input[name=bookemailotp4]').val();
        let oldotp = $('input[name=oldemailotp]').val();
        $('.error').html('');
        $('.mvcsbtn').hide();
        $('.mvcpbtn').show();    
        let otp = O1+O2+O3+O4;
        if(isNaN(parseInt(O1))==true){
            $('input[name=bookemailotp1]').focus();
            $('.mvcsbtn').show();
            $('.mvcpbtn').hide();
        }
        else if(isNaN(parseInt(O2))==true){
            $('input[name=bookemailotp2]').focus();
            $('.mvcsbtn').show();
            $('.mvcpbtn').hide();
        }
        else if(isNaN(parseInt(O3))==true){
            $('input[name=bookemailotp3]').focus();
            $('.mvcsbtn').show();
            $('.mvcpbtn').hide();
        }
        else if(isNaN(parseInt(O4))==true){
            $('input[name=bookemailotp4]').focus();
            $('.mvcsbtn').show();
            $('.mvcpbtn').hide();
        }
        else if(oldotp!=otp){ 
            $('.otp-error').html('Invalid OTP!');
            $('input[name=bookemailotp1]').val('');
            $('input[name=bookemailotp2]').val('');
            $('input[name=bookemailotp3]').val('');
            $('input[name=bookemailotp4]').val('');
            $('.mvcsbtn').show();
            $('.mvcpbtn').hide();
        }else{
            window.location.href=@json(url('payment'))+'/'+@json($lists->booking_id);
        }
    });
</script>
@endpush