<div class="SendInquiryPopup" style="display:none">
    <div class="accordion-header accordion-button" id="headingOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Subject <button type="button" class="btn-close" aria-label="Close"></button></div>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
        <form class="MsgMain" id="sendenq">
            <div class="MsgHead">
                <textarea name="message" style="display:none;"></textarea>
                <div class="ToBox">
                    <div><span class="text-secondary me-2">To</span><input type="text" class="form-control" autocomplete="off" id="to" name="to_recipient_email" placeholder=""></div>
                    <div id="cc" style="display:none"><span class="text-secondary me-2">Cc</span><input type="text" class="form-control" autocomplete="off" name="cc_email" placeholder=""></div>
                    <a href="#cc" class="text-secondary ccbox">Cc</a>
                    <div id="bcc" style="display:none"><span class="text-secondary me-2">Bcc</span><input type="text" class="form-control" autocomplete="off" name="bcc_email" placeholder=""></div>
                    <a href="#bcc" class="text-secondary bccbox">Bcc</a>
                </div>
                <input type="text" class="form-control" autocomplete="off" id="subject" name="subject" placeholder="Subject">
            </div>
            <div class="MsgBox">
                <div id="fake_textarea" class="MsgBoxType" contenteditable="true"></div>
                <div class="Attach"></div>
            </div>
            <div class="MsgFoot">
                <button type="submit" class="btn btn-thm3 mt-0 svbtn"><i class="fal fa-paper-plane m-0 me-1"></i> Send</button>
                <button type="button" style="display:none;" disabled class="btn btn-thm3 mt-0 prcbtn"><i class="fal fa-spinner m-0 me-1"></i> Processing...</button>
                <label class="sws-top sws-bounce mailfont" data-title="Formatting option"><i class="fal fa-font"></i></label>
                <div class="formatting">
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Bold" onclick="f1()"><i class="fas fa-bold"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Italic Text" onclick="f2()"><i class="far fa-italic"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Underline" onclick="f10()"><i class="far fa-underline"></i></a>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="text-size" data-bs-toggle="dropdown" aria-expanded="false" class="sws-top sws-bounce" data-title="Text Size"><i class="far fa-text-size"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="text-size">
                            <li><a href="javascript:void(0)" onclick="f11()">Small</a></li>
                            <li><a href="javascript:void(0)" onclick="f12()" class="h6">Normal</a></li>
                            <li><a href="javascript:void(0)" onclick="f13()" class="h4">Large</a></li>
                            <li><a href="javascript:void(0)" onclick="f14()" class="h2">Huge</a></li>
                        </ul>
                    </div>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Left Align" onclick="f3()"><i class="far fa-align-left"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Center Align" onclick="f4()"><i class="far fa-align-center"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Right Text" onclick="f5()"><i class="far fa-align-right"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Uppercase Text" onclick="f6()"><i class="far fa-font"></i><i class="far fa-font"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Lowercase Text" onclick="f7()">a</a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Capitalize Text" onclick="f8()"><i class="far fa-font-case"></i></a>
                    <a href="javascript:void(0)" class="sws-top sws-bounce" data-title="Clear Text" onclick="f9()"><i class="far fa-file"></i></a>
                </div>
                <label class="sws-top sws-bounce attfileb" data-title="Attach files" ><i class="fal fa-paperclip me-1"></i><input type="file" id="attachment"  name="attachment[]" class="d-none"></label>
                <label class="sws-top sws-bounce discarddraft" data-title="Discard draft"><i class="fal fa-trash-alt me-1"></i></label>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$('body').on('click','.SendMessage',function(){
    $('.SendInquiryPopup').fadeIn();
    $('.SendInquiryPopup .accordion-collapse').addClass('show');
    $('.SendInquiryPopup .accordion-header').removeClass('collapsed');
});
$('body').on('click','.SendInquiryPopup .accordion-header .btn-close',function(){
    $('.SendInquiryPopup').hide();
    $('.SendInquiryPopup .accordion-header').removeClass('collapsed');
});

$('body').on('click','.mailfont',function(){
    if ($('.formatting').hasClass('active')){
        $('.formatting').removeClass('active');
        $(this).removeClass('active');
    } else {
        $('.formatting').addClass('active');
        $(this).addClass('active');
    }
});
$('body').on('click','.ccbox',function(){
    $('.ccbox').hide();
    $('#cc').show();
});
$('body').on('click','.ccbox',function(){
    $('.ccbox').hide();
    $('#cc').show();
});
$('body').on('click','.bccbox',function(){
    $('.bccbox').hide();
    $('#bcc').show();
});
$('body').on('click','#subject',function(){
    if($('#cc').val()==''){
        $('.ccbox').show();
        $('#cc').hide();
    }
    if($('#bcc').val()==''){
        $('.bccbox').show();
        $('#bcc').hide();
     }
});
$('body').on('click','.discarddraft',function(){
    $('.SendInquiryPopup').hide();
    $('#sendenq').trigger("reset");
    $('#fake_textarea').html('');
    $('.ccbox').show();
    $('#cc').hide();  
    $('.bccbox').show();
    $('#bcc').hide();          
});
$("body").on("click",".removeattach",function(){ 
    $(this).parents(".attachbox").remove();
});
</script>