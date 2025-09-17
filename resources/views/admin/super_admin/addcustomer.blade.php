@extends('admin.template')
@section('content')
<style>
    .disabled{
        pointer-events: none;
        opacity: .5;
    }
</style>

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i> Add Customer</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12 col-lg-12  c ml-auto mr-auto">
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
                            <form role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("users/save-customer")}}">
                                @csrf
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{old('name', $user->name ?? "")}}" required >
                                            <input type="hidden" class="form-control" name="user_type"  value="customer" required >
                                            <input type="hidden" class="form-control" name="id"  value="{{ $user->id ?? 0  }}" required >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number<small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="phoneNumber" placeholder="Enter your Phone number..." value="{{old('phoneNumber', $user->phoneNumber ?? "")}}"  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CNIC<small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="cnic" placeholder="Enter your CNIC number..." value="{{old('cnic', isset($_GET['cnic']) ? $_GET['cnic'] : "" )}}"  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address<small class="text-normal"></small></label>
                                            <input type="text" class="form-control" name="address" placeholder="Enter your address..." value="{{old('address', $user->address ?? "")}}"  >
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email<small class="text-normal"></small></label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email..." value="{{old('email', $user->email ?? "")}}" required >
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
    </div>
    <!-- Content Wrapper END -->

    <script type="text/javascript">

        $(document).ready(function(e){
            id =0;
            office_id = "{{$user->office_id ?? 0}}";
            organization_id = "{{$user->org_id ?? 0}}";
            user_type = "{{$user->user_type ?? ""}}";

            if(office_id != 0){
                getOrganization(office_id);
            }
            if(user_type == "super_admin"){
                $("#select_organization").addClass("disabled")
            }
            /* $('#event_start_time').Zebra_DatePicker({
                 format: 'Y-m-d H:i'
             });*/
            $("body").on("change","#select_office",function(e){
                var office_id = $(this).val();
                getOrganization(office_id);

            });

            $("body").on("change","#user_type",function(e){
                var user_type = $(this).val();
                if(user_type == "super_admin"){
                    $("#select_organization").val("0");
                    $("#select_organization").addClass("disabled");
                }else{
                    $("#select_organization").removeClass('disabled');
                }

            });




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


        });
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

        function getOrganization(office_id) {
            $.ajax({
                method:"POST",
                data:{office_id:office_id},
                url:'<?php echo url("/get-organization") ?>',
                success:function(res){
                    if(res.status){
                        $("#select_organization").html("");
                        var html = `<option value='0'>Select office...</option>`;
                        res.data.forEach(function(value,key){
                            html = html + `<option value="${value.id}" ${organization_id == value.id ? "selected" : ""} >${value.org_name}</option>`;
                        });
                        $("#select_organization").html(html);
                    }else{
                        $.notify(res.message, 'error');
                    }

                }
            });
        }
    </script>
@endsection


