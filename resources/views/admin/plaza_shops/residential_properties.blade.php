@extends('admin.template2')
@section('content')
    <style>
        .form-label, .table th, .table td { font-size: 10px !important; }
        .btn { font-size: 10px !important; }
        .card-title { font-size: 12px !important; }
    </style>
    
    <!-- Page Header -->
    <div class="container-fluid mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="text-dark mb-1">
                    <i class="fas fa-home me-2 text-primary"></i>Residential Properties
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sm">
                        <li class="breadcrumb-item">
                            <a href="https://properties-cdgp.com/" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Residential Properties</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-table me-2"></i>Residential Properties
                        </h6>
                        <div class="d-flex gap-2">
                            <button type="button" onclick="print_all()" class="btn btn-light btn-sm">
                                <i class="fas fa-print me-1"></i>Print All
                            </button>
                            <a href="{{url("residential")}}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus me-1"></i>Add New Property
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <style>
                            .table-container {
                                position: relative;
                            }
                            .table-container::before {
                                content: '';
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                background-image: url(https://properties-cdgp.com/newlogo.png);
                                background-repeat: no-repeat;
                                background-position: center;
                                background-size: 200px;
                                opacity: 0.05;
                                width: 200px;
                                height: 200px;
                                z-index: 1;
                                pointer-events: none;
                            }
                            #example1 {
                                position: relative;
                                z-index: 2;
                                background: transparent;
                            }
                            #example1 td, #example1 th {
                                background-color: rgba(255, 255, 255, 0.95);
                            }
                            .table-dark th {
                                background-color: #212529 !important;
                                color: white !important;
                            }
                        </style>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOyN30AYEzkEYIIC69j_krdLt2VKLjG9A"></script>

                        <div class="table-responsive table-container">
                            <table id="example1" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-user me-1 text-info"></i>Tenant</th>
                                        <th><i class="fas fa-home me-1 text-success"></i>Shop Name</th>
                                        <th><i class="fas fa-ruler-combined me-1 text-warning"></i>Covered Area</th>
                                        <th><i class="fas fa-building me-1 text-primary"></i>Plaza</th>
                                        <th><i class="fas fa-money-bill me-1 text-success"></i>Start Rent</th>
                                        <th><i class="fas fa-coins me-1 text-warning"></i>Current Rent</th>
                                        <th><i class="fas fa-map-marker-alt me-1 text-danger"></i>Coordinates</th>
                                        <th class="text-center" style="width: 200px">
                                            <i class="fas fa-cogs me-1"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                    <tr class="align-middle">
                                        <td>
                                            @if($value->customer)
                                                <a href="javascript:void(0)" 
                                                   class="show_customer text-decoration-none" 
                                                   data-value="{{json_encode($value->customer)}}">
                                                    <div class="fw-bold text-primary">{{$value->customer->cnic}}</div>
                                                    <small class="text-muted">{{$value->customer->name}}</small>
                                                </a>
                                            @else
                                                <span class="text-muted">No tenant</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="show_shop text-decoration-none fw-bold text-success" 
                                               data-value="{{json_encode($value)}}">
                                                {{$value->shop_name}}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{$value->coveredarea}} sq ft</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{$value->plaza_name}}</span>
                                        </td>
                                        <td>
                                            <span class="text-success fw-bold">₹{{number_format($value->start_rent)}}</span>
                                        </td>
                                        <td>
                                            <span class="text-warning fw-bold">₹{{number_format($value->current_rent)}}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <div><strong>Lat:</strong> {{$value->lat}}</div>
                                                <div><strong>Lng:</strong> {{$value->lng}}</div>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{url("editResidential")."/$value->id"}}" 
                                                   class="btn btn-outline-primary btn-sm" 
                                                   title="Edit Property">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if(count($value->rentout) > 0)
                                                    <button type="button" 
                                                            class="btn btn-outline-info btn-sm show_shop" 
                                                            data-value="{{json_encode($value)}}" 
                                                            title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-outline-secondary btn-sm" 
                                                            onclick="print_single({{$value->id}})" 
                                                            title="Print">
                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-end">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Information Modal -->
    <div class="modal fade" id="user_information" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="userModalLabel">
                        <i class="fas fa-user me-2"></i><span id="customer_name">Customer Information</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <strong><i class="fas fa-id-card text-primary me-2"></i>CNIC:</strong> 
                                <span id="customer_cnic" class="text-muted"></span>
                            </div>
                            <div class="mb-3">
                                <strong><i class="fas fa-phone text-success me-2"></i>Contact No:</strong> 
                                <span id="customer_phone" class="text-muted"></span>
                            </div>
                            <div class="mb-3">
                                <strong><i class="fas fa-envelope text-info me-2"></i>Email:</strong> 
                                <span id="customer_email" class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{asset("images/tenant.png")}}" class="img-thumbnail" style="max-width: 100px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Property Details Modal -->
    <div class="modal fade" id="info14" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="propertyModalLabel">
                        <i class="fas fa-home me-2"></i>Residential Property Information
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!--map and image-->
                    <div class="brow">
                        <!-- Horizontal Form -->
                        <div class="row">
                            <div class="box box-success col-md-6">



                                <div class="col-md-6">
                                    <div class="brow">
                                        <img id="shp_img" src="" height="auto" width="100%" /></div>

                                </div>
                            </div>

                        </div>



                    </div>
                    <!--end map image-->
                    <div class="brow"><strong>Name Officer/official:: </strong><span id="cus_name"></span></div>
                    <div class="brow"><strong>Designation:: </strong><span id="cus_disignation"></span></div>
                    <div class="brow"><strong>Place of Duty:: </strong><span id="cus_place_of_duty"></span></div>
                    <div class="brow">
                        <strong>Tenant CNIC: </strong><span id="cus_cnic"></span>                       </div>
                    <div class="brow">
                        <strong>Tenant Contact: </strong><span id="cus_mobile"></span>                        </div>
                    <div class="brow">
                        <strong>Father / Husband Name: </strong><span id="cus_father"></span>                        </div>
                    <div class="brow">
                        <strong>Demand Number: </strong><span id="cus_shop_name"></span>                       </div>

                    <div class="brow"><strong>Location: </strong><span id="cus_address"></span></div>

                    <div class="brow"><strong>Geo Location: </strong><span id="cus_geo"></span></div>
                    <div class="brow"><strong>Classification: </strong><span id="cus_property_type"></span></div>
                    <div class="brow"><strong>Monthly Rent: </strong><span id="cus_rent"></span></div>

                    <div class="brow"><strong>Area: </strong><span id="cus_area"></span></div>

                    <div class="brow"><strong>Registration Date: </strong><span id="cus_lease_date"></span></div>
                    <div class="brow"><strong>Expiry Date: </strong><span id="cus_expiry_date"></span></div>



                    <br>
                    <hr>
                    <center class="span3">
                        <small><strong>Phone:</strong>+92 922 3xxxx / +92 921 3xxxx&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email:</strong> <a href="info@eproperty.mda.gov.pk">info@eproperty.mda.gov.pk</a><strong>&nbsp;&nbsp;&nbsp;&nbsp;Website:</strong> <a href=">www.eproperty.mda.gov.pk">www.eproperty.lcbkp.gov.pk</a></small>
                    </center>
                </div>

            </div>
        </div>

    </div>



    <script type="text/javascript">
        $(document).ready(function(e){

            $("body").on("click",".show_shop",function(e){

                var value = JSON.parse($(this).attr("data-value"));

                shop_image = BaseUrl+"/"+value.attachment;
                $("#shp_img").attr("src","");
                $("#prop_image").attr("src","");
                var customer= value.customer;
                if(customer){
                    $("#cus_name").html(customer.name);
                    $("#cus_cnic").html(customer.cnic);
                    $("#cus_mobile").html(customer.phoneNumber);
                    $("#cus_disignation").html(customer.designation);
                    $("#cus_place_of_duty").html(customer.place_of_duty);
                }else{
                    $("#cus_name").html("");
                    $("#cus_cnic").html("");
                    $("#cus_mobile").html("");
                }
                $("#shp_img").attr("src",shop_image);
                $("#prop_image").attr("src",shop_image);
                $("#cus_shop_name").html(value.shop_name);
                $("#cus_address").html(value.location);
                $("#cus_geo").html(value.lat+","+value.lng);
                $("#cus_property_type").html(value.property_type);
                $("#cus_rent").html(value.current_rent);
                $("#cus_area").html(value.coveredarea);
                $("#cus_lease_date").html(value.lease_date);
                $("#cus_expiry_date").html(value.expiry_date);


                $("#info14").modal("show");
            });


            $("body").on("click",".show_customer",function(e){
                var value = JSON.parse($(this).attr("data-value"));
                $("#customer_name").html(value.name);
                $("#customer_cnic").html(value.cnic);

                $("#customer_phone").html(value.phoneNumber);
                $("#customer_email").html(value.email);
                $("#user_information").modal("show");

            });


            $("body").on("click",".delete_record",function(e){

                delete_id = $(this).attr("id");
                $(".box_message").text("Are you sure to delete this record ?");
                $("#delete_modal").modal("show");
            });

            $("body").on("click",".btn_cancel",function(e){
                $("#delete_modal").modal("hide");
            });

            $("body").on("change","#plaza_filter",function(e){
                var id = $(this).val();
                var shop_id = $("#shop_filter").val();
                if(id == "")
                    shop_id = "";
                filterShops(id);
                url = BaseUrl+"/commercial-properties?plaza_id="+id+"&shop_id="+shop_id;
                window.location =url;
            });

            $("body").on("change","#shop_filter",function(e){
                var shop_id = $(this).val();
                var plaza_id = $("#plaza_filter").val();

                url = BaseUrl+"/commercial-properties?plaza_id="+plaza_id+"&shop_id="+shop_id;
                window.location =url;
            });


            $("body").on("click",".delete_yes",function(e){
                $.ajax({
                    method:"POST",
                    data:{id:delete_id},
                    url:'<?php echo url("/settings/delete-plaza"); ?>',
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

        function filterShops(plaza_id) {
            $.ajax({
                method:"POST",
                data:{plaza_id:plaza_id},
                url:'<?php echo url("/get_shops"); ?>',
                success:function(res){
                    if(res.status){
                        var html = "";
                        var html = "<option value=''>Please Select Shop...</option>";
                        res.data.forEach(function (value,key) {
                            html +=`<option value="${value.id}">${value.shop_name}</option>`
                        });
                        $("#shop_filter").html(html);

                    }else{

                    }

                }
            });
        }

        function print_all() {
            var w = window.open("{{url('/printResidential')}}",'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }

        function print_single(id) {
            var w = window.open("{{url('/printResidential/')}}/"+id,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }
    </script>


@endsection






