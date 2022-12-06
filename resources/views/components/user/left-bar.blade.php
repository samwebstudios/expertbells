<div class="AccountMenu">
    <button class="navbar-toggler d-none" type="button" id="AccMenuBar" data-bs-toggle="collapse" data-bs-target="#AccountMenu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span>Account Menu</span><i class="fa fa-bars"></i></button>
    <ul id="AccountMenu" class="collapse">
        <li><a href="account/"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></li>
        <li><a href="account/my-account.php"><span><i class="fal fa-user-edit me-1"></i> My Account</a></li>
        <li><a href="#mycalls" class="collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="mycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
            <ul class="collapse" id="mycalls">
                <li><a href="account/call-request.php"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                <li><a href="account/closed-call.php"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                <li><a href="account/call-request.php"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
                <li><a href="account/book-expert.php"><span><i class="fal fa-user-plus me-1"></i> Book Expert</span></a></li>
            </ul>
        </li>
        <li><a href="account/message.php"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
        <li><a href="account/my-review.php"><span><i class="fal fa-star me-1"></i> My Reviews</span></a></li>
        <li><a href="account/help-center.php"><span><i class="fal fa-user-headset me-1"></i> Help Center</a></li>
        <li><a href="{{route('user.userlogout')}}"><span><i class="fal fa-power-off me-1"></i> Logout</a></li>
    </ul>
</div>