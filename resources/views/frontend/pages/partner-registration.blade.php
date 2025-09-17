
@extends('frontend.master')
@section('content')
    <!-- Inner -->
    <section class="inner bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="inner_block register-form">
                        <h3 class="pb-4 CircularStd-Black">Partner Registration</h3>
                        <form class="" id="myForm"  method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">first name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">last name</label>
                                        <input type="text" name="last_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase d-block">GENDER</label>
                                        <label class="checkbox-radio mr-5">Male<input type="radio" value="Male" name="gender">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="checkbox-radio">Female<input type="radio" value="Female" name="gender">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">PHONE NUMBER</label>
                                        <input type="text" name="phone_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">SOCIAL SECURITY NUMBER</label>
                                        <input type="text" name="social_sec_numb" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">DATE OF BIRTH</label>
                                        <input type="text" class="form-control datepicker" name="dob" id="dob" data-select="datepicker" data-date-format="mm/dd/yyyy">
                                        {{--<input type="text" name="dob" class="form-control datepicker"   data-date-format="mm/dd/yyyy">--}}
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">EMAIL ADDRESS</label><span id="email_validator" style="color: red;"> </span>
                                        <input type="text" id="email" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">ADDRESS</label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">Country</label>
                                        <button class="btn btn-light dropdown-toggle m-0 border-0 d-block" data-toggle="dropdown" id="country_text"></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @foreach($country as $key => $value)
                                                <a class="dropdown-item change_country" href="javascript:void(0)" id="{{$value->id}}">{{$value->name}}</a>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">State</label>
                                        <button class="btn btn-light dropdown-toggle m-0 border-0 d-block" data-toggle="dropdown" id="state_text"></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="list_state">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">city</label>
                                        <button class="btn btn-light dropdown-toggle m-0 border-0 d-block" data-toggle="dropdown" id="city_text"></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="list_city">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">zipcode</label>
                                        <input type="text" name="zip_code" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">CHOOSE INTERESTED TASK</label>
                                        <button class="btn btn-light dropdown-toggle m-0 border-0 d-block" data-toggle="dropdown" id="intrest_text"></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            @foreach($categories as $key => $value)
                                                <a class="dropdown-item change_interest" value="{{$value->catName}}" href="javascript:void(0)">{{$value->catName}}</a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group thumbnail-photos">
                                        <label class="text-uppercase d-block">upload driver’s license or international passport</label>
                                        <div class="yes post-btn">
                                                <span class="btn_upload btn-customer border-radius m-0 mb-4">
                                                <input type="file" name="license" id="imag" title="" class="input-img text-uppercase">
                                                    Upload
                                                </span>
                                            <img id="ImgPreview1" src="" class="preview1">
                                            <input type="button" id="removeImage1" value="x" class="btn-rmv1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group thumbnail-photos">
                                        <label class="text-uppercase">upload child abuse clearance</label>
                                        <div class="yes post-btn">
                                                <span class="btn_upload btn-customer border-radius m-0 mb-4">
                                                <input type="file" name="child_abuse" id="imag2" title="" class="input-img text-uppercase">
                                                    Upload
                                                </span>
                                            <img id="ImgPreview2" src="" class="preview2">
                                            <input type="button" id="removeImage2" value="x" class="btn-rmv2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group thumbnail-photos">
                                        <label class="text-uppercase d-block">upload social security carD</label>
                                        <div class="yes post-btn">
                                                <span class="btn_upload btn-customer border-radius m-0 mb-4">
                                                <input type="file" id="imag3" name="social_security_card" title="" class="input-img text-uppercase">
                                                    Upload
                                                </span>
                                            <img id="ImgPreview3" src="" class="preview3">
                                            <input type="button" id="removeImage3" value="x" class="btn-rmv3">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <div  class="btn btn-support btn-lg mt-4 px-4 CircularStd-Black" id="SaveForm">Proceed <i class="las la-arrow-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Inner -->


    <!-- Inner -->
    <section class="planningsec py-4 inner-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="inner_block text-center">
                        <h1 class="CircularStd-Black text-primary mb-0">List a task needs for your own offer  <button class="btn get-started text-white btn-lg ml-md-3">Get Started</button></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Inner -->


    <!-- Modal -->
    <div id="custom_message" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Account Verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert_message">
                    Please enter 6 digit verification code send to your email.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn_yes">Okay</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(e){
            customer_id = 0;
            $("body").on("click",".change_country",function(e){
                $.ajax({
                    method:"POST",
                    data:{country_id:$(this).attr('id')},
                    url:'<?php echo url("/getState") ?>',
                    success:function(res){
                        if(res.status){
                            let html = ``;
                            let data = res.data;
                            data.forEach(function(value,key){
                                html = html + `<a class="dropdown-item change_state" href="javascript:void(0)" id="${value.id}">${value.name}</a>`;
                                // html = html + `<option value="${value.id}" ${district_id == 0 ? "" : "selected" }>${value.name}</option>`;
                            });

                            $("#list_state").append("");
                            $("#list_state").append(html);
                        }else{

                        }

                    }
                });
            });

            $("body").on("click",".change_state",function(e){
                $.ajax({
                    method:"POST",
                    data:{state_id:$(this).attr('id')},
                    url:'<?php echo url("/getCity") ?>',
                    success:function(res){
                        if(res.status){
                            let html = ``;
                            let data = res.data;
                            data.forEach(function(value,key){
                                html = html + `<a class="dropdown-item change_city" href="javascript:void(0)" id="${value.id}">${value.name}</a>`;
                                // html = html + `<option value="${value.id}" ${district_id == 0 ? "" : "selected" }>${value.name}</option>`;
                            });

                            $("#list_city").append("");
                            $("#list_city").append(html);
                        }else{

                        }

                    }
                });
            });

            $("body").on("keyup","#email",function(e){
                let validate = validateEmail($(this).val());
                if(!validate){

                }else{
                    $("#email_validator").text("");
                }
            });

            $("body").on("click",".change_country",function(e){
                let text = $(this).text();
                $("#country_text").text(text);
                getState(text);
            });

            $("body").on("click",".btn_yes",function(e){
                $("#custom_message").modal("hide");
                window.location = BaseUrl+"/verifyPartner/"+customer_id;
            });

            $("body").on("click",".change_state",function(e){
                let text = $(this).text();
                $("#state_text").text(text);
                getCity(text);
            });
            $("body").on("click",".change_city",function(e){
                let text = $(this).text();
                $("#city_text").text(text);
            });

            $("body").on("click",".change_interest",function(e){
                $("#intrest_text").text($(this).text());
            });


            $("body").on("click","#SaveForm",function(e){
                var email = $("#email").val();
                if(email == "" || !validateEmail(email)){
                    $.notify("Email is not valid please enter valid email address.", 'error');
                    $("#email_validator").text(" (Email is not valid please enter valid email address.)");
                    return false;
                }
                $('#myForm').ajaxSubmit({
                    method:"POST",
                    url:'<?php echo url("create-partner") ?>',
                    data:{
                        country_id:$("#country_text").text(),
                        city_id:$("#city_text").text(),
                        state_id:$("#state_text").text(),
                        interested_task:$("#intrest_text").text()
                    },
                    success:function(res){
                        if(res.status == true){
                            $.notify(res.message, 'success');
                            customer_id = res.id;
                            $("#custom_message").modal("show");
                            /*setTimeout(function(){
                                window.location.reload();
                            },2000)*/
                        }else if(res.status == "exist"){
                            $.notify(res.message, 'error');
                        }else{
                            $.notify('Error occurred while saving.', 'error');
                        }

                    },
                    error: function(err) {
                        $.notify('Error occurred while saving.', 'error');
                    }
                });
            });


        });//----- end of ready function   -----//

        function validateEmail(email)
        {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function getState(name){

        }

        function getCity(name) {

        }


        function readURL(input, imgControlName) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(imgControlName).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imag").change(function() {
            // add your logic to decide which image control you'll use
            var imgControlName = "#ImgPreview1";
            readURL(this, imgControlName);
            $('.preview1').addClass('it');
            $('.btn-rmv1').addClass('rmv');
        });
        $("#imag2").change(function() {
            // add your logic to decide which image control you'll use
            var imgControlName = "#ImgPreview2";
            readURL(this, imgControlName);
            $('.preview2').addClass('it');
            $('.btn-rmv2').addClass('rmv');
        });
        $("#imag3").change(function() {
            // add your logic to decide which image control you'll use
            var imgControlName = "#ImgPreview3";
            readURL(this, imgControlName);
            $('.preview3').addClass('it');
            $('.btn-rmv3').addClass('rmv');
        });

        $("#removeImage1").click(function(e) {
            e.preventDefault();
            $("#imag1").val("");
            $("#ImgPreview1").attr("src", "");
            $('.preview1').removeClass('it');
            $('.btn-rmv1').removeClass('rmv');
        });
        $("#removeImage2").click(function(e) {
            e.preventDefault();
            $("#imag2").val("");
            $("#ImgPreview2").attr("src", "");
            $('.preview2').removeClass('it');
            $('.btn-rmv2').removeClass('rmv');
        });
        $("#removeImage3").click(function(e) {
            e.preventDefault();
            $("#imag3").val("");
            $("#ImgPreview3").attr("src", "");
            $('.preview3').removeClass('it');
            $('.btn-rmv3').removeClass('rmv');
        });
    </script>
@endsection