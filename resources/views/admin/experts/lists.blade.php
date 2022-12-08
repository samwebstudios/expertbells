@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">

        <div class="br-pageheader pd-y-15 pd-l-20">

            <div class="col-md-6">

                <nav class="breadcrumb pd-0 mg-0 tx-12">

                    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <span class="breadcrumb-item active">Experts</span>

                </nav>

            </div>

            <div class="col-md-6">
                <div class="text-right">
                    <a href="#cmsmodel" data-bs-type="cmsmodel" data-bs-toggle="modal" data-bs-id="1" class="btn btn-dark btn-with-icon btn-xs sws-left sws-bounce" data-title="Request a time(CMS)">
                        <div class="ht-40">
                            <span class="icon wd-40"><i class="fas fa-file-alt"></i></span>
                        </div>
                    </a>
                    {{-- <a href="#cmsmodel" data-bs-type="cmsmodel" data-bs-toggle="modal" data-bs-id="2" class="btn btn-dark btn-with-icon btn-xs sws-left sws-bounce" data-title="Gift a session(CMS)">
                        <div class="ht-40">
                            <span class="icon wd-40"><i class="far fa-file-alt"></i></span>
                        </div>
                    </a>
                    <a href="#cmsmodel" data-bs-type="cmsmodel" data-bs-toggle="modal" data-bs-id="3" class="btn btn-dark btn-with-icon btn-xs sws-left sws-bounce" data-title="Special Note(CMS)">
                        <div class="ht-40">
                            <span class="icon wd-40"><i class="fas fa-files-medical"></i></span>
                        </div>
                    </a> --}}
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

                                                <th>Date</th>
                                                <th>Information</th>
                                                <th>Qualification</th>
                                                <th>Expertise</th>
                                                <th>Sequence</th>
                                                <th>Top</th>
                                                <th>Approved</th>
                                                <th class="wd-5p">
                                                    <div class="dropdown TAction show">

                                                        <a href="#" class="nav-link p-0 w-auto text-white text-center"
                                                            data-toggle="dropdown" aria-expanded="true"><i
                                                                class="fa fa-ellipsis-v"></i></a>

                                                        <ul class="dropdown-menu" x-placement="bottom-end">

                                                            <li class="sequenceform"><a href="javascript:void(0)"><i
                                                                        class="fa fa-sitemap"></i> Update Sequence</a>
                                                            </li>

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
                                                        {{ datetimeformat($list->created_at) }}<br>
                                                        <small><b>Expert Id :</b> {{ $list->user_id }}</small><br>
                                                        <small><b>Last login :</b>
                                                            {{ datetimeformat($list->last_login) }}</small>
                                                    </td>
                                                    <td>
                                                        {{ $list->name }}<br>
                                                        <small><b>Email :</b> {{ $list->email }}</small><br>
                                                        <small><b>Mobile :</b> {{ $list->mobile }}</small><br>
                                                    </td>
                                                    <td> {{ $list->qualification->title ?? '' }} </td>
                                                    <td> {{ $list->expertise->title ?? '' }} </td>
                                                    <td><input type="text" class="form-control" style="width: 80px;"
                                                            name="sequence[{{ $list->id }}]"
                                                            value="{{ $list->sequence }}"></td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" @checked($list->top_expert)
                                                                type="checkbox" value="{{ $list->id }}" role="switch"
                                                                onclick="topexpertstatus(this.value)"
                                                                id="ExpertSwitchCheckDefault{{ $list->id }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" @checked($list->is_publish)
                                                                type="checkbox" value="{{ $list->id }}" role="switch"
                                                                onclick="changestatus(this.value)"
                                                                id="flexSwitchCheckDefault{{ $list->id }}">
                                                        </div>
                                                    </td>
                                                    <td class="pd-r-0-force tx-center">

                                                        <div class="dropdown TAction show">

                                                            <a href="#" class="nav-link" data-toggle="dropdown"
                                                                aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>

                                                            <ul class="dropdown-menu" x-placement="bottom-end">

                                                                <li><a href="#editmodal" data-bs-toggle="offcanvas"
                                                                        data-bs-id="{{ $list->id }}"><i
                                                                            class="fa fa-pencil"></i> Edit</a></li>

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
@push('js')
    <script src="{{ asset('admin/lib/parsleyjs/parsley.js') }}"></script>
    <script>
        function RemoveRecord() {
            if (confirm('Are you sure! you want to remove this qualification.')) {
                return true;
            }
            return false;
        }
        $('.sequenceform').on('click', function() {
            $('.table-wrapper').attr('action', @json(route('admin.experts.sequence')));
            $('.table-wrapper').submit();
        });
        $('.bulkremoveform').on('click', function() {
            $('.table-wrapper').attr('action', @json(route('admin.experts.bulkremove')));
            $('.table-wrapper').submit();
        });
        function changestatus(id) {
            let status = 0;
            if ($('#flexSwitchCheckDefault' + id).prop('checked') == true) {
                status = 1;
            }
            let url = @json(route('admin.experts.status'));
            databasestatuschange(url, status, id);
        }
        function topexpertstatus(id){
            let status = 0;
            if ($('#ExpertSwitchCheckDefault' + id).prop('checked') == true) {
                status = 1;
            }
            let url = @json(route('admin.experts.topstatus'));
            databasestatuschange(url, status, id);
        }
        $('[data-bs-type]').on('click',function(){
            let id = $(this).attr('data-bs-id');
            $('.modal-content').html('<div class="text-center pd-20"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>');
            $('.modal-content').load(@json(url('control-panel/cmsmodal'))+'/'+id);
        });
    </script>
    <div id="cmsmodel" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content bd-0 tx-14">
                <div class="text-center pd-20"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>
            </div>
        </div><!-- modal-dialog -->
    </div>
@endpush
@push('css')
    <title>Experts : {{ project() }}</title>
    <link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
@endpush
