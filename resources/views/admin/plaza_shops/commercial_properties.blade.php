@extends('admin.template2')
@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">
                <i class="fas fa-building text-primary me-2"></i>Commercial Properties
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Commercial Properties Details
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Commercial Properties Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-building text-primary me-2"></i>Commercial Properties
                            </h5>
                            <a href="{{ url('settings/add-floor-shop') }}" class="btn btn-success">
                                <i class="fas fa-plus me-1"></i>Add New Property
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Embedded Styles -->
                        <style>
                            .form-label, .table th, .table td { font-size: 10px !important; }
                            .btn { font-size: 10px !important; }
                            .card-title { font-size: 12px !important; }
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
                        
                        <!-- Google Maps API -->
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOyN30AYEzkEYIIC69j_krdLt2VKLjG9A"></script>
                        
                        <!-- Search and Filter Row -->
                        <div class="row mb-4">
                            <div class="col-md-3 mb-3">
                                <div class="position-relative">
                                    <input type="text" 
                                           value="{{ $_GET['search'] ?? '' }}" 
                                           class="form-control" 
                                           id="search_box" 
                                           placeholder="Search properties...">
                                    <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <!-- Reserved for Plaza Filter -->
                            </div>
                            <div class="col-md-3 mb-3">
                                <!-- Reserved for Shop Filter -->
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="d-flex justify-content-end">
                                    <button type="button" onclick="print_all()" class="btn btn-outline-primary">
                                        <i class="fas fa-print me-1"></i>Print All
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="table-responsive table-container">
                            <table id="example1" class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-user me-1 text-info"></i>Tenant</th>
                                        <th><i class="fas fa-store me-1 text-success"></i>Shop Name</th>
                                        <th><i class="fas fa-ruler-combined me-1 text-warning"></i>Covered Area</th>
                                        <th><i class="fas fa-building me-1 text-primary"></i>Plaza</th>
                                        <th><i class="fas fa-money-bill me-1 text-success"></i>Start Rent</th>
                                        <th><i class="fas fa-coins me-1 text-warning"></i>Current Rent</th>
                                        <th><i class="fas fa-map-marker-alt me-1 text-danger"></i>Coordinates</th>
                                        <th class="text-center" >
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
                                                   data-value="{{ json_encode($value->customer) }}">
                                                    <div class="fw-bold text-primary">{{ $value->customer->cnic }}</div>
                                                    <small class="text-muted">{{ $value->customer->name }}</small>
                                                </a>
                                            @else
                                                <span class="text-muted">No tenant</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="show_shop text-decoration-none fw-bold text-success" 
                                               data-value="{{ json_encode($value) }}">
                                                {{ $value->shop_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $value->coveredarea }} sq ft</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $value->plaza_name }}</span>
                                        </td>
                                        <td>
                                            <span class="text-success fw-bold">₹{{ number_format($value->start_rent) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-warning fw-bold">₹{{ number_format($value->current_rent) }}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <div><strong>Lat:</strong> {{ $value->lat }}</div>
                                                <div><strong>Lng:</strong> {{ $value->lng }}</div>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ url('settings/edit-floor-shop') . '/' . $value->id }}" 
                                                   class="btn btn-outline-primary btn-sm" 
                                                   title="Edit Property">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if(count($value->rentout) > 0)
                                                    <button type="button" 
                                                            class="btn btn-outline-info btn-sm show_shop" 
                                                            data-value="{{ json_encode($value) }}" 
                                                            title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-outline-secondary btn-sm" 
                                                            onclick="print_single({{ $value->id }})" 
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
                        
                        <!-- Pagination -->
                        @if($data->hasPages())
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted">
                                    Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} 
                                    of {{ $data->total() }} results
                                </div>
                                <div>
                                    {{ $data->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Information Modal -->
    <div class="modal fade" id="user_information" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/tenant.png') }}" 
                             height="50" 
                             width="50" 
                             class="rounded-circle me-3 border border-white border-2"
                             alt="Tenant">
                        <div>
                            <h5 class="modal-title mb-0" id="customerModalLabel">
                                <i class="fas fa-user me-2"></i>Tenant Information
                            </h5>
                            <small class="opacity-75" id="customer_name">Customer Details</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-id-card text-primary me-3 fs-5"></i>
                                <div>
                                    <strong class="text-muted d-block">CNIC:</strong>
                                    <span id="customer_cnic" class="fw-medium">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-phone text-success me-3 fs-5"></i>
                                <div>
                                    <strong class="text-muted d-block">Contact Number:</strong>
                                    <span id="customer_phone" class="fw-medium">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-info me-3 fs-5"></i>
                                <div>
                                    <strong class="text-muted d-block">Email Address:</strong>
                                    <span id="customer_email" class="fw-medium">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Property Details Modal -->
    <div class="modal fade" id="info14" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <!-- Modal Header with Logo -->
                <div class="modal-header bg-gradient-primary text-white">
                    <div class="d-flex align-items-center w-100">
                        <img src="{{asset('logo.jpg')}}" 
                             alt="Organization Logo" 
                             class="me-3" 
                             style="height: 40px;">
                        <div class="flex-grow-1 text-center">
                            <h4 class="modal-title mb-0" id="propertyModalLabel">
                                <i class="fas fa-building me-2"></i>Commercial Property Information
                            </h4>
                        </div>
                        <img src="../uploads/tenant.png" 
                             height="50" 
                             width="50" 
                             class="rounded-circle border border-white border-2"
                             alt="Tenant">
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Map and Image Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0">
                                        <i class="fas fa-map-marked-alt text-primary me-2"></i>Property Location & Image
                                    </h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div id="map_canvas2" 
                                                 class="w-100 border-end" 
                                                 style="height: 300px; background: #f8f9fa;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex align-items-center justify-content-center h-100">
                                                <img id="shp_img" 
                                                     src="" 
                                                     class="img-fluid rounded shadow-sm" 
                                                     style="max-height: 280px; object-fit: cover;"
                                                     alt="Property Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Property Details -->
                    <div class="row g-4">
                        <!-- Tenant Information -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Tenant Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong class="text-muted">Name:</strong>
                                        <p class="mb-1" id="cus_name">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-muted">CNIC:</strong>
                                        <p class="mb-1" id="cus_cnic">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-muted">Contact:</strong>
                                        <p class="mb-1" id="cus_mobile">-</p>
                                    </div>
                                    <div class="mb-0">
                                        <strong class="text-muted">Father/Husband:</strong>
                                        <p class="mb-0" id="cus_father">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Property Information -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0"><i class="fas fa-building me-2"></i>Property Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong class="text-muted">Shop Name:</strong>
                                        <p class="mb-1" id="cus_shop_name">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-muted">Location:</strong>
                                        <p class="mb-1" id="cus_address">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-muted">Coordinates:</strong>
                                        <p class="mb-1" id="cus_geo">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-muted">Type:</strong>
                                        <p class="mb-1" id="cus_property_type">-</p>
                                    </div>
                                    <div class="mb-0">
                                        <strong class="text-muted">Area:</strong>
                                        <p class="mb-0" id="cus_area">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information -->
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="fas fa-money-bill me-2"></i>Financial Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong class="text-muted">Monthly Rent:</strong>
                                        <p class="mb-1 text-success fw-bold" id="cus_rent">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-muted">Registration Date:</strong>
                                        <p class="mb-1" id="cus_lease_date">-</p>
                                    </div>
                                    <div class="mb-0">
                                        <strong class="text-muted">Expiry Date:</strong>
                                        <p class="mb-0 text-warning fw-medium" id="cus_expiry_date">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents & Media -->
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-header bg-warning text-dark">
                                    <h6 class="mb-0"><i class="fas fa-file me-2"></i>Documents & Media</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong class="text-muted">Property Image:</strong>
                                        <div class="mt-2">
                                            <img id="prop_image" 
                                                 src="" 
                                                 alt="Property Image" 
                                                 class="img-fluid rounded shadow-sm"
                                                 style="max-width: 200px; max-height: 150px;">
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <strong class="text-muted">Agreement:</strong>
                                        <div class="mt-2">
                                            <a target="_blank" 
                                               id="document_file" 
                                               href="#" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf me-1"></i>View Document
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <hr class="my-4">
                    <div class="text-center">
                        <small class="text-muted">
                            <strong>Phone:</strong> +92 922 3xxxx / +92 921 3xxxx &nbsp;•&nbsp;
                            <strong>Email:</strong> <a href="mailto:info@eproperty.lcbkp.gov.pk" class="text-decoration-none">info@eproperty.lcbkp.gov.pk</a> &nbsp;•&nbsp;
                            <strong>Website:</strong> <a href="https://www.eproperty.lcbkp.gov.pk" class="text-decoration-none">www.eproperty.lcbkp.gov.pk</a>
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Print Details
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- Custom Styles -->
    <style>
        .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1) !important; }
        .bg-info-soft { background-color: rgba(13, 202, 240, 0.1) !important; }
        .text-info { color: #0dcaf0 !important; }
        .avatar-sm { width: 35px; height: 35px; }
        .bg-gradient-primary {
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
        }
        .table td { padding: 1rem 0.75rem; }
        .btn-group .btn { border-radius: 0.375rem !important; margin-right: 2px; }
        .modal-xl { max-width: 90%; }
    </style>

    <script type="text/javascript">
        $(document).ready(function(e){
            // Initialize Bootstrap 5 tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialize DataTable if needed
            if ($.fn.DataTable) {
                $('#example1').DataTable({
                    responsive: true,
                    pageLength: 25,
                    order: [[1, 'asc']],
                    language: {
                        search: "Search properties:",
                        lengthMenu: "Show _MENU_ properties per page",
                        info: "Showing _START_ to _END_ of _TOTAL_ properties"
                    }
                });
            }
            $("body").on("click",".show_shop",function(e){

                var value = JSON.parse($(this).attr("data-value"));

                shop_image = BaseUrl+"/"+value.attachment;
                var document_image = BaseUrl+"/"+value.document;
                $("#shp_img").attr("src","");
                $("#document_file").attr("href","");
                $("#prop_image").attr("src","");
                var customer= value.customer;
                var is_documents = value.document ? true : false;
                if(customer){
                    $("#cus_name").html(customer.name);
                    $("#cus_cnic").html(customer.cnic);
                    $("#cus_mobile").html(customer.phoneNumber);
                }else{
                    $("#cus_name").html("");
                    $("#cus_cnic").html("");
                    $("#cus_mobile").html("");
                }
                $("#shp_img").attr("src",shop_image);
                $("#prop_image").attr("src",shop_image);
                if(is_documents){
                    $("#document_file").attr("href",document_image);
                    $("#document_file").html("View Document");
                    $("#document_file").show();
                }else{
                    $("#document_file").html("Agreement Not Uploaded.");
                    $("#document_file").attr("href","javascript:void(0)");
                    $("#document_file").show();
                }

                $("#cus_shop_name").html(value.shop_name);
                $("#cus_address").html(value.location);
                $("#cus_geo").html(value.lat+","+value.lng);
                $("#cus_property_type").html(value.property_type);
                $("#cus_rent").html(value.current_rent);
                $("#cus_area").html(value.coveredarea);
               $("#cus_lease_date").html(value.lease_date);
                $("#cus_expiry_date").html(value.expiry_date);

                loadMap(value.lat,value.lng);
                var modal = new bootstrap.Modal(document.getElementById('info14'));
                modal.show();
            });


            $("body").on("click",".show_customer",function(e){
                var value = JSON.parse($(this).attr("data-value"));
                $("#customer_name").html(value.name);
                $("#customer_cnic").html(value.cnic);

                $("#customer_phone").html(value.phoneNumber);
                $("#customer_email").html(value.email);
                var modal = new bootstrap.Modal(document.getElementById('user_information'));
                modal.show();

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

        function loadMap(lat,lng) {
            var coords =`${lat},${lng}`;

            latlong=coords.split(",");
            var lat =latlong[0];
            var lng = latlong[1];


            var myOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas2"),myOptions);

            var myMarkerLatlng = new google.maps.LatLng(lat,lng);
            var marker = new google.maps.Marker({
                position: myMarkerLatlng,
                map: map,
                title: ''
            });
        }

        function print_all() {
            var w = window.open("{{url('/printCommercial')}}",'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }

        function print_single(id) {
            var w = window.open("{{url('/printCommercial/')}}/"+id,'name','width=800,height=500');
            w.onload = w.print;
            w.focus();
        }

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
               var value = $("#search_box").val();
               var url = "{{url("commercial-properties")}}?search="+value;
               window.location = url;
            }
        });
    </script>


@endsection






