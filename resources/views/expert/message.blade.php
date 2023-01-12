@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{url('expert.dashboard')}}"> Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Message</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="LeftPanelSec">
                        <div class="Leftpanel MLeftpanel">
                            <div class="Compose mb-2">
                                <span class="btn btn-thm3 w-100 mt-0 d-block SendMessage">Compose</span>
                                <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#MsgMenu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            </div>
                            <ul id="MsgMenu" class="collapse">
                                <li class="active"><a href="message.php"><i class="fal fa-inbox me-2"></i><span>Inbox <span class="badge bg-info ms-3">12</span></span></a></li>
                                <li><a href="message.php"><i class="fal fa-envelope me-2"></i> <span>Sent</span></a></li>
                                <li><a href="message.php"><i class="fal fa-star me-2"></i> <span>Star</span></a></li>
                                <li><a href="message.php"><i class="fal fa-trash me-2"></i> <span>Trash</span></a></li>
                                <li><a href="message.php"><i class="fal fa-archive me-2"></i> <span>Archive</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="MailBox card p-0">
                        <form method="POST" action="" id="formbox"><input type="hidden" name="_token" value="">
                            <div class="MailBoxR">
                                <div class="MBThead">
                                    <div class="row">
                                        <div class="col-2 justify-content-center"><h3>Inbox</h3></div>
                                        <div class="col-5 order-sm-first">
                                            <div class="form-check mr-2"><input type="checkbox" id="AllCheck" class="form-check-input"><label for="AllCheck" class="form-check-label">All</label></div>
                                            <button type="button" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Refresh"><i class="far fa-redo"></i></button>
                                            <button type="button" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Archive"><i class="far fa-archive"></i></button>
                                            <button type="button" class="btn btntag m-0 me-2 sws-top sws-bounce" data-title="Delete"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                        <div class="col-5">
                                            <div class="SearchBar">
                                                <input type="text" placeholder="Search" class="form-control msgsearch">
                                                <i class="fal fa-search"></i>
                                            </div>
                                            <div class="messagesearchbox"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MBmails">
                                    <ul>
                                        <li>
                                            <span class="check"><input type="checkbox" name="check[]" value="25" class="form-check-input"></span>
                                            <span class="mstar starbox25"><i class="far fa-star"></i></span>
                                            <a href="message-d.php">
                                                <div class="name">
                                                    <span>Mithun Parihar</span>
                                                </div>
                                                <div class="mail"><strong>test Subject test Subject test Subject </strong>- Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
                                                <div class="attachment"><i class="fal fa-paperclip"></i></div>
                                                <div class="date">28 Feb 28</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Message : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/message.css')}}">
<style type="text/css">
body>main,body section{overflow:inherit!important;}
</style>
@endpush
@push('js')
    <x-message-popup/>
    
@endpush