<nav class="navbar navbar-expand-lg menu">
    <div class="st">
        <div class="container">
            <div>
                <div class="col logom"><a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('frontend/img/logo-w.svg')}}" alt="Expert Bells" width="300" height="68"></a></div>
                <div class="col LastH">
                    <ul>
                        <li class="d-none d-lg-block"><a href="experts.php">Find an Expert</a></li>
                        <li class="d-none d-lg-block"><a href="">Expert Services</a></li>
                        <li class="d-none d-lg-block"><a href="{{route('login')}}" class="btn btn-thm m-0"><img src="{{asset('frontend/img/login.svg')}}" class="me-2" width="25" height="25"> Login</a></li>
                        <li>
                            <button class="navbar-toggler collapsed menubar" type="button" data-bs-toggle="collapse" data-bs-target="#navigatin" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span><span class="bar"></span><span class="bar"></span><span class="bar"></span></span></button>
                            <div class="menu-bg"></div>
                            <div class="collapse navbar-collapse justify-content-between" id="navigatin">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a class="nav-link" href="experts.php">Find an Expert</a></li>
                                    <li class="nav-item"><a class="nav-link" href="">Expert Services</a></li>
                                    <li class="nav-item active"><a class="nav-link" href="about.php"><span>About Us</span></a></li>
                                    <li class="nav-item "><a class="nav-link" href="experts.php"><span>Experts</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="blog.php"><span>Blog</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="careers.php"><span>Career</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="contact.php"><span>Contact Us</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="account" title="account"><span><img src="{{asset('frontend/img/user1.svg')}}" width="36" height="36"></span></a></li>
                        <li class="SearchBoxs">
                            <a data-bs-toggle="collapse" href="#Hsearch" role="button" aria-expanded="false" aria-controls="Search" title="Search"><span><img src="{{asset('frontend/img/search1.svg')}}" width="36" height="36"><!-- <i class="fal h5 fa-search m-0"></i> --></span></a>
                            <div id="Hsearch" class="collapse">
                                <div class="input-group mb-0">
                                    <input type="text" placeholder="Search..." aria-label="Search..." aria-describedby="searchbox" class="form-control">
                                    <button id="searchbox" class="input-group-text"><i class="fal fa-search"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>