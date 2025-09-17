@extends('admin.template2')
@section('content')
    <!-- Content Header -->
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 text-dark">
                    <i class="fas fa-user-circle me-2 text-primary"></i>
                    User Details
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('users-verification')}}" class="text-decoration-none">User Verification</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User Details
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{url('users-verification')}}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Back to List
                </a>
                <small class="text-muted align-self-center">
                    <i class="fas fa-calendar me-1"></i>{{date('d M, Y')}}
                </small>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- User Information Card -->
                <div class="card simple-card mb-4">
                    <div class="card-header border-0 pb-0">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2 text-info"></i>
                            Basic Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="info-item">
                                    <label class="info-label">
                                        <i class="fas fa-user me-2 text-muted"></i>Full Name
                                    </label>
                                    <div class="info-value">{{$user->name ?? "N/A"}}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="info-item">
                                    <label class="info-label">
                                        <i class="fas fa-phone me-2 text-muted"></i>Mobile Number
                                    </label>
                                    <div class="info-value">{{$user->phoneNumber ?? "N/A"}}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="info-item">
                                    <label class="info-label">
                                        <i class="fas fa-id-card me-2 text-muted"></i>CNIC
                                    </label>
                                    <div class="info-value">{{$user->cnic ?? "N/A"}}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="info-item">
                                    <label class="info-label">
                                        <i class="fas fa-envelope me-2 text-muted"></i>Email Address
                                    </label>
                                    <div class="info-value">{{$user->email ?? "N/A"}}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-item">
                                    <label class="info-label">
                                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>Address
                                    </label>
                                    <div class="info-value">{{$user->address ?? "N/A"}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






                </div>

                <!-- Documents Section -->
                <div class="card simple-card">
                    <div class="card-header border-0 pb-0">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-file-alt me-2 text-success"></i>
                            Uploaded Documents
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- User Image -->
                            <div class="col-md-6">
                                <div class="document-card border rounded p-3 text-center">
                                    <i class="fas fa-user-circle fa-3x text-primary mb-2"></i>
                                    <h6 class="mb-2">Profile Image</h6>
                                    @if($user->image)
                                        <a href="{{asset($user->image)}}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           target="_blank">
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                        <a href="{{asset($user->image)}}" 
                                           class="btn btn-outline-info btn-sm ms-1" 
                                           target="_blank">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    @else
                                        <span class="text-muted">Not uploaded</span>
                                    @endif
                                </div>
                            </div>

                            <!-- CNIC Image -->
                            <div class="col-md-6">
                                <div class="document-card border rounded p-3 text-center">
                                    <i class="fas fa-id-card fa-3x text-warning mb-2"></i>
                                    <h6 class="mb-2">CNIC Document</h6>
                                    @if($user->cnic_image)
                                        <a href="{{asset($user->cnic_image)}}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           target="_blank">
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                        <a href="{{asset($user->cnic_image)}}" 
                                           class="btn btn-outline-info btn-sm ms-1" 
                                           target="_blank">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    @else
                                        <span class="text-muted">Not uploaded</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Affidavit -->
                            <div class="col-md-6">
                                <div class="document-card border rounded p-3 text-center">
                                    <i class="fas fa-file-contract fa-3x text-info mb-2"></i>
                                    <h6 class="mb-2">Affidavit</h6>
                                    @if($user->affidavit)
                                        <a href="{{asset($user->affidavit)}}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           target="_blank">
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                        <a href="{{asset($user->affidavit)}}" 
                                           class="btn btn-outline-info btn-sm ms-1" 
                                           target="_blank">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    @else
                                        <span class="text-muted">Not uploaded</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Deposit Slip -->
                            <div class="col-md-6">
                                <div class="document-card border rounded p-3 text-center">
                                    <i class="fas fa-receipt fa-3x text-success mb-2"></i>
                                    <h6 class="mb-2">Deposit Slip</h6>
                                    @if($user->deposit_slip)
                                        <a href="{{asset($user->deposit_slip)}}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           target="_blank">
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                        <a href="{{asset($user->deposit_slip)}}" 
                                           class="btn btn-outline-info btn-sm ms-1" 
                                           target="_blank">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    @else
                                        <span class="text-muted">Not uploaded</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                </div>






            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- Modal -->
    <div id="delete_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert_message box_message">
                    Are you sure to delete this organization ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success save_btn delete_yes" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-danger btn_cancel">No</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(e){
            $("body").on("click",".delete_record",function(e){
                status = $(this).attr("status");
                user_id = $(this).attr("id");
                $(".box_message").text("Are you sure to Activate/Deactivate this user ?");
                $("#delete_modal").modal("show");
            });

            $("body").on("click",".btn_cancel",function(e){
                $("#delete_modal").modal("hide");
            });


            $("body").on("click",".delete_yes",function(e){
                $.ajax({
                    method:"POST",
                    data:{id:user_id,status:status},
                    url:'<?php echo url("users/delete-superadmin"); ?>',
                    success:function(res){
                        if(res.status){
                            window.location.reload();
                        }else{
                            $.notify(res.message, 'error');
                        }

                    }
                });

            });
        });
    </script>


@endsection






