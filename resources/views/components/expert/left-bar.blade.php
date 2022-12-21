<div class="AccountMenu">
    <button class="navbar-toggler d-none" type="button" id="AccMenuBar" data-bs-toggle="collapse" data-bs-target="#AccountMenu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span>Account Menu</span><i class="fa fa-bars"></i></button>
    <ul id="AccountMenu" class="collapse">
        <li class="{{Request::segment(2)=='dashboard'?'active':''}}"><a href="{{route('expert.dashboard')}}"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></a></li>
        <li class="{{Request::segment(2)=='account'?'active':''}}"><a href="{{route('expert.account')}}"><span><i class="fal fa-user-edit me-1"></i> My Account</a></a></li>
        <li {{in_array(Request::segment(2),['schedules','reschedules'])?'active':''}}><a href="#mycalls" class="collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="mycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
            <ul class="collapse" id="mycalls">
                <li><a href="{{route('expert.schedules')}}"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                <li><a href="expert-account/closed-call.php"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                <li><a href="{{route('expert.reschedules')}}"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
            </ul>
        </li>
        <li class="{{Request::segment(2)=='slots'?'active':''}}"><a href="{{route('expert.slots')}}"><span><i class="fal fa-tasks me-1"></i> Manage Slots</span></a></li>
        <li><a href="expert-account/message.php"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
        <li class="{{Request::segment(2)=='videos'?'active':''}}"><a href="{{route('expert.videos')}}"><span><i class="fal fa-photo-video me-1"></i> My Video</span></a></li>
        <li><a href="expert-account/reports.php"><span><i class="fal fa-file-contract me-1"></i> Reports</span></a></li>
        <li {{Request::segment(2)=='help'?'active':''}}><a href="{{route('expert.help')}}"><span><i class="fal fa-user-headset me-1"></i>Help Center</span></a></li>
        <li><a href="{{route('expert.expertlogout')}}"><span><i class="fal fa-power-off me-1"></i> Logout</span></a></li>
    </ul>
</div>