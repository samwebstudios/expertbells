@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="Sec2 pt-3 bg-white">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('experts')}}">Find All Experts</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Expert introduction</a></li>
            </ol>
            <div class="row ExpDetail mt-4">
                <div class="col-lg-3">
                    <div class="position-sticky">
                        <div class="card ProBlock mt-0">
                            <a href="#" class="card-header">
                                @if($experts->top_expert==1) <span class="StarBox">Top Expert</span> @endif                                
                                <x-image-box>
                                    <x-slot:image>{{$experts->profile}}</x-slot:image>
                                    <x-slot:path>/uploads/expert/</x-slot:image>
                                    <x-slot:alt>{{$experts->name ?? ''}} {{!empty($experts->expertise->title) ? '('.$experts->expertise->title.')' : ''}} </x-slot:image>
                                    <x-slot:width>380</x-slot:image>
                                    <x-slot:height>480</x-slot:image>
                                </x-image-box>                                
                            </a>
                        </div>
                        <h3 class="h5 text-black verify">{{$experts->name}}</h3>
                        @if(!empty($experts->suitable_industry))
                        <span>
                            @foreach(json_decode($experts->suitable_industry) as $industry)
                                @php $industry = \App\Models\Industry::find($industry); @endphp
                                {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                            @endforeach                                        
                        </span>
                        @endif
                        <div class="mb-2 text-secondary">
                            <small><i class="fal fa-map-marker-alt"></i> 
                                {{$experts->states->name.', ' ?? ''}}
                                {{$experts->countires->name ?? ''}}
                            </small> &nbsp;
                            @if(!empty($experts->fluent_language)) 
                            <small><i class="fal fa-globe-americas"></i> 
                                @foreach(json_decode($experts->fluent_language) as $language)
                                @php $language = \App\Models\Language::find($language); @endphp
                                {{$language->title ?? ''}}{{!$loop->last?', ':''}}
                                @endforeach 
                            </small>
                            @endif
                        </div>
                        <div class="thm"><span class="star" data-title="4"></span> 5.0 </div>
                        <p class="lh-n"><a href="" class="text-secondary"><small>252 reviews / 453 sessions</small></a></p>
                        <div class="text-center d-flex justify-content-between mb-2">
                            <a href="#" class="btn btn-thm3 px-3"><i class="fal fa-comment-alt-lines m-0 me-1"></i> Message me</a>
                            @if(!empty($experts->videos))
                            <a href="{{route('experts',['alias'=>$experts->user_id,'type'=>'videos'])}}" class="btn btn-thm2 px-3"><i class="fal fa-photo-video m-0 me-1"></i> Watch Video</a>
                            @endif
                        </div>
                        @if(!empty($notesection->description))
                        <div class="Proceed d-none">{{$notesection->description ?? ''}}</div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 order-lg-last">
                    <div class="position-sticky">
                        <div class="FirstScreen">
                            <h2 class="h3 text-black mb-3">Book a video call</h2>
                            <p><small class=" text-secondary">Powered by</small> <img src="{{asset('frontend/img/logo.svg')}}" height="18" width="99"></p>
                            <div class="card ExpInfo text-center mb-4">
                                <div class="card-body">
                                    @if(!empty($requestsection->title) || !empty($requestsection->description))
                                    <i>Introducing</i>
                                    @endif
                                    <h3 class="my-2">{{$requestsection->title}}</h3>
                                    <p>{{$requestsection->description}}</p>
                                    <a href="#BookExpert" data-bs-toggle="modal" class="btn btn-thm4 btn-lg">Select times <img src="{{asset('frontend/img/arrow.svg')}}" class="ms-3" width="30" height="30"></a>
                                    <div class="price"><i class="Ricon">&#8377;</i> 250/- (Per Session) <!-- <del><i class="Ricon">&#8377;</i> 999/-</del> --></div>
                                </div>
                            </div>
                            <div class="card ExpInfo text-center d-none">
                                <div class="card-body">
                                    <h3 class="my-2">{{$giftsection->title}}</h3>
                                    <p>{{$giftsection->description}}</p>
                                    <a href="#" class="btn btn-thm4 btn-lg px-5 BtnContinue">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mx-lg-3">
                        <h1 class="h3 text-black m-0">Expert Introduction</h1>
                        <h3 class="h5 thm mt-4">About me</h3>
                        <div class="CmsPage">
                            {!! $experts->bio !!}
                        </div>
                        <h3 class="h5 thm mt-4">Strength</h3>
                        <div class="CmsPage">
                            {!! $experts->your_strength !!}
                        </div>
                        <h3 class="h5 thm mt-5 mb-3">What to expect</h3>
                        <div class="rounded-3 bg-light p-3 border">
                            <div class="CmsPage">
                                <ul>
                                    @foreach($experts->expects as $expects)
                                    <li>{{$expects->description}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <h3 class="h5 thm mt-5 mb-3">Why it's valuable</h3>
                        <div class="card ReviewBlock">
                            <div class="card-body">
                                <div class="img"><img src="{{asset('frontend/img/man.svg')}}" width="50" height="50"></div>
                                <div>
                                    <h4 class="thm m-0">Nancy</h4>
                                    <p class="lh-n mt-0 text-secondary"><small>1 Session</small></p>
                                    <p class="mt0">Nicole is fantastic! Whip Smart and full of useful advice!!</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="star" title="star" data-title="4"></span>
                                        <small class="text-secondary">Monday, Jul 26, 2022</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="img"><img src="{{asset('frontend/img/man.svg')}}" width="50" height="50"></div>
                                <div>
                                    <h4 class="thm m-0">Nancy</h4>
                                    <p class="lh-n mt-0 text-secondary"><small>1 Session</small></p>
                                    <p class="mt0">Nicole is fantastic! Whip Smart and full of useful advice!!</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="star" title="star" data-title="4"></span>
                                        <small class="text-secondary">Monday, Jul 26, 2022</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade RighSide BookS AddPro" id="BookExpert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BookExpertLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content">
            <div class="modal-header p-0 border-0">
                <!-- <h2 class="h5 modal-title" id="BookExpertLabel">Select times</h2> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body PopupDetail py-3 p-4">
                <div class="sTimeScreen">
                    <div class="ContainBOx">
                        <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Select Duration</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pb-2 mb-2">
                                    <!-- <h3 class="h5 text-secondary">1) Select the call duration:</h3> -->
                                    <ul class="p-0 mb-0 TimeBox TopTimeBox">
                                        <li>
                                            <div class="form-check"><label class="form-check-label d-flex" for="s1" data-price="50" data-cprice="60"><input type="radio" class="form-check-input" name="Sizes" id="s1" autocomplete="off" checked> <span>Quick - 15 Min</span></label></div>
                                        </li>
                                        <li>
                                            <div class="form-check"><label class="form-check-label d-flex" for="s2" data-price="90" data-cprice="105"><input type="radio" class="form-check-input" name="Sizes" id="s2" autocomplete="off"> <span>Regular - 30 Min</span></label></div>
                                        </li>
                                        <li>
                                            <div class="form-check"><label class="form-check-label d-flex" for="s3" data-price="130" data-cprice="155"><input type="radio" class="form-check-input" name="Sizes" id="s3" autocomplete="off"> <span>Extra - 45 Min</span></label></div>
                                        </li>
                                        <li>
                                            <div class="form-check"><label class="form-check-label d-flex" for="s4" data-price="160" data-cprice="190"><input type="radio" class="form-check-input" name="Sizes" id="s4" autocomplete="off"> <span>All Access - 60 Min</span></label></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Pick the Date</h3>
                                <input type="hidden" class="form-control inlinecal d-none" id="dob" name="dob" placeholder="Date of Birth">
                            </div>
                            <div class="col-md-12">
                                <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Select the Time slot</h3>
                                <div class="SetTimeBox">
                                    <span class="SetInfo thm w-50"><span><i class="fas fa-info-circle me-2"></i> All times are in UTC+05:30 (IST)</span> <i class="far fa-chevron-right"></i></span>
                                    <ul class="p-0 TimeBox">
                                        @foreach($slots as $slot)
                                            @php
                                                $tStart = strtotime($slot->from_time);
                                                $tEnd = strtotime($slot->to_time);
                                                $tNow = $tStart;
                                            @endphp
                                            @while($tNow <= $tEnd)
                                            {{-- disabled --}}
                                            <li><input type="radio" class="btn-check" name="timing" id="t{{$tNow}}"  autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available" for="t{{$tNow}}">{{date("H:i",$tNow)}}</label></li>
                                            @php $tNow = strtotime('+15 minutes',$tNow); @endphp
                                            @endwhile
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-sticky border-top">
                        <div class="price m-0 h4"><strong>Price:</strong> <i class="Ricon">&#8377;</i> <span class="mprice">50</span>/- <del style="display:none;" class="cprice"><i class="Ricon">&#8377;</i> <span class="bprice">60</span>/-</del> <span class="h6">(Per Session)</span></div>
                        <a href="login-book-expert.php" class="btn btn-thm4 btn-lg px-5 mt-0 Request" style="display:none">Request</a>
                        <a href="#BookExpert" data-bs-toggle="modal" class="btn btn-thm4 m-0">Book Now <i class="fal fa-chevron-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('css')
<title>Expert introduction : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style type="text/css">
body>main,body section{overflow:inherit!important}
.Sec2 .card.ProBlock{border-radius:9px!important;overflow:hidden!important}
.ProBlock>.card-header{height:350px!important}
.star{font-size:20px!important}
.Proceed{border-radius:15px;padding:12px 20px;background:rgb(var(--thmrgb3)/.1);color:var(--thm3);text-align:center;margin-top:15px}
.ExpDetail .position-sticky{top:70px}
.Sec2 .ExpInfo.card{border:1px solid rgb(var(--thmrgb3)/.15)!important;border-radius:var(--bs-border-radius-lg)!important}
.Sec2 .ExpInfo.card .price{font-size:15px}
@media (min-width:992px){}
@media (min-width:1200px){.ExpDetail>div{width:calc(100% - 660px)}
.ExpDetail>div:first-child,.ExpDetail>div:nth-child(2){width:330px}}
@media (min-width:1600px){.ExpDetail>div{width:calc(100% - 680px)}
.ExpDetail>div:first-child,.ExpDetail>div:nth-child(2){width:340px}}
.ReviewBlock{border:none!important;background:none!important}
.ReviewBlock>div{border-top:1px solid rgb(var(--blackrgb)/.1)!important;padding:15px 0 0;margin-top:15px;display:flex;justify-content:space-between}
.ReviewBlock>div:first-child{border:none!important;margin-top:0}
.ReviewBlock>div .img{width:75px}
.ReviewBlock>div .img img{height:60px;width:60px;border-radius:50%;box-shadow:0 2px 3px rgb(var(--blackrgb)/.3)}
.ReviewBlock>div>div{width:calc(100% - 60px)}
.ReviewBlock>div .star{margin-left:0}
.ReviewBlock>div h4{font-size:16px;margin-top:0;font-weight:600}
.ReviewBlock>div>div>span:last-child{font-size:12px!important}

</style>
@endpush
@push('js')

@endpush