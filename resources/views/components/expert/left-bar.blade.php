<div class="AccountMenu">
    <button class="navbar-toggler d-none" type="button" id="AccMenuBar" data-bs-toggle="collapse" data-bs-target="#AccountMenu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span>Account Menu</span><i class="fa fa-bars"></i></button>
    <ul id="AccountMenu" class="collapse">
        <li><a href="expert-account/"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></a></li>
        <li><a href="expert-account/my-account.php"><span><i class="fal fa-user-edit me-1"></i> My Account</a></a></li>
        <li><a href="#mycalls" class="collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="mycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
            <ul class="collapse" id="mycalls">
                <li><a href="expert-account/scheduled-calls.php"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                <li><a href="expert-account/closed-call.php"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                <li><a href="expert-account/scheduled-calls.php"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
                <li><a href="expert-account/manage-slots.php"><span><i class="fal fa-tasks me-1"></i> Manage Slots</span></a></li>
            </ul>
        </li>
        <li><a href="expert-account/message.php"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
        <li><a href="expert-account/my-review.php"><span><i class="fal fa-star me-1"></i> My Reviews</span></a></li>
        <li><a href="expert-account/videos.php"><span><i class="fal fa-photo-video me-1"></i> My Video</span></a></li>
        <li><a href="expert-account/reports.php"><span><i class="fal fa-file-contract me-1"></i> Reports</span></a></li>
        <li><a href="expert-account/help-center.php"><span><i class="fal fa-user-headset me-1"></i> Help Center</span></a></li>
        <li><a href="{{route('expert.expertlogout')}}"><span><i class="fal fa-power-off me-1"></i> Logout</span></a></li>
    </ul>
</div>