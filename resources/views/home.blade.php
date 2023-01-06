@extends('layouts.app')
@section('content')
<main>
    <section class="HearderSec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="MBox mt-5 pt-5 text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <span class="h5 fw-normal">{{$bannercms->heading}}</span>
                                <h1 class="mb-4">{{$bannercms->title}}</h1>
                                {!! $bannercms->description !!}
                                <a href="{{route('experts')}}" class="btn btn-thm btn-lg">Find an Expert <img src="{{asset('frontend/img/arrow.svg')}}" class="ms-3" width="30" height="30"></a>
                                <!-- <div><a href="experts.php" class="btn btn-thm1 btn-sm">Home Decor</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Career & Business</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Wellness</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Style & Beauty</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Astrology & more</a></div> -->
                            </div>
                        </div>
                        @foreach ($banners as $item)
                        <div class="VideoBox wow zoomIn">
                            @if($item->type=='image')
                            <x-image-box>
                                <x-slot:image>{{$item->image}}</x-slot>
                                <x-slot:path>/uploads/banner/</x-slot>
                                <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                            </x-image-box>
                            @endif
                            @if($item->type=='youtube')
                            <button class="playbtn play"><span></span></button>                            
                            @php
                                $arr = explode('=',$item->title);
                            @endphp
                            <div class="youtube-player" data-id="{{$arr[1] ?? ''}}"></div>
                            @endif
                            @if($item->type=='video')
                            <button class="playbtn play"><span></span></button>                            
                            <video id="PVideo" muted loop playsinline preload="metadata">
                                <source src="{{asset('/uploads/banner/'.$item->image)}}" type="video/mp4">
                            </video>
                            @endif
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($findexperts->count() > 0)    
    <section class="TabSec">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="Heading h2">{{$findexpertcms->title}}</h2>
                    {!! $findexpertcms->description !!}
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-6 order-md-last">
                    <div class="steps-text">
                        @foreach ($findexperts as $item)
                        <div class="StepsMenu">
                            <div class="text">
                                <div class="w-100">
                                    <span class="TitleS">{{$item->title ?? ''}}</span>
                                    <span class="Scon">{!! $item->description !!}</span>
                                </div>
                            </div>
                            <picture>
                                <source srcset="img/step1.webp" type="image/webp">
                                <img loading="lazy" src="img/step1.jpg" alt="steps" width="380" height="480" class="d-md-none">
                            </picture>
                        </div>
                        @endforeach  
                    </div>                    
                </div>
                <div class="col-12 col-md-6 d-none d-md-block">                   
                    <div class="steps">
                        @foreach ($findexperts as $item)
                        <x-image-box>
                            <x-slot:image>{{$item->image}}</x-slot>
                            <x-slot:path>/uploads/findexpertstep/</x-slot>
                            <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                            <x-slot:width>380</x-slot>
                            <x-slot:height>480</x-slot>
                        </x-image-box>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($experts->count() > 0)
    <section class="Sec2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 200" fill="#fff"><polygon points="1600 200 1600 0 0 0 0 200 799.7 0.07 1600 200"/></svg>
        <div class="container">
            <div class="row justify-content-center wow slideInDown">
                <div class="col-lg-9 col-md-10 text-center">
                    <h2 class="Heading h2">{{$expertcms->title}}</h2>
                    {!! $expertcms->description !!}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel ExpertsC">
                        @foreach($experts as $expert)
                        <div class="item">
                            <div class="card ExpBlock verify">
                                <a href="{{route('experts',['alias'=>$expert->user_id])}}" class="card-header">
                                    <x-image-box>
                                        <x-slot:image>{{$expert->profile}}</x-slot>
                                        <x-slot:path>/uploads/expert/</x-slot>
                                        <x-slot:alt>{{$expert->name ?? ''}} {{!empty($expert->expertise->title) ? '('.$expert->expertise->title.')' : ''}} </x-slot>
                                        <x-slot:width>380</x-slot>
                                        <x-slot:height>480</x-slot>
                                    </x-image-box>
                                </a>
                                <a href="{{route('experts',['alias'=>$expert->user_id])}}" class="card-body text-center">
                                    <h3>{{$expert->name ?? ''}}</h3>
                                    <small class="text-black">
                                        @if(!empty($expert->suitable_industry))
                                        <strong class="Exptext">
                                            @foreach(json_decode($expert->suitable_industry) as $industry)
                                                @php $industry = \App\Models\Industry::find($industry); @endphp
                                                {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                            @endforeach                                        
                                        </strong>                                        
                                        @endif
                                         {{!empty($expert->expertise->title) ? '('.$expert->expertise->title.')' : '' }} 
                                    </small>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center"><a href="{{route('experts')}}" class="btn btn-thm2">View More <i class="fal fa-arrow-right"></i></a></div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($featureds->count() > 0)
    <section class="Sec6">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="Heading h2">{{$featuredcms->title}}</h2>
                    {!! $featuredcms->description !!}
                </div>
                <div class="col-12">
                    <div class="owl-carousel">
                        @foreach ($featureds as $item)
                        <x-image-box>
                            <x-slot:image>{{$item->image}}</x-slot>
                            <x-slot:path>/uploads/featured/</x-slot>
                            <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                            <x-slot:width>220</x-slot>
                            <x-slot:height>90</x-slot>
                        </x-image-box>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($expertcategories->count() > 0)
    <section class="Sec7 bgthm">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="Heading h2">{{$expertcategorycms->title}}</h2>
                    {!! $expertcategorycms->description !!}
                </div>
                @foreach ($expertcategories as $item)
                <div class="col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <x-image-box>
                                <x-slot:image>{{$item->image}}</x-slot>
                                <x-slot:path>/uploads/homecategory/</x-slot>
                                <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                                <x-slot:width>90</x-slot>
                                <x-slot:height>90</x-slot>
                            </x-image-box>                            
                        </div>
                        <div class="card-body">
                            <h3 class="h4">{{$item->title ?? ''}}</h3>
                            <p>{{$item->short_description ?? ''}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($videos->count() > 0)
    <section class="Sec3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 783.89" fill="#fff"><path d="M0,783.89S26.21,629,236,673.89c316.5,67.61,242.5-92,468-180.07,235.51-92,311.49,38,449.22-6.8C1251.61,455,1231,287.83,1412,303.83c67.48,6,188-80,188-80V0H0Z"/></svg>
        <div class="container">
            <div class="row justify-content-center wow slideInDown">
                <div class="col-lg-9 col-md-10 text-center">
                    <h2 class="Heading h2">{{$videoscms->title}}</h2>
                    {!! $videoscms->description !!}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel VideoSec wow slideInUp">
                        @foreach ($videos as $video)
                        @php
                            $arr = explode('=',$video->video_url);
                        @endphp
                        <div class="item">
                            <div class="card">
                                <div class="card-header">
                                    @if($video->video_type==1)
                                    <div class="youtube-player" data-id="{{$arr[1] ?? ''}}"></div>
                                    <a href="" class="playVideo"></a>
                                    @endif
                                </div>
                                <a href="" class="card-body">
                                    <h3>{{$video->title}}</h3>
                                    <small class="text-secondary me-3"><i class="far fa-user thm"></i> {{$video->expert->name ?? ''}}</small>
                                    @if(!empty($video->industries))
                                    <small class="text-secondary">
                                        <i class="far fa-tag thm"></i> 
                                        @foreach(json_decode($video->industries) as $industry)
                                            @php $industry = \App\Models\Industry::find($industry); @endphp
                                            {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                        @endforeach  
                                    </small>
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="text-center"><a href="video.php" class="btn btn-thm2">View All Videos <i class="fal fa-arrow-right"></i></a></div>
        </div>
        <div class="Test">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-md-10 text-center">
                        <h2 class="Heading h2">Customer Testimonials</h2>
                        <div class="owl-carousel Testi wow slideInUp">
                            <div class="item">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="img"><img src="{{asset('frontend/img/man.svg')}}"></span>
                                        <h3 class="h4 mt-3">Customers Name</h3>
                                        <div class="text mb-3"><p class="mt">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.”</p></div>
                                        <span class="star" title="star" data-title="4"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="img"><img src="{{asset('frontend/img/man.svg')}}"></span>
                                        <h3 class="h4 mt-3">Customers Name</h3>
                                        <div class="text mb-3"><p class="mt">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.”</p></div>
                                        <span class="star" title="star" data-title="4"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="img"><img src="{{asset('frontend/img/man.svg')}}"></span>
                                        <h3 class="h4 mt-3">Customers Name</h3>
                                        <div class="text mb-3"><p class="mt">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.”</p></div>
                                        <span class="star" title="star" data-title="4"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="Sec4 bgthm">
        <div class="container">
            <div class="row justify-content-center wow zoomIn">
                <div class="col-lg-9 col-md-10 text-center">
                    <h2 class="Heading h2 mb-4">Are you an Expert?</h2>
                    <h3 class="text-white mb-4">Join a community of passionate experts</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    <a href="become-an-expert.php" class="btn btn-thm btn-lg">Become an Expert <img src="{{asset('frontend/img/arrow.svg')}}" class="ms-3" width="30" height="30"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="Sec5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 678.11" fill="#f9f5ef"><path d="M0,310.08s136.21-124.85,346-80c316.49,67.63,334-128,568-190,206.83-54.82,371.57,40,488,40,67.74,0,198-80,198-80V678.19H0Z"/></svg>
        <div class="container">
            <div class="row justify-content-center wow slideInDown">
                <div class="col-lg-9 col-md-10 text-center">
                    <h2 class="Heading h2">We are in the News</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
            </div>
            <div class="row mt-4 wow slideInUp">
                <div class="col-md-6">
                    <div class="card Blog">
                        <a href="blog-detail.php" class="card-header">
                            <picture>
                                <source srcset="{{asset('frontend/img/blog-img1.webp')}}" type="image/webp">
                                <img loading="lazy" src="{{asset('frontend/img/blog-img1.svg')}}" alt="Product" width="380" height="480">
                            </picture>
                            <span>may<span>13</span></span>
                        </a>
                        <a href="blog-detail.php" class="card-body">
                            <h3 class="h5">What is Lorem Ipsum?</h3>
                            <div class="admin"><span class="me-4"><img src="{{asset('frontend/img/admin.svg')}}" class="me-1"> Admin</span> <span><img src="{{asset('frontend/img/comment.svg')}}"> Comments (2)</span></div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card Blog">
                        <a href="blog-detail.php" class="card-header">
                            <picture>
                                <source srcset="{{asset('frontend/img/blog-img4.webp')}}" type="image/webp">
                                <img loading="lazy" src="{{asset('frontend/img/blog-img4.svg')}}" alt="Product" width="380" height="480">
                            </picture>
                            <span>may<span>13</span></span>
                        </a>
                        <a href="blog-detail.php" class="card-body">
                            <h3 class="h5">What is Lorem Ipsum?</h3>
                            <div class="admin"><span class="me-4"><img src="{{asset('frontend/img/admin.svg')}}" class="me-1"> Admin</span> <span><img src="{{asset('frontend/img/comment.svg')}}"> Comments (2)</span></div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card Blog">
                        <a href="blog-detail.php" class="card-header">
                            <picture>
                                <source srcset="{{asset('frontend/img/blog-img2.webp')}}" type="image/webp">
                                <img loading="lazy" src="{{asset('frontend/img/blog-img2.svg')}}" alt="Product" width="380" height="480">
                            </picture>
                            <span>may<span>13</span></span>
                        </a>
                        <a href="blog-detail.php" class="card-body">
                            <h3 class="h5">What is Lorem Ipsum?</h3>
                            <div class="admin"><span class="me-4"><img src="{{asset('frontend/img/admin.svg')}}" class="me-1"> Admin</span> <span><img src="{{asset('frontend/img/comment.svg')}}"> Comments (2)</span></div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card Blog">
                        <a href="blog-detail.php" class="card-header">
                            <picture>
                                <source srcset="{{asset('frontend/img/blog-img3.webp')}}" type="image/webp">
                                <img loading="lazy" src="{{asset('frontend/img/blog-img3.svg')}}" alt="Product" width="380" height="480">
                            </picture>
                            <span>may<span>13</span></span>
                        </a>
                        <a href="blog-detail.php" class="card-body">
                            <h3 class="h5">What is Lorem Ipsum?</h3>
                            <div class="admin"><span class="me-4"><img src="{{asset('frontend/img/admin.svg')}}" class="me-1"> Admin</span> <span><img src="{{asset('frontend/img/comment.svg')}}"> Comments (2)</span></div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        </a>
                    </div>
                </div>
                <div class="col-12 text-center"><a href="blog.php" class="btn btn-thm2">View All Blog <i class="fal fa-arrow-right"></i></a></div>
            </div>
        </div>
        <div class="SubScri wow slideInUp">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 text-center">
                        <h2 class="Heading h2">Subscribe to our Newletter</h2>
                        <p class="h5 text-secondary">Receive updates instanly</p>
                        <div class="input-group mb-3 mt-5">
                            <img src="{{asset('frontend/img/mail.svg')}}" height="40" width="60">
                            <input type="text" class="form-control" name="subscribe_email" placeholder="Enter your email" aria-label="Enter your email" aria-describedby="searchbox">
                            <button class="input-group-text btn btn-thm2" id="searchbox">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Home : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style type="text/css">
    body>main,.TabSec,.TabSec section{overflow:inherit!important}
    .TabSec section{padding:0}
    /*.SerMenu{position:sticky;top:66px;padding:0;}*/
    .steps-text .slick-slide{counter-increment:slides-num;}
    .StepsMenu{padding:25px;border-radius:20px;margin-bottom:9px;transition:all .5s}
    .StepsMenu>div.text{display:flex;}
    .StepsMenu>div.text:before{content:" "counter(slides-num);height:40px;min-width:40px;font-size:26px;font-weight:600;margin-right:25px;background:var(--thm);border-radius:50%;color:var(--white);display:grid;place-content:center;line-height:24px}
    /*.StepsMenu a{display:flex}*/
    .StepsMenu img{height:auto;width:300px;display:flex;margin:20px auto 0;}
    .StepsMenu .TitleS{font-size:26px;font-weight:800;display:flex;/*margin-top:7px;*/color:var(--thm);justify-content:space-between;transition:all .5s}
    .StepsMenu .TitleS:after{content:'';border:none;border-bottom:2px solid;border-left:2px solid;height:9px;width:9px;margin-top:9px;transform:rotate(-45deg);display:block;transition:all .5s}
    .StepsMenu .Scon{opacity:0;visibility:hidden;margin-top:12px;font-size:14px;line-height:140%!important;font-weight:300;display:none;transition:all .5s}
    .steps-text .slick-current .StepsMenu{background:var(--thm)}
    .steps-text .slick-current .StepsMenu .TitleS{color:var(--white)}
    .steps-text .slick-current .StepsMenu>div.text:before{background:var(--white);color:var(--thm)}
    .steps-text .slick-current .StepsMenu .TitleS:after{transform:rotate(135deg)}
    .steps-text .slick-current .StepsMenu .Scon{opacity:1;visibility:visible;color:var(--white);display:block}
    .TabSec .slick-slide>div img{height:450px;max-width:500px;width:100%;object-fit:contain;padding:0}
    .TabSec .steps{position:relative;display:block;}
    .TabSec .steps:after,.TabSec .steps:before{position:absolute;top:-30px;right:25%;height:130px;width:130px;background:var(--thm3);opacity:.1;border-radius:50%;content:'';z-index:-1}
    .TabSec .steps:after{height:240px;width:240px;right:auto;left:0;top:auto;bottom:0;transform:translate(-40%, 30%);background:var(--thm);opacity:.1}
    .Sec6 img{height:auto;max-width:220px;width:100%}
    .Sec7 *,.Sec7 .Heading{color:var(--white)!important}
    .Sec7 .card{border-radius:0!important;background:transparent!important;border:none;flex-direction:row;margin-bottom:15px!important}
    .Sec7 .card>*{background:transparent!important;border:none;padding:0}
    .Sec7 .card .card-body{padding-left:15px}
    .Sec7 .card p{font-size:14px;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:3;font-weight:300;color:rgb(var(--whitergb)/.7)!important;line-height:140%!important}
    .Sec7 .card h3{font-weight:400;margin-bottom:3px;font-size:22px}
    /*@media (min-width:992px){.TabSec .slick-slide>div{height:90vh}}*/
    @media (max-width:767px){.owl-nav{position:static!important;width:85px!important;display:flex;justify-content:space-between;margin-top:9px!important}
    .owl-nav button.owl-next, .owl-nav button.owl-prev{margin:0!important;position:static!important}
    .ExpertsC .owl-nav button.owl-next, .ExpertsC .owl-nav button.owl-prev{width:36px!important;height:36px!important}
    .StepsMenu .TitleS{font-size:22px}
    .StepsMenu>a:before{margin-right:15px;}
    .steps-text .slick-list,.steps-text .slick-list .slick-track{height:auto!important;}
    .TabSec .slick-slide>div img{height:auto;display:none!important;}
    .steps-text .slick-current .StepsMenu img{display:block!important}
    }
    </style>
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />

@endpush

@push('js')
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" onload="this.rel='stylesheet'" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
<link rel="preload" as="style" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" onload="this.rel='stylesheet'" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.compat.min.css" integrity="sha512-b42SanD3pNHoihKwgABd18JUZ2g9j423/frxIP5/gtYgfBz/0nDHGdY/3hi+3JwhSckM3JLklQ/T6tJmV7mZEw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" onload="this.rel='stylesheet'" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>new WOW().init();</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.steps').slick({slidesToShow:1,slidesToScroll:1,arrows:false,fade:false,vertical:true,asNavFor:'.steps-text',autoplay:true,autoplaySpeed:3000});
    $('.steps-text').slick({slidesToShow:3,slidesToScroll:1,vertical:true,asNavFor:'.steps',centerMode:false,focusOnSelect:true,prevArrow:".thumb-prev",nextArrow:".thumb-next"});
    // $(".Sec1 .owl-carousel").owlCarousel({animateOut:"fadeOut",animateIn:"fadeIn",items:1,margin:60,loop:true,dots:true,nav:false,navText:['<i class="fal fa-chevron-left"></i>','<i class="fal fa-chevron-right"></i>'],autoplay:true,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true});
    $(".ExpertsC").owlCarousel({items:4,margin:30,loop:false,dots:false,nav:true,navText:['<i class="far fa-chevron-left"></i>','<i class="far fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:2},460:{items:2},600:{items:2},768:{items:3},992:{items:3},1200:{items:4},1600:{items:4}}});
    $(".VideoSec").owlCarousel({items:3,margin:30,center:false,loop:true,dots:true,nav:false,navText:['<span></span>','<span></span>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:1},575:{items:2},768:{items:2},992:{items:3},1200:{items:3},1600:{items:3}}});
    $(".Testi").owlCarousel({items:1,margin:0,center:false,loop:true,dots:true,nav:false,navText:['<span></span>','<span></span>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true});
    $(".Sec4 .owl-carousel").owlCarousel({items:4,margin:15,loop:false,dots:false,nav:false,navText:['<i class="fal fa-chevron-left"></i>','<i class="fal fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:2},460:{items:2},600:{items:2},768:{items:3},992:{items:3},1200:{items:4},1600:{items:4}}});
    $(".Sec5 .owl-carousel").owlCarousel({items:2,margin:30,loop:false,dots:false,nav:true,navText:['<i class="fal fa-chevron-left"></i>','<i class="fal fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:1},460:{items:1},600:{items:2},768:{items:2},992:{items:2},1200:{items:2},1600:{items:2}}});
    $(".Sec6 .owl-carousel").owlCarousel({items:7,margin:30,loop:false,dots:false,nav:false,navText:['<i class="far fa-chevron-left"></i>','<i class="far fa-chevron-right"></i>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:2},350:{items:3},460:{items:4},600:{items:4},768:{items:5},992:{items:5},1200:{items:6},1600:{items:6}}});

    var ctrlVideo = document.getElementById("PVideo");
    $('.playbtn').click(function(){
        // alert();
        if ($('.playbtn').hasClass("play")){
            ctrlVideo.play();
            $('.playbtn').removeClass("play");
        } else {
            ctrlVideo.pause();
            $('.playbtn').addClass("play");
        }
    });
});
</script>
<script>
function labnolIframe(div) {
  var iframe = document.createElement('iframe');
  iframe.setAttribute(
    'src',
    'https://www.youtube.com/embed/' + div.dataset.id + '?autoplay=1&rel=0'
  );
  iframe.setAttribute('frameborder', '0');
  iframe.setAttribute('allowfullscreen', '1');
  iframe.setAttribute(
    'allow',
    'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture'
  );
  div.parentNode.replaceChild(iframe, div);
}
function initYouTubeVideos() {
  var playerElements = document.getElementsByClassName('youtube-player');
  for (var n = 0; n < playerElements.length; n++) {
    var videoId = playerElements[n].dataset.id;
    var div = document.createElement('div');
    div.setAttribute('data-id', videoId);
    var thumbNode = document.createElement('img');
    thumbNode.src = '//i.ytimg.com/vi/ID/hqdefault.jpg'.replace(
        'ID',
        videoId
    );
    thumbNode.alt = "Youtube Voideo";
    div.appendChild(thumbNode);
    var playButton = document.createElement('div');
    playButton.setAttribute('class', 'play');
    div.appendChild(playButton);
    div.onclick = function () {
      labnolIframe(this);
    };
    playerElements[n].appendChild(div);
  }
}
document.addEventListener('DOMContentLoaded', initYouTubeVideos);
</script>
@endpush