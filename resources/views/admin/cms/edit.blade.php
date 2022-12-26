@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <div class="col-md-6">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
                <span class="breadcrumb-item active">{{$lists->title}}</span>
            </nav>
        </div>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form method="POST" action="{{route('admin.updatecms')}}" enctype="multipart/form-data" class="table-wrapper sequenceform">
                @csrf
                <input type="hidden" name="id" value="{{$lists->id}}">                
                <div class="row mg-b-25">
                    @if(in_array($lists->id,[4]))
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Heading <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('heading',$lists->heading) }}" name="heading"
                                placeholder="Heading Here...">            
                                @error('heading') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    @endif
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Title <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('title',$lists->title) }}" name="title"
                                placeholder="Title Here...">            
                                @error('title') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Description <span class="error">*</span></label>            
                            <textarea class="form-control" id="summernote" name="description">{{ old('description',$lists->description) }}</textarea>           
                            @error('description') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div>
                    @if($lists->id==15)
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Address <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('address',$lists->address) }}" name="address"
                                placeholder="Address Here...">            
                                @error('address') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Email Address<span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('email',$lists->email) }}" name="email"
                                placeholder="Email Address Here...">            
                                @error('email') <span class="text-danger error">{{$message}}</span>  @enderror  
                                
                            <small class="mt-0"><b>NOTE:</b> if you want to add multiple email address than use comma (,) and enter a lot email address.</small>      
                        </div>            
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Contact Numbers <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('phones',$lists->phones) }}" name="phones"
                                placeholder="Contact Numbers Here...">            
                                @error('phones') <span class="text-danger error">{{$message}}</span>  @enderror  
                            <small><b>NOTE:</b> if you want to add multiple contact number than use comma (,) and enter a lot contact number.</small>       
                        </div>           
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Embed Code <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('embed_code',$lists->embed_code) }}" name="embed_code"
                                placeholder="Embed Code Here...">            
                                @error('embed_code') <span class="text-danger error">{{$message}}</span>  @enderror        
                        </div>            
                    </div> 

                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">For Sales Enquiries:</h6>
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Email Address <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('sales_email_address',$lists->sales_email) }}" name="sales_email_address"
                                placeholder="Email Address Here...">            
                                @error('sales_email_address') <span class="text-danger error">{{$message}}</span>  @enderror        
                            <small class="mt-0"><b>NOTE:</b> if you want to add multiple email address than use comma (,) and enter a lot email address.</small>      
                        </div>            
                    </div> 
                    <div class="col-lg-12">            
                        <div class="form-group">            
                            <label>Contact Numbers <span class="error">*</span></label>            
                            <input type="text" class="form-control" value="{{ old('sales_phones',$lists->sales_phones) }}" name="sales_phones"
                                placeholder="Title Here...">            
                                @error('sales_phones') <span class="text-danger error">{{$message}}</span>  @enderror        
                            <small><b>NOTE:</b> if you want to add multiple contact number than use comma (,) and enter a lot contact number.</small>       
                        </div>            
                    </div> 
                    @endif

                    @if(in_array($lists->id,[5,6]))
                        <div class="col-lg-4">            
                            <div class="form-group">            
                                <label>Image <span class="error">*</span></label>            
                                <input type="file" id="imgInp" class="form-control" name="image">            
                                <small>BEST IMAGE SIZE: 600px * 560px</small> <br>
                                @error('image') <span class="text-danger error">{{$message}}</span> @enderror                                
                            </div>            
                        </div> 
                        <div class="col-lg-2">
                            <x-admin.image-preview>
                                <x-slot:image>{{$lists->image}}</x-slot>
                                <x-slot:path>/uploads/cms/</x-slot>
                                <x-slot:alt>{{$lists->title ?? ''}}</x-slot>
                                <x-slot:class>defaultimgcss</x-slot>
                                <x-slot:id>defaultimg</x-slot>
                            </x-admin.image-preview>
                        </div> 
                    @endif 
                    @if(in_array($lists->id,[0]))
                        <div class="col-lg-4">            
                            <div class="form-group">            
                                <label>Second Image <span class="error">*</span></label>            
                                <input type="file" id="imgInp2" class="form-control" name="image2">            
                                <small>BEST IMAGE SIZE: 246px * 246px</small> <br>
                                @error('image2') <span class="text-danger error">{{$message}}</span> @enderror                                
                            </div>            
                        </div> 
                        <div class="col-lg-2">
                            <x-admin.image-preview>
                                <x-slot:image>{{$lists->image_2}}</x-slot>
                                <x-slot:path>/uploads/cms/</x-slot>
                                <x-slot:alt>{{$lists->title ?? ''}}</x-slot>
                                <x-slot:class>defaultimgcss</x-slot>
                                <x-slot:id>defaultimg2</x-slot>
                            </x-admin.image-preview>
                        </div> 
                    @endif     
                </div>
            
                <div class="form-layout-footer text-right">            
                    <button class="btn btn-dark esvbtn" onclick="$('.esvbtn').hide(); $('.eprcbtn').show();">Confirm & Save</button>
                    <button type="button" style="display:none;" disabled class="btn btn-dark eprcbtn">
                        <i class="fad fa-spinner-third fa-spin"></i> Loading...
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('css')
<title>Edit {{$lists->title ?? ''}} : {{project()}}</title>
@endpush
@push('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#summernote').summernote({
        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['custom', ['imageAttributes', 'imageShape']],
                ['remove', ['removeMedia']]
            ],
        },
        callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                UploadImage(files[0], editor, welEditable);                
            }
        }
    });

    <?php if(in_array($lists->id,[5,6])){ ?>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
            defaultimg.src = URL.createObjectURL(file)
            }
        }
    <?php } ?>
    <?php if(in_array($lists->id,[0])){ ?>
        imgInp2.onchange = evt => {
            const [file] = imgInp2.files
            if (file) {
            defaultimg2.src = URL.createObjectURL(file)
            }
        }
    <?php } ?>
</script>
@endpush