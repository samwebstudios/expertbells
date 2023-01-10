
function goBack() {window.history.back();}
function maxLengthCheck(object) {
    if (object.value.length > object.maxLength)
    object.value = object.value.slice(0, object.maxLength)
}
function increment_val(){
    var da=$("#qty").val();
    var newQuantity = parseInt(da)+1;
    $("#qty").val(newQuantity);
} 
function decrement_quantity(){
    var da=$("#qty").val();
    var inputQuantityElement = $("#qty");
    if($(inputQuantityElement).val() > 1) {
        var newQuantity = parseInt(da)-1;
        $("#qty").val(newQuantity);
    }
}
$(function () {$("[data-bs-toggle=tooltip").tooltip();});

// document.addEventListener("DOMContentLoaded", function(){
//     // $('.preloader').delay(1700).fadeOut('slow');
//     // $('.preloader-img').delay(1700).fadeOut();
//     $('.preloader').fadeOut('slow');
//     $('.preloader-img').fadeOut();
// });
function counter(){
    var count = setInterval(function(){
        var c = parseInt($(".preloader-counter").text());
        $(".preloader-counter").text((++c).toString());
        if(c == 100) {
            clearInterval(count);
            $(".preloader-counter").addClass("hide");
            $(".preloader").addClass("active");
        }
    },40)
} counter();

$(document).ready(function(){
    // Menu active add function
    var url = window.location;
    $('.navbar .LastH li a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
    $('.navbar .LastH li .dropdown-menu a').filter(function() {
        return this.href == url;
    }).closest('.nav-item').addClass('active').closest('.dropdown').addClass('active');
    // Menu active add function End

    // tabnav on scroll
    var topMenu = jQuery(".SerMenu"),
    offset = -100,
    topMenuHeight = topMenu.outerHeight()+offset,
    menuItems =  topMenu.find('a[href*="#"]'),
    scrollItems = menuItems.map(function(){
        var href = jQuery(this).attr("href"),
        id = href.substring(href.indexOf('#')),
        item = jQuery(id);
        //console.log(item)
        if (item.length) { return item; }
    });
    menuItems.click(function(e){
        var href = jQuery(this).attr("href"),
        id = href.substring(href.indexOf('#'));
        offsetTop = href === "#" ? 0 : jQuery(id).offset().top-topMenuHeight+3;
        jQuery('html, body').stop().animate({scrollTop: offsetTop}, 300);
        e.preventDefault();
    });
    jQuery(window).scroll(function(){
        // Get container scroll position
        var fromTop = jQuery(this).scrollTop()+topMenuHeight;
        var cur = scrollItems.map(function(){
            if (jQuery(this).offset().top < fromTop)
            return this;
        });
        cur = cur[cur.length-1];
        var id = cur && cur.length ? cur[0].id : "";
        menuItems.parent().removeClass("active");
        if(id){
            menuItems.parent().end().filter("[href*='#"+id+"']").parent().addClass("active");
        }
    });

    // var rellax = new Rellax('.rellax', { center: true });
    $('.SearchBox .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.SearchBox #search_concept').text(concept);
    });
    $(document).click(function(e) {
        if (!$(e.target).is('#navigatin , #navigatin *')) {
            // $('body').css('overflow','inherit');
            // $('#navigatin').removeClass('show');
        }
    });
    $('.menubar').click(function (e) {
        if($(this).attr("aria-expanded") === "true"){
            $('body').css('overflow','hidden');
            e.stopPropagation();
        }else if($(this).attr("aria-expanded") === "false"){
            $('body').css('overflow','inherit');
            e.stopPropagation();
        }
    });
    $('.MenuBar .logo .navbar-toggler').click(function (e) {
        $('body').css('overflow','inherit');
    });
    $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    if ($(window).width() > 992){
        $('.MenuLeft').addClass('show');
        $(window).scroll(function () {
            if ($(this).scrollTop() >38) {
                $('.navbar.menu>.st').addClass('is-fixed');
            } else {
                $('.navbar.menu>.st').removeClass('is-fixed');
            }
            if ($(this).scrollTop() > 50) {
                $('#scroll-top').fadeIn();
            } else {
                $('#scroll-top').fadeOut();
            }
        });
    };
    if ($(window).width() < 991){
        $(window).scroll(function () {
            if ($(this).scrollTop() >60) {
                $('.navbar.menu>.st').addClass('is-fixed');
                $('.BuyBtnBox').addClass('fullboxby');
                $('.cartbox.right .card-footer').addClass('fullboxby');
            } else {
                $('.navbar.menu>.st').removeClass('is-fixed');
                $('.BuyBtnBox').removeClass('fullboxby');
                $('.cartbox.right .card-footer').removeClass('fullboxby');
            }
            if ($(this).scrollTop() > 50) {
                $('#scroll-top').fadeIn();
            } else {
                $('#scroll-top').fadeOut();
            }
        });
    };
    $('#scroll-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    $('.SignUpMobal').click(function (){
        if ($('#login').hasClass('show')){
            $('#login').modal('hide');
            $('#SignUp').modal('show');
            $('body').addClass('modal-SignUp');
        }
    });
    $('.LoginMobal').click(function (){
        if ($('#SignUp').hasClass('show')){
            $('#SignUp').modal('hide');
            $('body').removeClass('modal-SignUp');
            $('#login').modal('show');
        }
    });
    $('.btn-close').click(function (){
        $('body').removeClass('modal-SignUp');
    });
    $('#loginsec').click(function(){
        $('.ForgotSec').removeClass('active');
        $('.LoginSec').addClass('active');
    });
    $('#fpsec').click(function(){
        $('.LoginSec').removeClass('active');
        $('.ForgotSec').addClass('active');
    });
    $('#lpass-icon').click(function(){
        if ($(this).hasClass('fa-eye')){
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('.lpass').attr('type', 'password');
        } else {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('.lpass').attr('type', 'text');
        }
    });
    $('#npass-icon').click(function(){
        if ($(this).hasClass('fa-eye')){
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('.npass').attr('type', 'password');
        } else {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('.npass').attr('type', 'text');
        }
    });
    $('#cpass-icon').click(function(){
        if ($(this).hasClass('fa-eye')){
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('.cpass').attr('type', 'password');
        } else {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('.cpass').attr('type', 'text');
        }
    });

    // Country Select //
    var conr;
    $('.CountrySelect .dropdown-menu').find('li').click(function(e) {
        e.preventDefault();
        // var concept = $(this).text();
        var conn = $(this).data('code');
        var spa = $(this).data('text');
        var conc = $(this).data('code');
        // $('.CountrySelect #CountryName').text(concept);
        $('.CountrySelect #CountryName').text(conn);
        $('.CountrySelect a .flagicon').removeClass("fi-"+conr).addClass("fi-"+conc);
        $('.CountrySelect #ccode').val(spa);
        conr = conc;
    });
    $('.CurrencySelect .dropdown-menu').find('li').click(function(e) {
        e.preventDefault();
        var curc = $(this).data('code');
        var curt = $(this).data('name');
        $('.CurrencySelect .dropdown-toggle i').text(curc);
        $('.CurrencySelect .dropdown-toggle span').text(curt);
    });
    if ($(window).width() < 991){
        $("#AccMenuBar").removeClass('d-none');
        $("#AccountMenu").addClass('collapse');
    };
    $('.countrylist .SearchConCode').on( "keyup", function() {
        val = $(this).val().toLowerCase();
        $(".countrylist li").each(function () {
            $(this).toggle($(this).text().toLowerCase().includes(val));
        });
    });
});
jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
let isNumber = (evt) => {
    let iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}
$(document).on('keypress', '.inputTextBox', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});
function clearAllInterval(){
    const interval_id = window.setInterval(function(){}, Number.MAX_SAFE_INTEGER);
    // Clear any timeout/interval up to that id
    for (let i = 1; i < interval_id; i++) {
    window.clearInterval(i);
    }
}

///// User Register
$('.mobileformbtn').on('click',function(){
    sendMobileVerificationotp();
});
$('.resendemobileformbtn').on('click',function(){
    sendMobileVerificationotp();
});
$('.emailformbtn').on('click',function(){
    sendEmailVerificationotp();
});
$('.resendemailformbtn').on('click',function(){
    sendEmailVerificationotp();
});
function sendEmailVerificationotp(){
    let email = $('input[name=email]').val();
    $('.email-error').html('');
    $('.evsbtn').hide();
    $('.evpbtn').show();
    $.ajax({
        data:{email:email,_token:$('meta[name=csrf-token]').attr('content')},
        dataType:'Json',
        method:'POST',
        url:UserEmailVerify,
        success:function(success){
            toastr.success(success.success);
            $(this).hide();
            $('.CustomerInfo+.OTPbox').show();
            $('input[name=oldemailotp]').val(success.otp);            
            $('.resendcounter').show(); 
            $('.resendemail').hide();
            $('.evsbtn').hide();
            $('.evpbtn').hide();
            var cancel = setInterval(incrementSeconds, 1000); 
            var seconds = 30;
            var el = document.getElementById('seconds-counter');
            function incrementSeconds() {
                seconds = Number(seconds) - 1;
                el.innerText = seconds + "s";
                if(seconds==0){ clearInterval(cancel); $('#seconds-counter').html('30s'); $('.resendcounter').hide(); $('.resendemail').show(); }
            }
                      
        },
        error:function(error){
            if(error.responseJSON.errors.email!==undefined){
                $('.email-error').text(error.responseJSON.errors.email);
            }
            $('.evsbtn').show();
            $('.evpbtn').hide();
        }
    });
}
function sendMobileVerificationotp(){
    let Mobile = $('input[name=mobile]').val();
    $('.mobile-error').html('');
    $('.mvsbtn').hide();
    $('.mvpbtn').show();
    $.ajax({
        data:{mobile:Mobile,_token:$('meta[name=csrf-token]').attr('content')},
        dataType:'Json',
        method:'POST',
        url:UserMobileVerify,
        success:function(success){
            toastr.success(success.success);
            $(this).hide();
            $('.CountryBox+.OTPbox').show();
            $('input[name=oldmobileotp]').val(success.otp);            
            $('.m-resendcounter').show(); 
            $('.m-resendemail').hide();
            $('.mvsbtn').show();
            $('.mvpbtn').hide();
            $('.otppre').html('OTP is : '+success.otp);
            var cancel = setInterval(incrementSeconds, 1000); 
            var seconds = 30;
            var el = document.getElementById('m-seconds-counter');
            function incrementSeconds() {
                seconds = Number(seconds) - 1;
                el.innerText = seconds + "s";
                if(seconds==0){ clearInterval(cancel); $('#m-seconds-counter').html('30s'); $('.m-resendcounter').hide(); $('.m-resendemail').show(); }
            }
                      
        },
        error:function(error){
            if(error.responseJSON.errors.mobile!==undefined){
                $('.mobile-error').text(error.responseJSON.errors.mobile);
            }
            $('.mvsbtn').show();
            $('.mvpbtn').hide();
        }
    });
}
$('.mvcsbtn').on('click',function(){
    let O1 = $('input[name=mobileotp1]').val();
    let O2 = $('input[name=mobileotp2]').val();
    let O3 = $('input[name=mobileotp3]').val();
    let O4 = $('input[name=mobileotp4]').val();
    let oldotp = $('input[name=oldmobileotp]').val();
    $('.mobileotp-error').html('');
    $('.mvcsbtn').hide();
    $('.mvcpbtn').show();    
    let otp = O1+O2+O3+O4;
    if(isNaN(parseInt(O1))==true){
        $('input[name=mobileotp1]').focus();
        $('.mvcsbtn').show();
        $('.mvcpbtn').hide();
    }
    else if(isNaN(parseInt(O2))==true){
        $('input[name=mobileotp2]').focus();
        $('.mvcsbtn').show();
        $('.mvcpbtn').hide();
    }
    else if(isNaN(parseInt(O3))==true){
        $('input[name=mobileotp3]').focus();
        $('.mvcsbtn').show();
        $('.mvcpbtn').hide();
    }
    else if(isNaN(parseInt(O4))==true){
        $('input[name=mobileotp4]').focus();
        $('.mvcsbtn').show();
        $('.mvcpbtn').hide();
    }
    else if(oldotp!=otp){ 
        $('.mobileotp-error').html('Invalid OTP!');
        $('input[name=mobileotp1]').val('');
        $('input[name=mobileotp2]').val('');
        $('input[name=mobileotp3]').val('');
        $('input[name=mobileotp4]').val('');
        $('.mvcsbtn').show();
        $('.mvcpbtn').hide();
    }else{
        $('.MobileOTPbox').hide();
        $('.mvspbtn').show();
        $('.mvpbtn').hide();
        $('.mvsbtn').hide();        
        $('input[name=mobileverify]').val(1);
    }
});
$('.evcsbtn').on('click',function(){
    let O1 = $('input[name=emailotp1]').val();
    let O2 = $('input[name=emailotp2]').val();
    let O3 = $('input[name=emailotp3]').val();
    let O4 = $('input[name=emailotp4]').val();
    let oldotp = $('input[name=oldemailotp]').val();
    $('.emailotp-error').html('');
    let otp = O1+O2+O3+O4;
    if(isNaN(parseInt(O1))==true){$('input[name=emailotp1]').focus(); }
    else if(isNaN(parseInt(O2))==true){$('input[name=emailotp2]').focus();}
    else if(isNaN(parseInt(O3))==true){$('input[name=emailotp3]').focus();}
    else if(isNaN(parseInt(O4))==true){$('input[name=emailotp4]').focus();}
    else if(oldotp!=otp){ 
        $('.emailotp-error').html('Invalid OTP!');
        $('input[name=emailotp1]').val('');
        $('input[name=emailotp2]').val('');
        $('input[name=emailotp3]').val('');
        $('input[name=emailotp4]').val(''); 
    }else{
        $('.EmailOTPbox').hide();
        $('.evspbtn').show();
        $('.evpbtn').hide();
        $('input[name=emailverify]').val(1);
    }
});
$('.step1form').on('submit',function(e){
    e.preventDefault();
    $('.sbtn').hide();
    $('.pbtn').show();
    $('.error').html('');
    $.ajax({
        data:new FormData(this),
        url:UserFirstStepUrl,
        method:'POST',
        dataType:'Json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
            window.location.href=data.redirect;
        },
        error:function(response){            
            if(response.responseJSON.errors.first_name!== undefined){
                $('.first-error').text(response.responseJSON.errors.first_name);
            }  
            if(response.responseJSON.errors.mobile!== undefined){
                $('.mobile-error').text(response.responseJSON.errors.mobile);
            } 
            if(response.responseJSON.errors.mobileverify!== undefined){
                $('.mobile-error').text(response.responseJSON.errors.mobileverify);
            } 
            if(response.responseJSON.errors.email!== undefined){
                $('.email-error').text(response.responseJSON.errors.email);
            } 
            if(response.responseJSON.errors.emailverify!== undefined){
                $('.email-error').text(response.responseJSON.errors.emailverify);
            }
            if(response.responseJSON.errors.password!== undefined){
                $('.password-error').text(response.responseJSON.errors.password);
            } 
            $('.sbtn').show();
            $('.pbtn').hide(); 
        }
    });
});

//// User Login
$('.resendemobileformbtn').on('click',function(e){
    userlogin();
});
$('.userloginform').on('click',function(e){
    userlogin();
});
$('.checkuserloginotp').on('submit',function(e){
    let O1 = $('input[name=usermobileotp1]').val();
    let O2 = $('input[name=usermobileotp2]').val();
    let O3 = $('input[name=usermobileotp3]').val();
    let O4 = $('input[name=usermobileotp4]').val();
    $('.user-mobileotp-error').html('');
    $('.otpsvbtn').hide();
    $('.otppcbtn').show();    
    let otp = O1+O2+O3+O4;
    e.preventDefault();
    if(isNaN(parseInt(O1))==true){
        $('input[name=usermobileotp1]').focus();
        $('.otpsvbtn').show();
        $('.otppcbtn').hide();
    }
    else if(isNaN(parseInt(O2))==true){
        $('input[name=usermobileotp2]').focus();
        $('.otpsvbtn').show();
        $('.otppcbtn').hide();
    }
    else if(isNaN(parseInt(O3))==true){
        $('input[name=usermobileotp3]').focus();
        $('.otpsvbtn').show();
        $('.otppcbtn').hide();
    }
    else if(isNaN(parseInt(O4))==true){
        $('input[name=usermobileotp4]').focus();
        $('.otpsvbtn').show();
        $('.otppcbtn').hide();
    }
    else{
        let form = new FormData(this);
        form.append('otp', otp);
        form.append('email', $('.uemailnmobile').val());
        $.ajax({
            data:form,
            url:UserLoginCheckOtp,
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                window.location.href=data.redirect;
            },
            error:function(response){            
                if(response.responseJSON.errors.otp!== undefined){
                    $('.user-mobileotp-error').text(response.responseJSON.errors.otp);
                }  
                if(response.responseJSON.errors.email!== undefined){
                    $('.u-email-error').text(response.responseJSON.errors.email);
                } 
                $('input[name=usermobileotp1]').val('');
                $('input[name=usermobileotp2]').val('');
                $('input[name=usermobileotp3]').val('');
                $('input[name=usermobileotp4]').val('');
                $('.otpsvbtn').show();
                $('.otppcbtn').hide();
            }
        });
    }
});
function userlogin(){
    $('.error').html('');
    $('.usbtn').hide();
    $('.uvpbtn').show();
    let email = $('.uemailnmobile').val();
    clearAllInterval();
    $.ajax({
        data:{_token:$('meta[name=csrf-token]').attr('content'),email:email},
        url:UserLoginUrl,
        method:'POST',
        dataType:'Json',
        success:function(data){
            let first2 = String(email).slice(0, 2);
            let last3 = String(email).slice(-3);
            toastr.success(data.success);
            $('.UserLogin .OTPbox').show();
            $('.usersendfor').html('Sent to <strong>'+first2+'*******'+last3+'</strong>');
            var seconds = 30;
            var cancel = setInterval(incrementSeconds, 1000); 
            var el = document.getElementById('user-seconds-counter');
            function incrementSeconds() {
                seconds = Number(seconds) - 1;
                el.innerText = seconds + "s";
                if(seconds==0){ clearInterval(cancel); $('#user-seconds-counter').html('30s'); $('.userresendcounter').hide(); $('.userresendemail').show(); }
            }
            $('.usbtn').show();
            $('.uvpbtn').hide();
            if(data.otpfor==1){
                $('.userotppreview').html('Your Otp Is: '+data.otp);
            }            
        },
        error:function(response){            
            if(response.responseJSON.errors.email!== undefined){
                $('.u-email-error').text(response.responseJSON.errors.email);
            }  
            $('.UserLogin .OTPbox').hide();
            clearAllInterval();
            $('.usbtn').show();
            $('.uvpbtn').hide();
        }
    });
}


/// Expert Login
//// User Login
$('.expertresendeformbtn').on('click',function(e){
    expertlogin();
});
$('.expertloginform').on('click',function(e){
    expertlogin();
});
$('.checkexpertloginotp').on('submit',function(e){
    let O1 = $('input[name=expertmobileotp1]').val();
    let O2 = $('input[name=expertmobileotp2]').val();
    let O3 = $('input[name=expertmobileotp3]').val();
    let O4 = $('input[name=expertmobileotp4]').val();
    $('.expert-mobileotp-error').html('');
    $('.eotpsvbtn').hide();
    $('.eotppcbtn').show();    
    let otp = O1+O2+O3+O4;
    e.preventDefault();
    if(isNaN(parseInt(O1))==true){
        $('input[name=expertmobileotp1]').focus();
        $('.eotpsvbtn').show();
        $('.eotppcbtn').hide();
    }
    else if(isNaN(parseInt(O2))==true){
        $('input[name=expertmobileotp2]').focus();
        $('.eotpsvbtn').show();
        $('.eotppcbtn').hide();
    }
    else if(isNaN(parseInt(O3))==true){
        $('input[name=expertmobileotp3]').focus();
        $('.eotpsvbtn').show();
        $('.eotppcbtn').hide();
    }
    else if(isNaN(parseInt(O4))==true){
        $('input[name=expertmobileotp4]').focus();
        $('.eotpsvbtn').show();
        $('.eotppcbtn').hide();
    }
    else{
        let form = new FormData(this);
        form.append('otp', otp);
        form.append('email', $('input[name=e_email_mobile]').val());
        $.ajax({
            data:form,
            url:ExpertLoginCheckOtp,
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                window.location.href=data.redirect;
            },
            error:function(response){            
                if(response.responseJSON.errors.otp!== undefined){
                    $('.expert-mobileotp-error').text(response.responseJSON.errors.otp);
                }  
                if(response.responseJSON.errors.email!== undefined){
                    $('.e-email-error').text(response.responseJSON.errors.email);
                } 
                $('input[name=expertmobileotp1]').val('');
                $('input[name=expertmobileotp2]').val('');
                $('input[name=expertmobileotp3]').val('');
                $('input[name=expertmobileotp4]').val('');
                $('.eotpsvbtn').show();
                $('.eotppcbtn').hide();
            }
        });
    }
});
function expertlogin(){
    $('.error').html('');
    $('.esbtn').hide();
    $('.evpbtn').show();
    let email = $('input[name=e_email_mobile]').val();
    clearAllInterval();
    $.ajax({
        data:{_token:$('meta[name=csrf-token]').attr('content'),email:email},
        url:ExpertLoginUrl,
        method:'POST',
        dataType:'Json',
        success:function(data){
            let first2 = String(email).slice(0, 2);
            let last3 = String(email).slice(-3);
            toastr.success(data.success);
            $('.ExpertLogin .OTPbox').show();
            $('.expertsendfor').html('Sent to <strong>'+first2+'*******'+last3+'</strong>');
            var seconds = 30;
            var cancel = setInterval(incrementSeconds, 1000); 
            var el = document.getElementById('expert-seconds-counter');
            function incrementSeconds() {
                seconds = Number(seconds) - 1;
                el.innerText = seconds + "s";
                if(seconds==0){ clearInterval(cancel); $('#expert-seconds-counter').html('30s'); $('.expertresendcounter').hide(); $('.expertresendemail').show(); }
            }
            $('.esbtn').show();
            $('.evpbtn').hide();
            if(data.otpfor==1){
                $('.expertotppreview').html('Your Otp Is: '+data.otp);
            }            
        },
        error:function(response){            
            if(response.responseJSON.errors.email!== undefined){
                $('.e-email-error').text(response.responseJSON.errors.email);
            }  
            $('.ExpertLogin .OTPbox').hide();
            clearAllInterval();
            $('.esbtn').show();
            $('.evpbtn').hide();
        }
    });
}

//// Other
$('.newsletterform').on('submit',function(e){
    $('.ncsbtn').hide();
    $('.nspbtn').show();
    e.preventDefault();
    $.ajax({
        data:new FormData(this),
        url:newsletterform,
        method:'POST',
        dataType:'Json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
            $('.newsletterform').trigger('reset');
            toastr.success(data.message);
            $('.ncsbtn').show();
            $('.nspbtn').hide();
        },
        error:function(response){            
            if(response.responseJSON.errors.subscribe_email!== undefined){
                toastr.error(response.responseJSON.errors.subscribe_email);
            } 
            $('.ncsbtn').show();
            $('.nspbtn').hide();
        }
    });
});
$('.jobapply').on('submit',function(e){
    $('.error').html('');
    $('.jsvbtn').hide();
    $('.jpbtn').show();
    e.preventDefault();
    $.ajax({
        data:new FormData(this),
        url:RequestJobUrl,
        method:'POST',
        dataType:'Json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
            $('.jsvbtn').show();
            $('.jpbtn').hide(); 
            $('.jobapply').trigger('reset');     
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success(data.success);  
            $('#ApplyPopup').modal('hide');   
        },
        error:function(response){
            if(response.responseJSON.errors.name!== undefined){
                $('.name-error').text(response.responseJSON.errors.name);
            }
            if(response.responseJSON.errors.email!== undefined){
                $('.email-error').text(response.responseJSON.errors.email);
            }
            if(response.responseJSON.errors.phone!== undefined){
                $('.phone-error').text(response.responseJSON.errors.phone);
            }
            if(response.responseJSON.errors.experience!== undefined){
                $('.experience-error').text(response.responseJSON.errors.experience);
            }
            if(response.responseJSON.errors.message!== undefined){
                $('.message-error').text(response.responseJSON.errors.message);
            } 
            if(response.responseJSON.errors.resume!== undefined){
                $('.resume-error').text(response.responseJSON.errors.resume);
            }
            $('.jsvbtn').show();
            $('.jpbtn').hide();
        }
    });
});
