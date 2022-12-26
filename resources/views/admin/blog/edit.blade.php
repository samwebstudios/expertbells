<x-admin-layout>

  <div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

      <nav class="breadcrumb pd-0 mg-0 tx-12">

        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>

        <a class="breadcrumb-item" href="{{action('Admin\BlogController@index')}}">Blog Management</a>

        <span class="breadcrumb-item active">Update Blog</span>

      </nav>

    </div><!-- br-pageheader -->

    <div class="br-pagebody">

      <div class="br-section-wrapper">

        <form method="post" action="{{route('admin.update-blog')}}" enctype="multipart/form-data">

          @csrf

          <input type="hidden" name="preId" value="{{$lists->id}}">

        <div class="form-layout form-layout-1">

          <div class="row mg-b-25">

            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Title: <span class="error">*</span></label>

                <input class="form-control" type="text" name="title" value="{{old('title',$lists->title)}}" placeholder="Title Here...">

                @error('title')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>

            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Alias: <span class="error">*</span></label>

                <input class="form-control" type="text" name="alias" value="{{old('alias',$lists->alias)}}" placeholder="Alias Here...">

                <input class="form-control" type="hidden" name="prealias" value="{{old('prealias',$lists->alias)}}" placeholder="Alias Here...">

                @error('prealias')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>

            <div class="col-lg-3">

              <div class="form-group">

                <label class="form-control-label">Category : <span class="error">*</span></label>

                <select class="form-control" name="category">

                    <option value="">Choose One</option>

                    @foreach($categories as $category)

                    <option value="{{$category->id}}" {{old('category',$lists->category_id)==$category->id ? 'selected' : ''}}>{{$category->title}}</option>

                    @endforeach

                </select>

                @error('category')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>

            <div class="col-lg-3">

                <div class="form-group">

                  <label class="form-control-label">Post Date : <span class="error">*</span></label>

                  <input class="form-control" type="date"  name="post_date" value="{{old('post_date',$lists->post_date)}}" >

                  @error('post_date')<span class="error">{{$message}}<span> @enderror

                </div>

              </div>

            <div class="col-lg-4">

              <div class="form-group">

                <label class="p-0">Banner Size is 928px * 480px</label>

                <label class="custom-file">

                    <input type="file" id="imgInp2" name="banner" class="custom-file-input">

                    <input type="hidden" name="prebanner" value="{{$lists->banner}}">

                    <span class="custom-file-control"></span>

                </label>

                @error('banner')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>

            <div class="col-lg-2">

                @if(!empty($lists->banner))

                  @php $explode = explode('.',imagedecript($lists->banner)) @endphp

                  @if(strtoupper(end($explode))=='SVG' || strtoupper(end($explode))=='WEBP')

                  <img src="{{asset('up/bg/bn/og/'.imagedecript($lists->banner))}}"  class="defaultimgcss" style="width:100px;">

                  @else

                  <img src="{{asset('up/bg/bn/jpg/'.imagedecript($lists->jpg_banner))}}"  class="defaultimgcss" style="width:100px;">

                  @endif

                @else

                  <img src="{{asset('admin/img/img12.jpg')}}" id="defaultimg2" class="w-100 defaultimgcss">

                @endif

            </div>

            <div class="col-lg-4">

                <div class="form-group">

                    <label class="p-0">IMAGE Size is 600px * 800px</label>

                    <label class="custom-file">

                        <input type="file" id="imgInp" name="image" class="custom-file-input">

                        <input type="hidden" name="preimage" value="{{$lists->image}}">

                        <span class="custom-file-control"></span>

                    </label>

                    @error('image')<span class="error">{{$message}}<span> @enderror

                    </div>

                </div>

                <div class="col-lg-2">

                    @if(!empty($lists->image))

                      @php $explode = explode('.',imagedecript($lists->image)) @endphp

                      @if(strtoupper(end($explode))=='SVG' || strtoupper(end($explode))=='WEBP')

                      <img src="{{asset('up/bg/og/'.imagedecript($lists->image))}}"  class="defaultimgcss" style="width:100px;">

                      @else

                      <img src="{{asset('up/bg/jpg/'.imagedecript($lists->jpg_image))}}"  class="defaultimgcss" style="width:100px;">

                      @endif

                    @else

                    <img src="{{asset('admin/img/img12.jpg')}}" id="defaultimg" class="w-100 defaultimgcss">

                    @endif

                </div>

            <div class="col-lg-12">

                <div class="form-group">

                <label class="form-control-label">Short Description: </label>

                <textarea class="form-control" name="sort_description" id="short_description" placeholder="Write Something Here...">{{old('sort_description',$lists->short_description)}}</textarea>

                @error('sort_description')<span class="error">{{$message}}<span> @enderror



                </div>

            </div>

            

            <div class="col-lg-12">

                <div class="form-group">

                <label class="form-control-label">Description: </label>

                <textarea class="form-control" name="description" id="description" placeholder="Write Something Here...">{{old('description',$lists->description)}}</textarea>

                </div>

            </div>

            

            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Meta Title: <span class="error">*</span></label>

                <input class="form-control" type="text" name="meta_title" value="{{old('meta_title',$lists->meta_title)}}" placeholder="Meta Title Here...">

                @error('meta_title')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>



            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Meta Keywords: </label>

                <textarea class="form-control" placeholder="Meta Keywords Here..." name="meta_keywords" >{{old('meta_keywords',$lists->meta_keywords)}}</textarea>

              </div>

            </div>



            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Meta Description: </label>

                <textarea class="form-control" placeholder="Meta Description Here..." name="meta_description" >{{old('meta_description',$lists->meta_description)}}</textarea>

              </div>

            </div>    

            

          </div><!-- row -->



          <div class="form-layout-footer text-right">

            <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();" class="btn btn-success">Confirm & Proceed</button>

            <button type="button" id="prcbtn" style="display:none;" disabled class="btn btn-success">Processing...</button>

            <a href="{{route('admin.blog-management')}}" class="btn btn-dark">Cancel</a>

          </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

        </form>

      </div>

    </div>

    <x-admin.footer/>

  </div>

@push('style')

  <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('frontend/fonts/flaticon/flaticon.css')}}" />

  <title>Update Blog : {{project()}}</title>

@endpush

@push('scripts')

<script src="{{asset('admin/lib/select2/js/select2.min.js')}}"></script>

<script src="{{asset('frontend/js/ckeditor.js')}}"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

<script>

    ClassicEditor

    .create( document.querySelector( '#description' ), {

        extraPlugins: [ MyCustomUploadAdapterPlugin ],

        toolbar: {

            items: [

            'heading', '|',

            'fontfamily', 'fontsize', '|',

            'alignment', '|',

            'fontColor', 'fontBackgroundColor', '|',

            'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',

            'link', '|',

            'outdent', 'indent', '|',

            'bulletedList', 'numberedList', 'todoList', '|',

            'code', 'codeBlock', '|',

            'insertTable', '|',

            'uploadImage', 'blockQuote', '|',

            'undo', 'redo'

        ],shouldNotGroupWhenFull: true

        }

    } )

    .then( editor => {

        console.log( Array.from( editor.ui.componentFactory.names() ) );

    } )

    .catch( error => {

        console.log( error );

    } );

  

  imgInp.onchange = evt => {

    const [file] = imgInp.files

    if (file) {

      defaultimg.src = URL.createObjectURL(file)

    }

  }

  imgInp2.onchange = evt => {

    const [file] = imgInp2.files

    if (file) {

      defaultimg2.src = URL.createObjectURL(file)

    }

  }

  

</script>



@endpush    

</x-admin-layout>