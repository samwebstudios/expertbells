<form class="updateinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">What to expect</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" style="overflow-y: auto; max-height: 430px;">
        <small class="error description-error"></small>
        <div class="d-flex InBox mb-2">
            <div>
                <input type="text" class="form-control" required name="description[]" placeholder="Write something here...">       
            </div>
            <button type="button" class="btn btn-dark btn-md add"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-dark otsbtn">Confirm & Proceed</button>
        <button type="button" style="display: none;" class="btn btn-dark otpbtn disabled"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>
<script>
    $(".chosen-select").chosen();
    $('.add').on('click',function(){
        let box =  $('.InBox').first().clone();
        $(box).find(".add").html('<i class="fas fa-trash"></i>');
        $(box).find(".add").addClass(['remove','btn-danger']);        
        $(box).find(".remove").removeClass(['add','btn-dark']);
        $('.InBox').last().after(box);
        $('.remove').on('click',function(){
            $(this).parent('.InBox').remove();
        });
    });
    
    $('.updateinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('expert.savewhatexpect')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                toastr.success(data.success);
                $('.updateinformation').trigger('reset');
                $('.otsbtn').show();
                $('.otpbtn').hide();
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            },
            error:function(response){            
                if(response.responseJSON.errors.description!== undefined){
                    $('.description-error').text(response.responseJSON.errors.description);
                }  
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
</script>