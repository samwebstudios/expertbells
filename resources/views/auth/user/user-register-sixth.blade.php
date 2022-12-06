@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">User Sign Up</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-10">
                    <!-- <label for="lemail" class="form-label mb-0 ms-3"><small>Phone No.</small></label> -->
                    <div class="row align-items-end">
                        <div class="col-12 text-center">
                            <h1 class="mt-2 h6 text-secondary mb-3">Steps 6 out of 6</h1>
                            <h2 class="mt-2 h3 thm mb-3">What is your #1 growth challenge right now?</h2>
                        </div>
                    </div>
                    <form action="{{route('user.saveusersetp6')}}" method="post" class="card card-body formbox">
                        @csrf
                        <textarea class="form-control" name="growth_challenge"></textarea>
                        @error('growth_challenge')<small class="error">{{$message}}</small>@enderror
                        <div class="text-center">
                            <button type="submit" onclick="$('.sbtn').hide(); $('.pbtn').show();" class="btn formbtn btn-thm2 sbtn">Next <i class="fas fa-angle-double-right"></i></button>
                            <button type="button" class="btn formbtn btn-thm2 pbtn disabled" style="display: none;"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                        </div>
                    </form>
                    <a href="{{route('user.userregister5')}}" class="btn formbtn btn-sm btn-thm3"><i class="fal fa-arrow-left m-0 me-2"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="bg-img">
            <img src="{{asset('frontend/img/bg-img-l.svg')}}" width="450" height="500">
            <img src="{{asset('frontend/img/bg-img-r1.svg')}}" width="450" height="500">
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Step 6 for User Sign Up : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
section.grey>div{z-index:2;position:relative}
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:-90px;width:100%;height:auto;z-index:1}
.formbox{border-radius:9px!important;border:none!important;box-shadow:0 5px 12px rgb(var(--blackrgb)/.1); padding:var(--bs-card-spacer-y) 1.5rem!important}
.formbox .row>div{position:relative}
.ListBox{margin:0;padding:0;display:flex;flex-wrap:wrap}
.ListBox>li{margin-bottom:8px; padding-bottom:8px;border-bottom:1px solid rgb(var(--blackrgb)/.1);width:50%}
.ListBox>li .form-check-label{display:inline-block;width:auto;padding-right:9px}
/*.ListBox>li:last-child{border:none}*/
textarea.form-control{height:180px}
@media (max-width:575px){.ListBox>li{width:100%}}
</style>
@endpush
@push('js')

@endpush