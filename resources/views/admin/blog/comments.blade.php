<x-admin-layout>
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <div class="col-md-6">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
                    <a class="breadcrumb-item" href="{{route('admin.blog-management')}}">Blog Management</a>
                    <span class="breadcrumb-item active">Blog Comments</span>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <a href="{{route('admin.blog-management')}}" class="btn btn-dark btn-with-icon">
                        <div class="ht-40">
                            <span class="icon wd-40"><i class="fa fa-file-text"></i></span>
                            <span class="pd-x-15">Blog Management</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4 mb-2">
                        <form class="searchform" action="{{url()->current()}}">
                            @csrf
                            <div class="input-group">
                                <input type="text" autocomplete="off" name="result"
                                    value="{{!empty($_GET['result']) ? $_GET['result'] : ''}}" class="form-control" required
                                    placeholder="Search Title..." aria-label="Search Product"
                                    aria-describedby="basic-addon2">
                                <button class="input-group-text btn btn-dark ml-1" id="basic-addon2"><i
                                        class="fa fa-search"></i></button>
                                <a href="{{url()->current()}}" class="input-group-text btn btn-dark ml-1 sws-top sws-bounce"
                                    data-title="Refresh" id="basic-addon2"><i class="fa fa-refresh"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="table  table-bordered table-colored table-dark">
                        <thead>
                            <tr>
                                <th class="wd-5p">S.No</th>
                                <th>Date</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Reply</th>
                                <th>Customer</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @foreach($lists as $list)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{date('d M Y',strtotime($list->created_at))}}</td>
                                <td>
                                    @php $explode = explode('.',imagedecript($list->blog->image)) @endphp
                                    @if(strtoupper(end($explode))=='SVG' || strtoupper(end($explode))=='WEBP')
                                    <img src="{{asset('up/bg/og/'.imagedecript($list->blog->image))}}"  class="defaultimgcss" style="width:100px;">
                                    @else
                                    <img src="{{asset('up/bg/jpg/'.imagedecript($list->blog->jpg_image))}}"  class="defaultimgcss" style="width:100px;">
                                    @endif
                                </td>
                                <td>{{$list->blog->title}}</td>
                                <td>
                                    <a href="{{action('Admin\BlogController@Comments',['id'=>$list->blog->id,'comment'=>$list->id])}}" data-title="Reply" class="btn btn-outline-dark btn-icon rounded-circle sws-top sws-bounce">
                                        <div>{{count($list->allreply)}}</div>
                                    </a>
                                </td>
                                <td>{{$list->name}} <br> {{$list->email}}<br> ip : {{$list->ip}}</td>
                                <td>
                                    <p id="text{{$list->id}}">{!! substr($list->comments,0,50) !!}... <a href="javascript:void(0)" onclick="Showtext({{$list->id}})">Read More</a></p>
                                    <p id="filltext{{$list->id}}" style="display:none;">{!! $list->comments !!} <a href="javascript:void(0)" onclick="Lesstext({{$list->id}})">Less text</a></p>
                                </td>
                                <td>
                                    @if($list->status==0)
                                    <a href="{{action('Admin\BlogController@CommentStatus',['status'=>1,'id'=>$list->id])}}"
                                        class="btn btn-outline-danger btn-icon rounded-circle sws-top sws-bounce"
                                        data-title="De-Activated">
                                        <div><i class="fa fa-thumbs-down"></i></div>
                                    </a>
                                    @else
                                    <a href="{{action('Admin\BlogController@CommentStatus',['status'=>0,'id'=>$list->id])}}"
                                        class="btn btn-outline-success btn-icon rounded-circle sws-top sws-bounce"
                                        data-title="Activated">
                                        <div><i class="fa fa-thumbs-up"></i></div>
                                    </a>
                                    @endif
                                </td>
                                <td class="pd-r-0-force tx-center">
                                    <a href="javascript:void(0)"
                                        class="btn btn-outline-danger btn-icon rounded-circle sws-top sws-bounce"
                                        data-title="Remove" onclick="RemoveRecord({{$list->id}})">
                                        <div><i class="fa fa-trash"></i></div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$lists->links()}}
                </div>
            </div>
        </div>
        <x-admin.footer />
    </div>
    
    
    <form method="post" action="{{route('admin.blog-comment-remove')}}" id="RemoveForm">@csrf<input type="hidden"
            name="removeId" id="removeId"></form>
    @push('style')
    <link href="{{asset('admin/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/fonts/flaticon/flaticon.css')}}" />
    <link href="{{asset('admin/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/jquery.steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/SpinKit/spinkit.css')}}" rel="stylesheet">
    <title>Blog Management : {{project()}}
    </title>
    <style>
        .more {display: none;}
    </style>
    @endpush
    @push('scripts')
    <script src="{{asset('admin/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
    function RemoveRecord(Id) {
        if (confirm("Are you sure! You want to remove this record.")) {
            $('#removeId').val(Id);
            $('#RemoveForm').submit();
        }
    }
    function Showtext(Id){
        $('#filltext'+Id).show();
        $('#text'+Id).hide();
    }
    function Lesstext(Id){
        $('#filltext'+Id).hide();
        $('#text'+Id).show();
    }
    </script>
    
    @endpush
</x-admin-layout>