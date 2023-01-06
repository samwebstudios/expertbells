@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <div class="col-5">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
                <span class="breadcrumb-item active">Home Expert Videos</span>
            </nav>
        </div>
        <div class="col-7 text-right">
            <button class="btn btn-dark" onclick="$('.rowfrom').submit();" type="button">Update Videos Status</button>
        </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <p>NOTE: <small>Please checked or unchecked videos and then click on <b>UPDATE VIDEOS STATUS</b></small></p>
            <form class="row rowfrom" method="POST" action="{{route('admin.changehomeexpertvidoesstatus')}}">
                @csrf
                @foreach ($lists as $video)
                <div class="col-md-3">
                    @if($video->video_type==1)
                    {!! youtube_preview($video->video_url,'w-100',150) !!}
                    @endif
                    @if($video->video_type==2)
                    <video>
                        <source src="{{asset('uploads/expert/video/'.$video->video)}}" type="video/mp4" />
                    </video>
                    @endif
                    <small>
                        <label for="check">
                            <input type="checkbox" @checked($video->set_home==1) name="set[{{$video->id}}]" id="check">
                            @if($video->set_home==1) <span id="check" class="text-success">Expert(#{{$video->expert->user_id}}) video is set on home page section.</span>
                            @else <span id="check" class="text-danger">Expert(#{{$video->expert->user_id}}) video is not set on home page section.</span> @endif
                        </label>
                    </small>
                </div>
                @endforeach  
                {{$lists->links()}}              
            </form>
        </div>
    </div>
</div>
@endsection
@push('css')
    <title>Home Page Expert Videos</title>
@endpush
@push('js')
    
@endpush