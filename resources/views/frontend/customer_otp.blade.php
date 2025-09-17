<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Book Your Seat | Registration</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="admins/assets/images/logo/favicon.png">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{asset('admins/assets/vendors/bootstrap/dist/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('admins/assets/vendors/PACE/themes/blue/pace-theme-minimal.css')}}" />
    <link rel="stylesheet" href="{{asset('admins/assets/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" />
    <!-- core css -->
    <link href="{{asset('admins/assets/css/ei-icon.css')}}" rel="stylesheet">
    <link href="{{asset('admins/assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('admins/assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('admins/assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('admins/assets/css/app.css')}}" rel="stylesheet">
    <style>
        p{
            margin-bottom: 5px !important;
        }
    </style>
</head>

<body>
<div class="app">
    <div class="authentication">
        <div class="sign-up">

            <div class="col-md-12 bg-white no-pdd-horizon" style="background-image: url('{{asset('admins/assets/images/others/img-30.jpg')}}')">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="full-height height-100">
                            <div class="vertical-align full-height pdd-horizon-70" style="background: white;">
                                <div class="table-cell">
                                    <div class="pdd-horizon-15">

                                        @if(session()->has('error_message'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('error_message') }}
                                            </div>
                                        @endif

                                        @if(session()->has('success_message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success_message') }}

                                            </div>
                                        @endif





                                        <form role="form" method="POST" id="otp_verification_form" enctype="multipart/form-data" action="{{url("organizationOtpVerification")}}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Enter OTP code recived on your Mobile<br> اپنے موبائل پر موصول ہونے والا او ٹی پی کوڈ درج کریں۔<small class="text-normal"></small></label>
                                                        <input type="hidden" class="form-control" name="id"  value="{{$user->id ?? 0}}" required >
                                                        <input type="text" class="form-control" name="verification_code"  placeholder="Enter 6 digit OTP code" value="" required >
                                                    </div>
                                                </div>

                                            </div>

                                            <button class="btn btn-primary">Submit</button>
                                            <a href="{{url("/")}}" class="btn btn-default">Cancel</a>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="{{asset('admins/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admins/assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('admins/assets/vendors/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{asset('admins/assets/vendors/PACE/pace.min.js')}}"></script>
<script src="{{asset('admins/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
<!-- endbuild -->
<!-- build:js assets/js/app.min.js -->
<!-- core js -->
<script src="{{asset('admins/assets/js/app.js')}}"></script>

<!-- page js -->

<script type="text/javascript">

    $(document).ready(function(e){
        id =0;
        district_id = "<?php echo $district_id ?? 0; ?>";
        tehsils_id = 0;
        citys_id = 0;






        $("body").on("click",".btn_save",function(e){
            var id = $("#record_id").val();
            $.ajax({
                method:"POST",
                data:{id:id,name:name,table:my_table},
                url:'<?php echo url("/save-settings") ?>',
                success:function(res){
                    if(res.status){
                        $.notify(res.message, 'success');
                        $("#custom_message").modal("hide");
                        table.ajax.reload( null, false );
                    }else{
                        $.notify(res.message, 'error');
                    }

                }
            });
        });

        if(tehsils_id != 0){
            selectDistrict();
            subCenter();
        }
    });

    function selectDistrict(){

        $.ajax({
            method:"POST",
            data:{district_id:district_id},
            url:'<?php echo url("/get-tehsil") ?>',
            success:function(res){
                if(res.status){
                    let html = `<option value="" disabled selected>Select Tehsil...</option>`;
                    let data = res.data;
                    data.forEach(function(value,key){
                        html = html + `<option value="${value.id}" ${(district_id != value.district_id) ? "" : "selected" } >${value.name}</option>`;
                    });
                    $("#tehsil_id").html("");
                    $("#tehsil_id").append(html);
                    getCity();

                }else{

                }

            }
        });
    }

    function getCity(){
        $.ajax({
            method:"POST",
            data:{tehsil_id:tehsils_id},
            url:'<?php echo url("/get-city") ?>',
            success:function(res){
                if(res.status){
                    let html = `<option value="" disabled selected>Select City...</option>`;
                    let data = res.data;
                    data.forEach(function(value,key){
                        html = html + `<option value="${value.id}" ${(tehsils_id != value.tehsil_id) ? "" : "selected" }>${value.name}</option>`;
                    });
                    $("#city_id").html("");
                    $("#city_id").append(html);
                }else{

                }

            }
        });
    }

    function subCenter(){
        $.ajax({
            method:"POST",
            data:{center_id:"{{$center_id ?? 0}}"},
            url:'<?php echo url("/get-subcenter") ?>',
            success:function(res){
                if(res.status){
                    let html = `<option value="" disabled  >Select Subcenter...</option>`;
                    let data = res.data;
                    data.forEach(function(value,key){
                        html = html + `<option value="${value.id}" ${value.id != subcenters_id ? "" : "selected" }>${value.name}</option>`;
                    });
                    $("#sub_center_id").html("");
                    $("#sub_center_id").append(html);
                }else{

                }

            }
        });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(50)
                    .height(50);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

</body>

</html>