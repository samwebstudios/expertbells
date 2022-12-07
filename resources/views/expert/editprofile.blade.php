<form class="updateinformation">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Profile Name</small>
                <input type="text" class="form-control" value="{{expertinfo()->name}}" name="profile_name" placeholder="Change Profile Name">         
                <small class="error name-error"></small>
            </div>
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Register Email</small>
                <input type="text" class="form-control" value="{{expertinfo()->email}}" name="email" placeholder="Change Register Email">         
                <small class="error email-error"></small>
            </div>
            <div class="col-12">            
                <small for="exampleFormControlInput1" class="form-label">Register Mobile</small>
                <input type="text" class="form-control" value="{{expertinfo()->mobile}}" name="mobile" placeholder="Change Register Mobile">         
                <small class="error mobile-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Gender</small>
                <select class="form-control chosen-select" name="gender">
                    <option value="0" @selected(expertinfo()->gender==0)>Other</option>
                    <option value="1" @selected(expertinfo()->gender==1)>Male</option>
                    <option value="2" @selected(expertinfo()->gender==2)>Female</option>                    
                </select>            
                <small class="error gender-error"></small>
            </div>
            <div class="col-6">            
                <small for="exampleFormControlInput1" class="form-label">Country</small>
                <select class="form-control chosen-select" name="country" onchange="State(this.value)">
                    <option value="">Choose Country</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id ?? ''}}" @selected(expertinfo()->country==$country->id) >{{$country->name ?? '-----'}}</option>
                    @endforeach
                </select>            
                <small class="error country-error"></small>
            </div>
            <div class="col-6 statebox">            
                <small for="exampleFormControlInput1" class="form-label">State</small>
                <select class="form-control chosen-select" name="state">
                    <option value="">Choose State</option>
                </select>            
                <small class="error state-error"></small>
            </div>
            <div class="col-6 citybox">            
                <small for="exampleFormControlInput1" class="form-label">City</small>
                <select class="form-control chosen-select" name="city">
                    <option value="">Choose City</option>
                </select>            
                <small class="error city-error"></small>
            </div>
            <div class="col-7">            
                <small for="exampleFormControlInput1" class="form-label">Profile Image</small>
                <input type="file" class="form-control" onchange="loadFile(event)" name="profile">
                <small>Best Image Size: 476px * 483px</small>         
                <small class="error image-error"></small>
            </div>
            <div class="col-4">
                <div class="PhotoBox imgbox me-4">
                    <label>
                        <x-image-box>
                            <x-slot:image>{{expertinfo()->profile}}</x-slot:image>
                            <x-slot:path>/uploads/expert/</x-slot:path>
                            <x-slot:alt>{{expertinfo()->name ?? ''}}</x-slot:alt>
                            <x-slot:class>mt-2</x-slot:class>
                            <x-slot:id>blah</x-slot:id>
                        </x-image-box>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-dark otsbtn">Confirm & Proceed</button>
        <button type="button" style="display: none;" class="btn btn-dark otpbtn disabled"><i class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>

<!-- summernote css/js -->

<style>
    .imgbox img{
        border: 1px solid #ddd;
        padding: 5px;
        width: 100px!important;
    }
</style>
<script>
    $(document).ready(function(){
        if(@json(expertinfo()->country > 0)){ State(@json(expertinfo()->country)); }
        
    });
    $(".chosen-select").chosen();
    $('.updateinformation').on('submit',function(e){
        e.preventDefault();
        $('.otsbtn').hide();
        $('.otpbtn').show();
        $('.error').html('');
        $.ajax({
            data:new FormData(this),
            url:@json(route('expert.updateprofile')),
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
                if(response.responseJSON.errors.name!== undefined){
                    $('.name-error').text(response.responseJSON.errors.name);
                } 
                if(response.responseJSON.errors.email!== undefined){
                    $('.email-error').text(response.responseJSON.errors.email);
                } 
                if(response.responseJSON.errors.mobile!== undefined){
                    $('.mobile-error').text(response.responseJSON.errors.mobile);
                } 
                if(response.responseJSON.errors.gender!== undefined){
                    $('.gender-error').text(response.responseJSON.errors.gender);
                } 
                if(response.responseJSON.errors.country!== undefined){
                    $('.country-error').text(response.responseJSON.errors.country);
                }
                if(response.responseJSON.errors.state!== undefined){
                    $('.state-error').text(response.responseJSON.errors.state);
                }
                if(response.responseJSON.errors.city!== undefined){
                    $('.city-error').text(response.responseJSON.errors.city);
                }  
                $('.otsbtn').show();
                $('.otpbtn').hide(); 
            }
        });
    });
    var loadFile = function(event) {
        $('#blah').attr('src',URL.createObjectURL(event.target.files[0]));
    };
    function State(value){
        $.ajax({
            data:{_token:$('meta[name=csrf-token]').attr('content'),country:value},
            url:@json(route('expert.countrystates')),
            method:'POST',
            dataType:'Json',
            success:function(data){
                let Html = '';
                Html +='<small for="exampleFormControlInput1" class="form-label">State</small>';
                Html +='<select class="form-control chosen-select"  onchange="City(this.value)"  name="state">';
                    Html += data.data;
                Html +='</select>';          
                Html +='<small class="error state-error"></small>';
                $('.statebox').html(Html);
                $(".chosen-select").chosen();
                if(@json(expertinfo()->state > 0)){ City(@json(expertinfo()->state)); }
            }
        });
    }
    function City(value){
        $.ajax({
            data:{_token:$('meta[name=csrf-token]').attr('content'),state:value},
            url:@json(route('expert.statecities')),
            method:'POST',
            dataType:'Json',
            success:function(data){
                let Html = '';
                Html +='<small for="exampleFormControlInput2" class="form-label">City</small>';
                Html +='<select class="form-control chosen-select" name="city">';
                    Html += data.data;
                Html +='</select>';          
                Html +='<small class="error state-error"></small>';
                $('.citybox').html(Html);
                $(".chosen-select").chosen();
            }
        });
    }
</script>