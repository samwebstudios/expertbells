<form class="updateuserinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Other Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Role</small>
                <select class="form-control chosen-select" name="role">
                    @foreach($roles as $role)
                    <option value="{{$role->id ?? 0}}" @selected(userinfo()->role==$role->id) >{{$role->title ?? ''}}</option>
                    @endforeach
                </select>            
                <small class="error role-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Industries</small>
                <select class="form-control chosen-select" name="industry">
                    @foreach($industries as $industrie)
                    <option value="{{$industrie->id ?? 0}}" @selected(userinfo()->industry==$industrie->id) >{{$industrie->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error industry-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">What do you want to get better at?</small>
                <select class="form-control chosen-select" multiple name="get_better[]">
                    @foreach($betters as $better)
                    <option value="{{$better->id ?? 0}}" @selected(in_array($better->id,json_decode(userinfo()->get_better)))>{{$better->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error better-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">How did you hear about us?</small>
                <select class="form-control chosen-select" multiple name="hear_about[]">
                    <option value="0">Choose One</option>
                    @foreach($hears as $hear)
                    <option value="{{$hear->id ?? 0}}" @selected(in_array($hear->id,json_decode(userinfo()->hear_about_us))) >{{$hear->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error hear-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlTextarea1" class="form-label">Growth Challenge</small>
                <textarea class="form-control summernote" name="challenge" id="exampleFormControlTextarea1" rows="3">{{userinfo()->growth_challenge ?? ''}}</textarea>
                <small class="error challenge-error"></small>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-dark otsbtn">Update & Proceed</button>
        <button type="button" style="display: none;" class="btn btn-dark otpbtn disabled"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>

<script>
    $('.summernote').summernote({
        height: 100,
        toolbar: []
    });
    $(".chosen-select").chosen();
    $('.updateuserinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('user.updateotherinformation')),
            method:'POST',
            dataType:'Json',
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                toastr.success(data.success);
                $('.otsbtn').show();
                $('.otpbtn').hide();
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            },
            error:function(response){            
                if(response.responseJSON.errors.role!== undefined){
                    $('.role-error').text(response.responseJSON.errors.role);
                }  
                if(response.responseJSON.errors.industry!== undefined){
                    $('.industry-error').text(response.responseJSON.errors.industry);
                }
                if(response.responseJSON.errors.get_better!== undefined){
                    $('.better-error').text(response.responseJSON.errors.get_better);
                }
                if(response.responseJSON.errors.hear_about!== undefined){
                    $('.hear-error').text(response.responseJSON.errors.hear_about);
                }
                if(response.responseJSON.errors.challenge!== undefined){
                    $('.challenge-error').text(response.responseJSON.errors.challenge);
                }
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
</script>