<footer>
    <div class="FooterMid">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <a href="" class="flogo"><img src="{{asset('frontend/img/logo-w.svg')}}" alt="Expert Bells" width="150" height="120"></a>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
                <div class="col-12 col-lg-9 ps-lg-5">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Important Links</h3>
                            <ul class="links">
                                <li><a href="experts.php">Find an Expert</a></li>
                                <li><a href="become-an-expert.php">Become an Expert</a></li>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="blog.php">Blog</a></li>
                                <!-- <li><a href="">How it works</a></li> -->
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Informations</h3>
                            <ul class="links">
                                <li><a href="contact.php">Contact us</a></li>
                                <li><a href="faq.php">FAQ</a></li>
                                <li><a href="privacy-policy.php">Privacy Policy</a></li>
                                <li><a href="terms-and-conditions.php">Terms of Conditions</a></li>
                                <li><a href="careers.php">Career</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Support</h3>
                            <p>Book the most in-demand experts & get advice over a video call</p>
                            <a href="become-an-expert.php" class="btn btn-thm btn-lg">Become an Expert <img src="{{asset('frontend/img/arrow.svg')}}" class="ms-2" width="30" height="30"></a>
                            <ul class="icons mt-3">
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                                <!-- <li><a href="#" title="Pinterest"><i class="fab fa-pinterest-p"></i></a></li> -->
                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fbottom">
                <div class="row align-items-center">
                    <div class="col-md-4"><p class="mb-1">&copy; Copyright 2022 <strong>Expert Bells</strong> All Rights Reserved.</p></div>
                    <div class="col-md-4 text-center"></div>
                    <div class="col-md-4 text-end"><p>Made with &nbsp;<strong><i class="fa fa-heart text-danger"></i></strong>&nbsp; by <strong><a href="https://www.samwebstudio.com/" target="_blank">SAM Web Studio</a></strong></p></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade RighSide BookS AddPro" id="BookExpert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BookExpertLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content">
            <div class="modal-header p-0 border-0">
                <!-- <h2 class="h5 modal-title" id="BookExpertLabel">Select times</h2> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body PopupDetail py-3 p-4">
                <div class="sTimeScreen">
                    <div class="ContainBOx">
                        <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Select Duration</h3>
                        <div class="pb-2 mb-2">
                            <!-- <h3 class="h5 text-secondary">1) Select the call duration:</h3> -->
                            <ul class="p-0 mb-0 TimeBox TopTimeBox">
                                <li>
                                    <div class="form-check"><label class="form-check-label d-flex" for="s1" data-price="50" data-cprice="60"><input type="radio" class="form-check-input" name="Sizes" id="s1" autocomplete="off" checked> <span>Quick - 15 Min</span></label></div>
                                </li>
                                <li>
                                    <div class="form-check"><label class="form-check-label d-flex" for="s2" data-price="90" data-cprice="105"><input type="radio" class="form-check-input" name="Sizes" id="s2" autocomplete="off"> <span>Regular - 30 Min</span></label></div>
                                </li>
                                <li>
                                    <div class="form-check"><label class="form-check-label d-flex" for="s3" data-price="130" data-cprice="155"><input type="radio" class="form-check-input" name="Sizes" id="s3" autocomplete="off"> <span>Extra - 45 Min</span></label></div>
                                </li>
                                <li>
                                    <div class="form-check"><label class="form-check-label d-flex" for="s4" data-price="160" data-cprice="190"><input type="radio" class="form-check-input" name="Sizes" id="s4" autocomplete="off"> <span>All Access - 60 Min</span></label></div>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Pick the Date</h3>
                                <input type="hidden" class="form-control inlinecal d-none" id="dob" name="dob" placeholder="Date of Birth">
                            </div>
                            <div class="col-md-6">
                                <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Select the Time slot</h3>
                                <div class="SetTimeBox">
                                    <span class="SetInfo thm"><span><i class="fas fa-info-circle me-2"></i> All times are in UTC+05:30 (IST)</span> <i class="far fa-chevron-right"></i></span>
                                    <ul class="p-0 TimeBox">
                                        <li><input type="radio" class="btn-check" name="timing" id="t1" autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t1">09:00 am</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t2" autocomplete="off" disabled><label class="btn" for="t2">10:00 am</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t3" autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t3">11:00 am</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t4" autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t4">12:00 am</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t5" autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t5">01:00 pm</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t6" autocomplete="off" disabled><label class="btn" for="t6">02:00 pm</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t7" autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t7">03:00 pm</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t8" autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t8">04:00 pm</label></li>
                                        <li><input type="radio" class="btn-check" name="timing" id="t9" autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available time slot" for="t9">05:00 pm</label></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-sticky border-top">
                        <div class="price m-0 h4"><strong>Price:</strong> <i class="Ricon">&#8377;</i> <span class="mprice">50</span>/- <del style="display:none;" class="cprice"><i class="Ricon">&#8377;</i> <span class="bprice">60</span>/-</del> <span class="h6">(Per Session)</span></div>
                        <a href="login-book-expert.php" class="btn btn-thm4 btn-lg px-5 mt-0 Request" style="display:none">Request</a>
                        <a href="#BookExpert" data-bs-toggle="modal" class="btn btn-thm4 m-0">Book Now <i class="fal fa-chevron-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Optional CSS; -->


<link rel="preload" as="style" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" onload="this.rel='stylesheet'" crossorigin="anonymous"/>
<!-- <link rel="preload" as="style" href="css/font-awesome-5-15-4.min.css" onload="this.rel='stylesheet'" crossorigin="anonymous"/> -->

<div id="scroll-top"><i class="far fa-chevron-up"></i></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{asset('frontend/js/custom.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js" integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('js')
<script>flatpickr(".inlinecal",{inline:true});</script>
<script type="text/javascript">
$(document).ready(function() {
        toastr.options =
          {
          "closeButton" : true,
          "progressBar" : true,
          "positionClass" : "toast-top-center"
          }
        @if(Session::has('success'))
          toastr.success("{{ session('success') }}");
        @endif
        @if(Session::has('warning'))
          toastr.warning("{{ session('warning') }}");
        @endif        
        @if(Session::has('error'))
          toastr.error("{{ session('error') }}");
        @endif
    }); 
      setTimeout(function(){

        $('.alert').fadeOut();

      },5000);
$('.TimeBox.Date .btn-check').click(function() {
    $('.SetTimeBox').fadeIn();
    $('.Request').fadeIn();
    $('.DateBox').hide();
});
$('.SetTimeBox .btn-back').click(function() {
    $('.SetTimeBox').hide();
    $('.DateBox').fadeIn();
});
$('.TopTimeBox li').find('label').click(function() {
    var price = $(this).data('price');
    var cprice = $(this).data('cprice');
    $('.price del').fadeIn();
    $('.mprice').text(price);
    $('.bprice').text(cprice);
});
</script>