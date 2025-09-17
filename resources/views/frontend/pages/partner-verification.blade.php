@extends('frontend.master')
@section('content')
    <!-- Inner -->
    <section class="inner bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="inner_block register-form">
                        <h3 class="pb-4 CircularStd-Black">Partner Verification</h3>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="text-uppercase">Verification Code</label>
                                    <input type="number" id="otp" name="otp" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <div  class="btn btn-support btn-lg mt-4 px-4 CircularStd-Black verify_code" id="SaveForm">Verify <i class="las la-arrow-right"></i></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Inner -->
    <script type="text/javascript">
        $(document).ready(function(e){
            customer_id = 0;



            $("body").on("click",".verify_code",function(e){
                var otp = $("#otp").val();
                if(otp == "" || otp.length < 6){
                    $.notify("Please enter 6 digit otp.","error");
                    return false;
                }
                $.ajax({
                    method:"POST",
                    url:'<?php echo url("verifyCode") ?>',
                    data:{
                        user_type:"employer",
                        otp:otp,
                        id:"{{$id}}"
                    },
                    success:function(res){
                        if(res.status == true){
                            $.notify(res.message, 'success');
                            setTimeout(function(){
                                window.location = BaseUrl+"/login";
                            },3000)
                        }else if(res.status == "invalid"){
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
    </script>
@endsection




