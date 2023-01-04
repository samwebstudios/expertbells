@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="Sec2 pt-3 CmsPage bg-white">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
          <li class="breadcrumb-item"><a href="{{url('career')}}">Careers</a></li>
          <li class="breadcrumb-item"><a aria-current="page">Careers Detail</a></li>
        </ol>
        <div class="text-center"><h1 class="Heading">{{$list->title}}</h1></div>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card JobBox wow bounceIn">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-6"><strong>Department</strong></div>
                  <div class="col-6"><a href="">{{$list->department ?? '------'}}</a></div>
                </div>
                <div class="row mb-3">
                  <div class="col-6"><strong>Role</strong></div>
                  <div class="col-6">{{$list->rol ?? '------'}}</div>
                </div>
                <div class="row">
                  <div class="col-6"><strong>Locations</strong></div>
                  <div class="col-6">{{$list->location ?? '------'}}</div>
                </div>
                <div class="text-center"><a href="#ApplyPopup" data-bs-toggle="modal" data-bs-target="#ApplyPopup" class="btn btn-thm2 mt-5">Apply for this job</a></div>
              </div>
            </div>
          </div>
          <div class="col-12 mt-4"> {!!$list->description!!} </div>
          
        </div>
      </div>
    </section>
  </main>

<div class="modal fade" id="ApplyPopup" tabindex="-1" aria-labelledby="ApplyPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form class="modal-content">
        <div class="modal-header">
          <div>
            <h5 class="modal-title text-black m-0">Lorem Ipsum is simply dummy</h5>
            <strong class="text-black-50 m-0"><small>India, UAE, Singapore, Hong Kong</small></strong>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body contact">
          <div class="row">
            <div class="col-sm-6 mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" id="name" name="Name" placeholder="Name">
                <label for="name" class="form-label">Name</label>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="form-floating">
                <input type="email" class="form-control" id="Email" name="Email" placeholder="Email ID">
                <label for="Email" class="form-label">Email</label>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="form-floating">
                <input type="number" class="form-control" id="Phone" name="Phone" placeholder="Phone No.">
                <label for="Phone" class="form-label">Phone No.</label>
              </div>
            </div>
            <div class="col-sm-6 mb-3">
              <div class="form-floating">
                <select class="form-select mb-3" aria-label=".form-select-lg example" name="Services">
                  <option disabled="" selected="" class="d-none">Select Experience</option>
                  <option value="0-1 Year">0-1 Year</option>
                  <option value="1-2 Year">1-2 Year</option>
                  <option value="2-5 Year">2-5 Year</option>
                  <option value="5-8 Year">5-8 Year</option>
                  <option value="8+ Year">8+ Year</option>
                </select>
                <label for="floatingSelect">Works with selects</label>
              </div>
            </div>
            <div class="col-sm-12 mb-3">
              <div class="form-floating">
                <input type="file" class="form-control" id="upResume">
                <label class="input-group-text" for="upResume">Upload <span class="d-none d-md-block">&nbsp;Your Resume</span></label>
              </div>
            </div>
            <div class="col-sm-12 mb-3">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="Message" id="Comments"></textarea>
                <label for="Comments">Comments</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center d-block">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
          <button type="button" class="btn btn-thm2 mt-0">Send Now</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@push('css')
<title>Careers View : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
.JobBox{border:none!important;border-radius:0px!important;background:rgb(var(--thmrgb)/.07)!important;margin-top:30px;border:1px solid rgb(var(--thmrgb)/.05)!important}
.JobBox>div{padding:30px 50px}
.ConHR{background:rgb(var(--thmrgb)/.07)!important;border:1px solid rgb(var(--thmrgb)/.05)!important;margin-top:30px}
.ConHR>div{display:flex;align-items:center}
.ConHR>div img{height:120px;width:120px;border-radius:50%;object-fit:contain;background:var(--white);box-shadow:0 4px 9px rgb(var(--blackrgb)/.2)}
.ConHR>div>div{margin-left:20px}
.bg-white{box-shadow:0 0 9px rgb(var(--blackrgb)/.1)}
</style>
@endpush
@push('js')
    
@endpush