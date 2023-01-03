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
                                <li><a href="{{route('experts')}}">Find an Expert</a></li>
                                <li><a href="{{route('becomeanexpert')}}">Become an Expert</a></li>
                                <li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="{{route('blog')}}">Blog</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Informations</h3>
                            <ul class="links">
                                <li><a href="{{route('contact')}}">Contact us</a></li>
                                <li><a href="{{route('faq')}}">FAQ</a></li>
                                <li><a href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                                <li><a href="{{route('termsandconditions')}}">Terms of Conditions</a></li>
                                <li><a href="{{route('careers')}}">Career</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Support</h3>
                            <p>Book the most in-demand experts & get advice over a video call</p>
                            <a href="{{route('becomeanexpert')}}" class="btn btn-thm btn-lg">Become an Expert <img src="{{asset('frontend/img/arrow.svg')}}" class="ms-2" width="30" height="30"></a>
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
@stack('js')
{{-- <script>flatpickr(".inlinecal",{
        inline:true,
        minDate: "today",        
        defaultDate: ["{{date('Y-m-d')}}"]
    });</script> --}}
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
function RemoveConfirmation(){
    if(confirm('Are you sure! you want to remove this record.')){
        return true;
    }
    return false;
}
$('.social-button').attr('target','_blank');
</script>
<div id="DeleteModal" class="modal fade">
	<div class="modal-dialog modal-sm  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center removemodalbox">
                <h6>ARE YOU SURE?</h6>
				<small>Do you really want to delete these records?</small>
                <small> This process will not be undone.</small><br>
                <input type="hidden" id="removeurl">              
                <a href="javascript:void(0);" onclick="$('.removerecord').hide(); $('.proremoverecord').show();" class="btn btn-danger mt-3 removerecord"><i class="fas fa-check"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger mt-3 proremoverecord disabled" style="display: none"><i class="fad fa-spinner-third fa-spin"></i></a>
                <button type="button" class="btn btn-secondary mt-3" onclick="$('.removerecord').attr('href','javascript:void(0);');" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>			
		</div>
	</div>
</div>  