@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-dark">
                    <i class="fas fa-user-plus me-2 text-primary"></i>
                    {{ isset($user) ? 'Edit User' : 'Add New User' }}
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('users/manage-superadmin') }}" class="text-decoration-none">
                                Manage Users
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ isset($user) ? 'Edit User' : 'Add New User' }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('users/manage-superadmin') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Back to List
                </a>
                <small class="text-muted align-self-center">
                    <i class="fas fa-calendar me-1"></i>{{ date('d M, Y') }}
                </small>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form role="form" method="POST" id="form-validation" enctype="multipart/form-data" action="{{url("users/save-superadmin")}}">
                    @csrf
                    <div class="card simple-card">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-cog me-2"></i>User Information
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <!-- Row 1: Role and User Image -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-user-tag text-primary me-1"></i>Role *
                                    </label>
                                    <select class="form-select" id="user_type" required name="user_type">
                                        <option value="">Select Role...</option>
                                        <option value="super_admin" {{ isset($user) && $user->user_type == "super_admin" ? "selected" : ""}}>Super Admin</option>
                                        <option value="admin_user" {{isset($user) && $user->user_type == "admin_user" ? "selected" : ""}}>Organization User</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-camera text-primary me-1"></i>User Image
                                    </label>
                                    <input type="file" onchange="readURL(this);" class="form-control" accept="image/*" name="image">
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img id="blah" src="#" alt="Preview" class="img-thumbnail" style="max-width: 100px; height: 80px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <!-- Row 2: Office and Organization -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-building text-primary me-1"></i>Office *
                                    </label>
                                    <select class="form-select" required id="select_office" name="office_id">
                                        <option value="">Select office...</option>
                                        @foreach($offices as $key => $value)
                                            <option value="{{$value->id}}" {{(isset($user) && $user->office_id && $user->office_id == $value->id) ? "selected" : "" }} >{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6" id="case_status">
                                    <label class="form-label">
                                        <i class="fas fa-sitemap text-primary me-1"></i>Organization *
                                    </label>
                                    <select class="form-select" required id="select_organization" name="org_id">
                                        <option value="">Select organization...</option>
                                    </select>
                                </div>
                            </div>



                            <!-- Row 3: Name and Phone Number -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-user text-primary me-1"></i>Full Name *
                                    </label>
                                    <input type="text" class="form-control" required name="name" placeholder="Enter Full Name" value="{{old('name', isset($user) ? $user->name : "")}}" required>
                                    <input type="hidden" name="id" value="{{ isset($user) ? $user->id : 0 }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-phone text-primary me-1"></i>Phone Number *
                                    </label>
                                    <input type="tel" class="form-control" required name="phoneNumber" placeholder="Enter Phone Number" value="{{old('phoneNumber', isset($user) ? $user->phoneNumber : "")}}" required>
                                </div>
                            </div>


                            <!-- Row 4: Email -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">
                                        <i class="fas fa-envelope text-primary me-1"></i>Email Address *
                                    </label>
                                    <input type="email" class="form-control" required name="email" placeholder="Enter Email Address" value="{{old('email', isset($user) ? $user->email : "")}}" required>
                                </div>
                            </div>

                            <!-- Row 5: Password and Confirm Password -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-lock text-primary me-1"></i>Password {{ !isset($user) ? '*' : '' }}
                                    </label>
                                    <input type="password" class="form-control" name="password" placeholder="{{ isset($user) ? 'Leave blank to keep current password' : 'Enter Password' }}" {{ !isset($user) ? 'required' : '' }}>
                                    @if(!isset($user))
                                        <div class="form-text">
                                            <small class="text-muted">Minimum 8 characters required</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-lock text-primary me-1"></i>Confirm Password {{ !isset($user) ? '*' : '' }}
                                    </label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="{{ isset($user) ? 'Confirm new password' : 'Confirm Password' }}" {{ !isset($user) ? 'required' : '' }}>
                                </div>
                            </div>



                            <hr class="my-4">

                            <!-- Form Actions -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="fas fa-save me-1"></i>
                                            {{ isset($user) ? 'Update User' : 'Create User' }}
                                        </button>
                                        <a href="{{ url('users/manage-superadmin') }}" class="btn btn-outline-secondary px-4">
                                            <i class="fas fa-times me-1"></i>Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Custom Styles -->
    <style>
        .form-label {
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .simple-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
        
        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
        }
        
        .disabled {
            opacity: 0.6;
            pointer-events: none;
        }
        
        .img-thumbnail {
            border: 2px solid #dee2e6;
        }
    </style>

    <link rel="stylesheet" href="{{asset('plaza_admin_assets/css/bootstrap-datetimepicker.css')}}">
    <script src="{{asset('plaza_admin_assets/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('plaza_admin_assets/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function(e){
            id = 0;
            office_id = "{{ isset($user) ? $user->office_id : 0 }}";
            organization_id = "{{ isset($user) ? $user->org_id : 0 }}";
            user_type = "{{ isset($user) ? $user->user_type : '' }}";

            if(office_id != 0){
                getOrganization(office_id);
            }
            if(user_type == "super_admin"){
                $("#select_organization").addClass("disabled").prop('disabled', true);
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
                    $("#select_organization").addClass("disabled").prop('disabled', true);
                }else{
                    $("#select_organization").removeClass('disabled').prop('disabled', false);
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
                    $('#blah').attr('src', e.target.result);
                    $('#imagePreview').show();
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
                        var html = `<option value='0'>Select organization...</option>`;
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




