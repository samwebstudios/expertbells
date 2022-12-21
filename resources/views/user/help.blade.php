@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Help Center</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-user.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="text-center mb-4">How can we help you?</h3>
                    <div class="row pb-1">
                        <div class="col-md-5"><input type="search" class="form-control SearchBox" placeholder="Search by name or keyword"></div>
                        <div class="col-md-7 text-end"><a href="#PostQuery" data-bs-toggle="modal" class="btn btn-thm2 m-0 h-100"><i class="fal fa-user-headset m-0 me-2"></i> Post Query</a></div>
                    </div>
                    <div class="accordion accordion-flush Faqs mt-4 border" id="Faqs">
                        @foreach ($lists as $item)
                        <div class="accordion-item">
                            <div class="accordion-header" id="Pay1">
                                <button class="accordion-button {{$loop->iteration>1?'collapsed':''}}" type="button" data-bs-toggle="collapse" data-bs-target="#Faqs{{$loop->iteration}}" aria-expanded="true" aria-controls="Faqs1">What is Lorem Ipsum?</button>
                            </div>
                            <div id="Faqs{{$loop->iteration}}" class="accordion-collapse {{$loop->iteration==1?'collapse show':''}}" aria-labelledby="Pay1" data-bs-parent="#Faqs">
                                <div class="accordion-body">
                                    <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div>
                            </div>
                        </div>
                        @endforeach                         
                    </div>
                    {{$lists->links()}}
                </div>
            </div>
        </div>
    </section>
</main>  
<div class="modal fade" id="PostQuery" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PostQueryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form class="modal-content">
            <div class="modal-header">
                <h2 class="h5 modal-title" id="PostQueryLabel">Post Your Query</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3 p-4">
                <div class="mb-3">
                    <label class="ms-2"><small>Your Name</small></label>
                    <input type="text" class="form-control" placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label class="ms-2"><small>Your Email ID</small></label>
                    <input type="text" class="form-control" placeholder="Your Email ID">
                </div>
                <div class="mb-3">
                    <label class="ms-2"><small>Your Contact No.</small></label>
                    <input type="text" class="form-control" placeholder="Your Contact No.">
                </div>
                <div class="mb-3">
                    <label class="ms-2"><small>Your Query</small></label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="text-center mt-3"><button class="btn btn-thm2">Send Query</button></div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('css')
<title>Help Center : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<style type="text/css">
input.SearchBox{padding-left:50px;height:48px;font-size:18px;background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 429.69 395.22" opacity=".5"><path d="M425.49,377.67,294.3,257.76a162.73,162.73,0,1,0-12,14.72S402,381.82,412.7,391.66,435.76,387,425.49,377.67ZM162.55,305A142.41,142.41,0,1,1,305,162.55,142.41,142.41,0,0,1,162.55,305Z"/></svg>') no-repeat 20px center/20px auto var(--white);margin-bottom:9px;border-radius:30px;border:none;box-shadow:0 9px 20px -8px rgb(var(--blackrgb)/.3)!important;max-width:600px;width:100%;margin:0;transition:all .5s}
input.SearchBox:focus{box-shadow:0 9px 20px -8px rgb(var(--blackrgb)/.6)!important}
#PostQuery .form-control{border-radius:1.5rem;padding:.6rem .75rem;font-size:15px}
#PostQuery textarea.form-control{height:99px;resize:none}
</style>
@endpush
@push('js')
    
@endpush