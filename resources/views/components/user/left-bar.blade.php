<div class="AccountMenu">
    <button class="navbar-toggler d-none" type="button" id="AccMenuBar" data-bs-toggle="collapse" data-bs-target="#AccountMenu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span>Account Menu</span><i class="fa fa-bars"></i></button>
    <ul id="AccountMenu" class="collapse">
        <li {{Request::segment(2)=='dashboard'?'active':''}}><a href="{{route('user.dashboard')}}"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></li>
        <li {{Request::segment(2)=='account'?'active':''}}><a href="{{route('user.account')}}"><span><i class="fal fa-user-edit me-1"></i> My Account</a></li>
        <li {{in_array(Request::segment(2),['schedules','reschedules'])?'active':''}}><a href="#mycalls" class="collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="mycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
            <ul class="collapse" id="mycalls">
                <li><a href="{{route('user.schedules')}}"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                <li><a href="account/closed-call.php"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                <li><a href="{{route('user.reschedules')}}"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
            </ul>
        </li>
        <li><a href="account/message.php"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
        <li {{Request::segment(2)=='reviews'?'active':''}}><a href="{{route('user.reviews')}}"><span><i class="fal fa-star me-1"></i> My Reviews</span></a></li>
        <li {{Request::segment(2)=='help'?'active':''}}><a href="{{route('user.help')}}"><span><i class="fal fa-user-headset me-1"></i> Help Center</a></li>
        <li><a href="{{route('user.userlogout')}}"><span><i class="fal fa-power-off me-1"></i> Logout</a></li>
    </ul>
</div>