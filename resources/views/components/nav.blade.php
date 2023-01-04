<nav class="navbar navbar-expand-lg menu">
    <div class="st">
        <div class="container">
            <div>
                <div class="col logom"><a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('frontend/img/logo-w.svg')}}" alt="Expert Bells" width="300" height="68"></a></div>
                <div class="col LastH">
                    <ul>
                        <li class="d-none d-lg-block"><a href="{{route('experts')}}">Find an Expert</a></li>
                        <li class="d-none d-lg-block"><a href="">Expert Services</a></li>
                        @if(!\Auth::check() && !\Auth::guard('expert')->check())
                        <li class="d-none d-lg-block"><a href="{{route('login')}}" class="btn btn-thm m-0"><img src="{{asset('frontend/img/login.svg')}}" class="me-2" width="25" height="25"> Login</a></li>
                        @endif
                        <li>
                            <button class="navbar-toggler collapsed menubar" type="button" data-bs-toggle="collapse" data-bs-target="#navigatin" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span><span class="bar"></span><span class="bar"></span><span class="bar"></span></span></button>
                            <div class="menu-bg"></div>
                            <div class="collapse navbar-collapse justify-content-between" id="navigatin">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a class="nav-link" href="{{route('experts')}}">Find an Expert</a></li>
                                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Expert Services</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}"><span>About Us</span></a></li>
                                    <li class="nav-item "><a class="nav-link" href="{{route('becomeanexpert')}}"><span>Become An Expert</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('blog')}}"><span>Blog</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('careers')}}"><span>Career</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('contact')}}"><span>Contact Us</span></a></li>
                                </ul>
                            </div>
                        </li>
                        @if(\Auth::guard('expert')->check())
                        <li class="dropdown">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="{{route('expert.dashboard')}}" title="{{expertinfo()->name ?? ''}}">
                                <span class="userimg">
                                    <x-image-box>
                                        <x-slot:image>{{expertinfo()->profile}}</x-slot:image>
                                        <x-slot:path>/uploads/expert/</x-slot:path>
                                        <x-slot:alt>{{expertinfo()->name ?? ''}}</x-slot:alt>
                                        <x-slot:height>36</x-slot:alt>
                                        <x-slot:width>36</x-slot:alt>
                                    </x-image-box>
                                </span>
                            </a>
                            <div class="dropdown-menu NotiDrop">
                                <ul>
                                    <li class="{{Request::segment(2)=='dashboard'?'active':''}}"><a href="{{route('expert.dashboard')}}"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></a></li>
                                    <li class="{{Request::segment(2)=='account'?'active':''}}"><a href="{{route('expert.account')}}"><span><i class="fal fa-user-edit me-1"></i> My Account</a></a></li>
                                    <li><a href="#menumycalls" class="collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false" aria-controls="menumycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
                                        <ul class="collapse" id="menumycalls">
                                            <li><a href="{{route('expert.schedules')}}"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                                            <li><a href="expert-account/closed-call.php"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                                            <li><a href="{{route('expert.reschedules')}}"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="{{Request::segment(2)=='slots'?'active':''}}"><a href="{{route('expert.slots')}}"><span><i class="fal fa-tasks me-1"></i> Manage Slots</span></a></li>
                                    <li><a href="expert-account/message.php"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
                                    <li class="{{Request::segment(2)=='videos'?'active':''}}"><a href="{{route('expert.videos')}}"><span><i class="fal fa-photo-video me-1"></i> My Video</span></a></li>
                                    <li><a href="expert-account/reports.php"><span><i class="fal fa-file-contract me-1"></i> Reports</span></a></li>
                                    <li><a href="{{route('expert.help')}}"><span><i class="fal fa-user-headset me-1"></i> Help Center</span></a></li>
                                    <li><a href="{{route('expert.expertlogout')}}"><span><i class="fal fa-power-off me-1"></i> Logout</span></a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if(\Auth::check())
                        <li class="dropdown">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="{{route('user.dashboard')}}" title="{{userinfo()->name ?? ''}}">
                                <span class="userimg">
                                    <x-image-box>
                                        <x-slot:image>{{userinfo()->profile}}</x-slot:image>
                                        <x-slot:path>/uploads/user/</x-slot:path>
                                        <x-slot:alt>{{userinfo()->name ?? ''}}</x-slot:alt>
                                        <x-slot:height>36</x-slot:alt>
                                        <x-slot:width>36</x-slot:alt>
                                    </x-image-box>
                                </span>
                            </a>
                            <div class="dropdown-menu NotiDrop">
                                <ul>
                                    <li><a href="{{route('user.account')}}"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></li>
                                    <li><a href="{{route('user.account')}}"><span><i class="fal fa-user-edit me-1"></i> My Account</a></li>
                                    <li><a href="#Usermycalls" class="collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false" aria-controls="Usermycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
                                        <ul class="collapse" id="Usermycalls">
                                            <li><a href="{{route('user.schedules')}}"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                                            <li><a href="account/closed-call.php"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                                            <li><a href="{{route('user.reschedules')}}"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="account/message.php"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
                                    <li><a href="{{route('user.reviews')}}"><span><i class="fal fa-star me-1"></i> My Reviews</span></a></li>
                                    <li><a href="{{route('user.help')}}"><span><i class="fal fa-user-headset me-1"></i> Help Center</a></li>
                                    <li><a href="{{route('user.userlogout')}}"><span><i class="fal fa-power-off me-1"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        <li class="SearchBoxs">
                            <a data-bs-toggle="collapse" href="#Hsearch" role="button" aria-expanded="false" aria-controls="Search" title="Search"><span><img src="{{asset('frontend/img/search1.svg')}}" width="36" height="36"><!-- <i class="fal h5 fa-search m-0"></i> --></span></a>
                            <div id="Hsearch" class="collapse">
                                @csrf
                                <form action="{{url('search')}}" class="input-group mb-0">
                                    <input type="text" name="searchlist" placeholder="Search..." required aria-label="Search..." aria-describedby="searchbox" class="form-control">
                                    <button id="searchbox" class="input-group-text"><i class="fal fa-search"></i></button>
                                </form>
                                <div class="searchboxdata"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>