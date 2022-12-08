<form class="updateinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Other Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Qualification</small>
                <select class="form-control chosen-select" name="qualification">
                    @foreach($qualifications as $qualification)
                    <option value="{{$qualification->id ?? 0}}" @selected(expertinfo()->highest_qualification==$qualification->id) >{{$qualification->title ?? ''}}</option>
                    @endforeach
                </select>            
                <small class="error qualification-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Currently Working</small>
                <select class="form-control chosen-select" name="currently_working">
                    @foreach($workings as $working)
                    <option value="{{$working->id ?? 0}}" @selected(expertinfo()->currently_working_as==$working->id) >{{$working->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error working-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Area of Expertise</small>
                <select class="form-control chosen-select" name="expertises">
                    @foreach($expertise as $expertis)
                    <option value="{{$expertis->id ?? 0}}" @selected(expertinfo()->your_expertise==$expertis->id) >{{$expertis->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error expertises-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Language</small>
                <select class="form-control chosen-select" multiple name="languages[]">
                    @foreach($languages as $language)
                    <option value="{{$language->id ?? 0}}" @selected(in_array($language->id,json_decode(expertinfo()->fluent_language)))>{{$language->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error languages-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlInput1" class="form-label">Industries</small>
                <select class="form-control chosen-select" multiple name="industries[]">
                    <option value="0">Choose Industries</option>
                    @foreach($industries as $industrie)
                    <option value="{{$industrie->id ?? 0}}" @selected(in_array($industrie->id,json_decode(expertinfo()->suitable_industry))) >{{$industrie->title ?? ''}}</option>
                    @endforeach
                </select>
                <small class="error industries-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlTextarea1" class="form-label">Bio</small>
                <textarea class="form-control summernote" name="bio" id="exampleFormControlTextarea1" rows="3">{{expertinfo()->bio ?? ''}}</textarea>
                <small class="error bio-error"></small>
            </div>
            <div class="col-12">
                <small for="exampleFormControlTextarea1" class="form-label">Strengths</small>
                <textarea class="form-control summernote2" name="strengths" id="exampleFormControlTextarea1" rows="3">{{expertinfo()->your_strength ?? ''}}</textarea>
                <small class="error strengths-error"></small>
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
    $('.summernote2').summernote({
        height: 100,
        toolbar: []
    });
    $(".chosen-select").chosen();
    $('.updateinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('expert.updateotherinformation')),
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
                if(response.responseJSON.errors.qualification!== undefined){
                    $('.qualification-error').text(response.responseJSON.errors.qualification);
                }  
                if(response.responseJSON.errors.currently_working!== undefined){
                    $('.working-error').text(response.responseJSON.errors.currently_working);
                }
                if(response.responseJSON.errors.strengths!== undefined){
                    $('.strengths-error').text(response.responseJSON.errors.strengths);
                }
                if(response.responseJSON.errors.expertises!== undefined){
                    $('.expertises-error').text(response.responseJSON.errors.expertises);
                }
                if(response.responseJSON.errors.languages!== undefined){
                    $('.languages-error').text(response.responseJSON.errors.languages);
                }
                if(response.responseJSON.errors.industries!== undefined){
                    $('.industries-error').text(response.responseJSON.errors.industries);
                }
                if(response.responseJSON.errors.bio!== undefined){
                    $('.bio-error').text(response.responseJSON.errors.bio);
                }
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
</script>