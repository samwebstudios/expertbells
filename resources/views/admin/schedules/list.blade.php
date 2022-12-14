@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <div class="col-md-6">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="breadcrumb-item active">Reject Schedules</span>
            </nav>
        </div>
        <div class="col-md-6">
            <div class="text-right">                              
            </div>
        </div>
    </div>
    <div class="br-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-sm-12 mg-t-20 mg-sm-t-0">
                <div class="card shadow-base bd-0">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0">
                            {{ ucwords(str_replace('-', ' ', Request::segment(2))) }} List</h6>
                        <span class="tx-12 tx-uppercase">{{ date('F d, Y') }}</span>
                    </div><!-- card-header -->
                    <div class="card-body justify-content-between align-items-center">
                        @if ($lists->count() == 0)
                            <x-admin.no-data-box />
                        @endif
                        @if ($lists->count() > 0)
                            <form method="POST" class="table-wrapper">
                                @csrf
                                <table class="table  table-bordered table-colored table-dark">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p">
                                                <label class="ckbox ckbox-success mb-0"><input type="checkbox"
                                                        id="checkall"><span></span></label>
                                            </th>
                                            <th class="wd-20p">Booking Information</th>
                                            <th class="wd-55p">Reject Information</th>
                                            <th class="wd-10p">Payment</th>
                                            <th class="wd-10p">Status</th>
                                            <th class="wd-5p">
                                                <div class="dropdown TAction show">
                                                    <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                                        data-toggle="dropdown" aria-expanded="true"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu" x-placement="bottom-end">
                                                        <li class="bulkremoveform"><a href="javascript:void(0)"
                                                                class="text-danger"><i class="fa fa-trash"></i> Bulk
                                                                Remove</a></li>
                                                    </ul>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lists as $list)
                                            <tr>
                                                <td>
                                                    <label class="ckbox ckbox-dark">
                                                        <input type="checkbox" class="listcheck" name="check[]"
                                                            value="{{ $list->id }}">
                                                        <span></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <small><b>Booking No :</b> #{{$list->booking_id}}</small><br>
                                                    <small><b>Booking Date :</b> {{ dateformat($list->booking_date) }}</small><br>
                                                    <small><b>Booking Time :</b> {{ substr($list->booking_start_time,0,-3) }} - {{ substr($list->booking_end_time,0,-3) }}</small>
                                                </td>
                                                
                                                <td>
                                                    <small><b>Expert :</b> {{ $list->expert->name ?? '' }} (#{{ $list->expert->user_id ?? '' }})</small><br>
                                                    <small><b>Date :</b> {{ datetimeformat($list->reject_date) }}</small><br>
                                                    <small><b>Reason :</b> {!! $list->reject_reason !!}</small><br>
                                                </td>
                                                <td>
                                                    @if($list->payment==0)<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small> @endif
                                                    @if($list->payment==1)<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid</small>@endif
                                                    @if($list->payment==2)<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Failed</small>@endif
                                                </td>
                                                <td>
                                                    <small class="text-secondary">{{$list->status==0?'New':''}}</small>
                                                    <small class="text-success">{{$list->status==1?'Confirm':''}}</small>
                                                    <small class="text-danger">{{$list->status==2?'Reject':''}}</small>
                                                </td>
                                                <td class="pd-r-0-force tx-center">

                                                    <div class="dropdown TAction show">

                                                        <a href="#" class="nav-link" data-toggle="dropdown"
                                                            aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>

                                                        <ul class="dropdown-menu" x-placement="bottom-end">

                                                            <li><a href="#editmodal" data-bs-type="assignexpert" data-bs-toggle="offcanvas"
                                                                    data-bs-id="{{ $list->id }}"><i class="fa fa-user-plus"></i> Assign Expert</a></li>
                                                            <li><a href="#editmodal" data-bs-type="information" data-bs-toggle="offcanvas"
                                                                data-bs-id="{{ $list->id }}"><i class="fa fa-book"></i> Information</a></li>
    
                                                            <li><a href="{{ route('admin.experts.remove', ['id' => $list->id]) }}"
                                                                    class="text-danger"
                                                                    onclick="return RemoveRecord()"><i
                                                                        class="fa fa-trash"></i> Remove</a></li>

                                                        </ul>

                                                    </div>

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                                {{ $lists->links() }}

                            </form>
                        @endif

                    </div><!-- card-body -->

                </div><!-- card -->

            </div><!-- col-4 -->

        </div><!-- row -->

    </div>

</div>
@endsection
@push('css')
    <title>Reject Schedules</title>
@endpush
@push('js')
    <script>
        $('[data-bs-type]').on('click',function(){
            let id = $(this).attr('data-bs-id');
            let type = $(this).attr('data-bs-type');
            loadingbox();
            if(type=='assignexpert'){
                $('.offcanvas-title').text('Assign Expert');
                $('.offcanvas-body').load(@json(route('admin.schedules.assignexpert'))+'?id='+id);
            }
            if(type=='information'){
                $('.offcanvas-title').text('Booking Information');
                $('.offcanvas-body').load(@json(route('admin.schedules.information'))+'?id='+id);
            }            
        });
    </script>
@endpush